<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\support;
use App\User;
use App\transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Evryn\LaravelToman\Facades\Toman;
use Evryn\LaravelToman\CallbackRequest;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
class SupportController extends Controller
{
    
    
    public function callbacks() {

        $transaction=transaction::orderBy('created_at', 'desc')->where('user_id' , Auth::user()->id)->FIRST();
        return view('callback',[ 
            'transaction' => $transaction,
            'categories' => Category::whereNull('parent_id')->with('allChildren')->get(),
        ]);
        
    }
    

    public function create(Request $data){

        $this->validate($data, [
            'user_id' => ['required','exists:users,id'] ,
            'product_id' => ['required','exists:products,id'] ,
            'price' => ['required'],
        ]);

        if(Auth::check()){

            $transaction=new support([

                'user_id' => Auth::user()->id,
                'amount' => $data->input('price'),
                'product_id' => $data->input('product_id'),
                'status' => 'notpaid',

            ]);

            $transaction->save();

            $trans=support::orderBy('created_at', 'desc')->where('user_id' , Auth::user()->id)->where('status' , 'notpaid')->FIRST();
            

                $order=new support();
                $order->transaction_id = $trans->id ; 
                $order->product_id = $data->input('product_id'); 
                $order->user_id = Auth::user()->id; 
                $order->status = 'notpaid' ; 
                $order->save();
            
            
            // Create new invoice.
            $invoice = (new Invoice)->amount($data->input('price'));
            // Purchase and pay the given invoice.
            // You should use return statement to redirect user to the bank page.
            return Payment::callbackUrl('https://rravagh.com/ravaghh/payment/scallbackss?trans='.$trans->id)->purchase($invoice, function($driver, $transactionId) {
                $trans=support::orderBy('created_at', 'desc')->where('user_id' , Auth::user()->id)->where('status' , 'notpaid')->FIRST();
                $trans->transaction=$transactionId;
                $trans->save();
            })->pay()->render();

     }

    }

    public function callback(Request $request)
    {
      echo $_GET['trans'];
        $trans=support::find($request->trans);
        echo $trans->id;
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
                    $url = "https://ippanel.com/services.jspd";

            $rcpt_nm = array(Auth::user()->mobile, '09372833776');
            $param = array
            (
                'uname' => 'ketabjang',
                'pass' => 'ketab7976190',
                'from' => '3000505',
                'message' => 'ممنون از حمایت شما',
//                'message' => 'تست',
                'to' => json_encode($rcpt_nm),
                'op' => 'send'
            );
        
            $trans->save();
            return redirect()->route('payment.callback')->with('transaction', $trans->id)->with('info', $status);
          
          } 
      catch (InvalidPaymentException $exception) {

          echo $exception->getMessage();

           return redirect()->route('payment.callback');
      }

    }

}
