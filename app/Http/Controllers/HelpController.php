<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\Post;
use App\User;
use App\discounts;
use App\order;
use App\support;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Evryn\LaravelToman\Facades\Toman;
use Evryn\LaravelToman\CallbackRequest;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use GuzzleHttp\Client;
class HelpController extends Controller
{
 
    public function callbacks() {

        $transaction=support::orderBy('created_at', 'desc')->where('user_id' , Auth::user()->id)->FIRST();
        return view('callback',[ 
            'transaction' => $transaction,
            'categories' => Category::whereNull('parent_id')->with('allChildren')->get(),
        ]);
        
    }
    
    public function create(Request $data){

        $this->validate($data, [
            'price' => ['required'] ,
            'product_id' => ['required','exists:products,id'],
            'maxvalue' => ['required'] ,
        ]);

        if(Auth::check() && $data->input('price') <= $data->input('maxvalue')){

            $transaction=new support([

                'user_id' => Auth::user()->id,
                'amount' => $data->input('price'),
                'product_id' => $data->input('product_id'),
                'status' => 'notpaid',
            ]);

            $transaction->save();

            $trans=support::orderBy('created_at', 'desc')->where('user_id' , Auth::user()->id)->where('status' , 'notpaid')->FIRST();
            
            // Create new invoice.
            $invoice = (new Invoice)->amount($data->input('price'));
            // Purchase and pay the given invoice.
            // You should use return statement to redirect user to the bank page.
            return Payment::callbackUrl('https://rravagh.com/ravaghh/payment/callbacksh?trans='.$trans->id)->purchase($invoice, function($driver, $transactionId) {
                $trans=support::orderBy('created_at', 'desc')->where('user_id' , Auth::user()->id)->where('status' , 'notpaid')->FIRST();
                $trans->transaction=$transactionId; 
                $trans->save();
            })->pay()->render();

     }
     else{
        return redirect()->back()->with('info' , 'مقدار کمک شما از حداکثر مقدار کمک بیشتر است');
     }

    }

    public function callback(Request $request)
    {
        $trans=support::find($request->trans);
        $params = array(
          'id' =>  $trans->transaction,
          'order_id' => $trans->id ,
        );
      
      try {
          $receipt = Payment::amount($trans->amount)->transactionId($trans->transaction)->verify();

          // You can show payment referenceId to the user.
          echo $receipt->getReferenceId();
            $trans->status='paid';
            $status='paid';
            $trans->invoice_code=$trans->transaction;
            $transaction=$trans->transaction;

            $product=product::orderBy('created_at', 'desc')->where('product_id' , $trans->product_id)->FIRST();

            if(isset($product->helpprice))
                $finalprice=((($product->helpprice * $product->inventory)-$trans->amount)/$product->inventory);
            else
                $finalprice=((($product->price * $product->inventory)-$trans->amount)/$product->inventory);

            $product->helpprice=$finalprice;
            $product->save();

            $trans->save();
        
            $details = [
                   'title' => 'ایمیل از سایت  رواق',
                   'message' => 'کمک هزینه جدیدی در سایت رواق ثبت شد',
                    'link' => 'https://rravagh.com'
            ];

            \Mail::to('salarshirkhany16@gmail.com')->send(new \App\Mail\order($details));
            

            $url = "https://ippanel.com/services.jspd";

            $rcpt_nm = array(Auth::user()->mobile, '09372833776');
            $param = array
            (
               'uname' => 'ketabjang',
               'pass' => 'ketab7976190',
               'from' => '3000505',
                'message' => 'سفارش جدیدی در سایت  دیجی ریحان ثبت شد',
//                'message' => 'تست',
               'to' => json_encode($rcpt_nm),
                'op' => 'send'
            );

            

            return redirect()->route('payment.callback')->with('transaction', $trans->id)->with('info', $status);
          
          } 
      catch (InvalidPaymentException $exception) {

           return redirect()->route('payment.callback');
      }

    }

}
