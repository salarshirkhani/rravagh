<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\likes;
use App\Category;

class CartController extends Controller
{
    
    public function index (){
        return view('cart',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->get(),
        ]);
    }

    public function store (Request $request){
      
      	$product=Product::find($request->id);
      	if($product->inventory < $request->number)
          return redirect()->back()->with('info' , 'تعداد خواسته شده بیشتر از موجودی محصول است');
        Cart::add($request->id , $request->name , $request->number , $request->price, ['color' => $request->color] )
            ->associate('App\Product');
        return redirect()->back()->with('info' , 'محصول به سبد خرید شما اضافه شد');

    }

    public function destroy($id)
    {
        $item=Cart::get($id);
        Cart::update($id, $item->qty-1);
        return back()->with('info' , 'محصول از سبد خرید پاک شد');
    }



}
