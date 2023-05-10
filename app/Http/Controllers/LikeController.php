<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Post;
use App\order;
use App\likes;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function Like(Request $request)
    {
        if(Auth::check()){ 

            $post = new likes([
                'user_id' => Auth::user()->id,
                'product_id' => $request->input('product'),
            ]);
            $post->save();

            return redirect()->back()->with('info', 'محصول با موفقیت به علاقمندی های شما اضافه شد');
        }
        else{
             return redirect()->back()->with('error', 'شما وارد سایت نشده اید');
        }
    }
}