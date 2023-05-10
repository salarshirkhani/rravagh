<?php

namespace App\Http\Controllers\Dashboard\teacher;

use App\Category;
use App\likes;
use App\academy;
use App\order;
use App\brand;
use App\discounts;
use App\notification;
use App\Rules\JalaliDate;
use Hekmatinasser\Verta\Verta;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use App\transaction;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth; 
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function get() {
        $transaction=transaction::where('discount', Auth::user()->id)->select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
           // return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $transac=transaction::where('discount', Auth::user()->id)->select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        });

        $transa=transaction::where('discount', Auth::user()->id)->select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('d'); // grouping by days
        });
        return view('dashboard.teacher.index', [
            'categories' => Category::all(),
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(),
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),
            'transactionm' => $transaction,
            'transac' => $transac,
            'transa' => $transa,
        ]);
    }

    public function cart(){
        return view('dashboard.teacher.cart',[
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),

        ]);
    }

    public function brands(){
        return view('dashboard.teacher.brand',[
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'academy' => academy::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),

        ]);
    }

    public function likes(){

        return view('dashboard.teacher.likes',[
            'likes' => likes::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),

        ]);
    }

    public function notification($id){
        return view('dashboard.teacher.notification',[
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),
            'notifi'=>notification::find($id),
        ]);
    }
}
