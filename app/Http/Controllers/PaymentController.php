<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\Post;
use App\User;
use App\discounts;
use App\order;
use App\transaction;
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
use App\SliderItem;

class PaymentController extends Controller
{
    
    public function checkout(Request $data) {

        if(Cart::count() > 0 && Auth::check()){

          
            return view('checkout',[ 
            'categories' => Category::whereNull('parent_id')->with('allChildren')->get(),
            'price'=> $data->price ,
            'copon'=> $data->copon ,
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
            ])->with('info' , 'لطفا اطلاعات خود را دقیق وارد کنید');
        }
        else{

            return redirect()->back();
        }
        
    }
    
    public function callbacks() {
        
        if (!Auth::check()) {
             $transaction=transaction::orderBy('id', 'desc')->FIRST();
             return view('callback',[ 
                'transaction' => $transaction,
                'categories' => Category::whereNull('parent_id')->with('allChildren')->get(),
                'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
            ]);
            
        }
        else{
            $transaction=transaction::orderBy('id', 'desc')->where('user_id' , Auth::user()->id)->FIRST();
            return view('callback',[ 
                'transaction' => $transaction,
                'categories' => Category::whereNull('parent_id')->with('allChildren')->get(),
                'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
            ]);
        }
        
    }
    
    public function discount(Request $data){
        
        
        $copon=discounts::where('discount_type',$data->type)->where('code',$data->coupon_code)->first();
        
        if($copon != NULL){
            return back()->with('discount' , $copon->discount)->with('copon' , $copon->code);
        }

        return back()->with('discount' , 'no');
        
        
    }

    public function create(Request $data){

        $this->validate($data, [
            'city' => ['required', 'string', 'max:255'] ,
            'region' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'postcode' => ['required', 'string'],
        ]);

        if(Cart::count() > 0 && Auth::check()){

            $transaction=new transaction([

                'user_id' => Auth::user()->id,
                'amount' => $data->input('price'),
                'city' => $data->input('city'),
                'county' => $data->input('region'),
                'address' => $data->input('address'),
                'phone' => $data->input('phone'),
                'discount' => $data->input('discount'),
                'postcode' => $data->input('postcode'),
                'status' => 'notpaid',

            ]);

            $transaction->save();

            $trans=transaction::orderBy('id', 'desc')->where('user_id' , Auth::user()->id)->where('status' , 'notpaid')->FIRST();
            
            $order_check=order::where('user_id' , Auth::user()->id )->orderBy('created_at', 'desc')->get();

            foreach (Cart::content() as $item){
                    $order=new order();
                    $order->transaction_id = $trans->id ; 
                    $order->product_id = $item->model->id ; 
                    $order->number = $item ->qty ;
                    $order->amount = $item->price;
                    $order->color = $item->options->color;
                    $order->user_id = Auth::user()->id; 
                    $order->status = 'notpaid' ; 
                    $order->save();
            }
            
            // Create new invoice.
            $invoice = (new Invoice)->amount($data->input('price'));
            // Purchase and pay the given invoice.
            // You should use return statement to redirect user to the bank page.
            return Payment::callbackUrl('https://rravagh.com/payment/callbacks?trans='.$trans->id)->purchase($invoice, function($driver, $transactionId) {
                $trans=transaction::orderBy('created_at', 'desc')->where('user_id' , Auth::user()->id)->where('status' , 'notpaid')->FIRST();
                $trans->transaction=$transactionId;
                $trans->save();
            })->pay()->render();

     }

    }

    public function callback(Request $request)
    {
        $trans=transaction::find($request->trans);
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
            $order_check=order::where('transaction_id' , $trans->id)->orderBy('created_at', 'desc')->get();
            foreach($order_check as $item){
                $item->status='paid';
                $product=Product::find($item->product_id);
                $product->inventory = $product->inventory -$item->number ;
                $product->save();
                $item->save();
            }
            $trans->save();
            Cart::destroy();
            
            $details = [
                   'title' => 'ایمیل از سایت رواق ',
                   'message' => 'سفارش جدیدی در سایت رواق ثبت شد',
                    'link' => 'https://rravagh.com'
            ];

            //\Mail::to('salarshirkhany16@gmail.com')->send(new \App\Mail\order($details));
            

           // $url = "https://ippanel.com/services.jspd";

          //  $rcpt_nm = array(Auth::user()->mobile, '09372833776');
           // $param = array
          //  (
           //    'uname' => 'ketabjang',
          //     'pass' => 'ketab7976190',
          //     'from' => '3000505',
//'message' => 'سفارش جدیدی در سایت  دیجی ریحان ثبت شد',
//       /         'message' => 'تست',
         //      'to' => json_encode($rcpt_nm),
          //      'op' => 'send'
          //  );
            return redirect()->route('payment.callback')->with('transaction', $trans->id)->with('info', $status);
          
          } 
      catch (InvalidPaymentException $exception) {

         
          $order_check=order::where('transaction_id' ,  $_GET['trans'] )->orderBy('created_at', 'desc')->get();
            foreach($order_check as $item){
                $item->delete();
            }
           return redirect()->route('payment.callback');
      }

    }

}
