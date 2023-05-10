<?php

namespace App\Http\Controllers\Dashboard\Buyer;

use App\Category;
use App\likes;
use App\discounts;
use App\order;
use App\notification;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth; 
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function get() {
        return view('dashboard.buyer.index', [
            'categories' => Category::all(),
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function cart(){
        return view('dashboard.buyer.cart',[
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),

        ]);
    }

    public function notification($id){
        return view('dashboard.buyer.notification',[
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),
            'notifi'=>notification::find($id),
        ]);
    }

    public function likes(){

        return view('dashboard.buyer.likes',[
            'likes' => likes::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),

        ]);
    }
}
