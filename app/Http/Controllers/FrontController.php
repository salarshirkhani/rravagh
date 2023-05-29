<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Post;
use App\User;
use App\order;
use App\brand;
use App\contact;
use App\comment;
use App\Upload;
use App\code;
use App\subscribe;
use App\color;
use App\promote;
use App\product_tag;
use App\post_tag;
use App\subscription;
use App\SliderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Session\Store;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Http\Requests\SearchRequest;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;
// OR
use Artesaos\SEOTools\Facades\SEOTools;
use Mews\Captcha;
use Carbon\Carbon;

class FrontController extends Controller
{
    private function escape_like(string $value, string $char = '\\'): string
    {
        return str_replace(
            [$char, '%', '_'],
            [$char.$char, $char.'%', $char.'_'],
            $value
        );
    }
    
    public function questions() {

        return view('questions',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);

    }
  
    public function rules() {

        return view('rules',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);

    }
  
    public function security() {

        return view('security',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);

    }

    public function search(SearchRequest $request)
    {
        $data = $request->validated();

        $posts = Post::where('title', 'LIKE', '%'. $this->escape_like($data['q']) . '%')->paginate(8);

        return view('search',['posts' => $posts,
        'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
        'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function productsearch(Request $request)
    {
        $this->validate($request, [
            'q' => ['required', 'string', 'max:255'] ,
        ]);

            $posts = Product::where('name', 'LIKE', '%'. $this->escape_like($request['q']) . '%')->paginate(8);
      		if(Auth::check())
              $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
            else
              $subscribe =NULL ;
      
            return view('productsearch',['products' => $posts,
                'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->orderBy('priority', 'desc')->where('type','product')->get(),
                'writers' => color::orderBy('created_at', 'desc')->get(),
				'subscribe' =>  $subscribe, 
                'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
            ]);
    }

    public function tags(Request $request)
    {
        $this->validate($request, [
            'q' => ['required', 'string', 'max:255'] ,
        ]);

            $posts = product_tag::where('name', 'LIKE', '%'. $this->escape_like($request['q']) . '%')->paginate(8);
            if(Auth::check())
               $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
            else
              $subscribe =NULL ;
            return view('tags',['products' => $posts,
                'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->orderBy('priority', 'desc')->where('type','product')->get(),
                'writers' => color::orderBy('created_at', 'desc')->get(),
				'subscribe' =>  $subscribe, 
                'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
            ]);
    }
    
    public function posttags(Request $request)
    {
        $this->validate($request, [
            'q' => ['required', 'string', 'max:255'] ,
        ]);

            $posts = post_tag::where('name', 'LIKE', '%'. $this->escape_like($request['q']) . '%')->paginate(8);
            return view('posttags',['posts' => $posts,
                'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->get(),
                'writers' => color::orderBy('created_at', 'desc')->get(),
                'tag'=>$request['q'],
                'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
            ]);
    }

    public function index() {

        SEOTools::setTitle('رواق');
        SEOTools::setDescription('مرجع فروش محصولات فرهنگی');
        SEOTools::opengraph()->setUrl('http://rravagh.com');
        SEOTools::setCanonical('http://rravagh.com');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@rravagh');
      
      	if(Auth::check())
          $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;

        return view('welcome',[
        'products' => Product::orderBy('created_at', 'desc')->get(),
        'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
        'brands' => brand::orderBy('created_at', 'desc')->get(),     
        'subscribe' =>  $subscribe, 
        'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);

    }
    
    public function promotion() {

        if(Auth::check())
           $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
           $subscribe =NULL ;
      
        if(Auth::check())
           $promote= promote::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->FIRST();
        else
           $promote =NULL ;
        return view('promotion',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
          	'subscribe' => $subscribe,
            'promote' => $promote,
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
     ]);

    }

    public function contact() {

        return view('contact',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);

    }

    public function about() {

        return view('about',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);

    }

    public function subscription() {
      
            if(Auth::check())
              $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
            else
              $subscribe =NULL ;

        return view('subscription',[
            'posts' => subscription::orderBy('created_at', 'desc')->get(),
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
            'subscribe' => $subscribe,
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);

    }

    public function checkout(Request $data) {

        if(Cart::count() > 0 && Auth::check()){

            return view('checkout',[ 
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
            'price'=> $data->price ,
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
            ])->with('info' , 'لطفا اطلاعات خود را دقیق وارد کنید');
        }
        else{

            return redirect()->back();
        }
        
    }

    public function post($id) {
        $item=Post::find($id);
        SEOTools::setTitle(' رواق -'.$item->title);
        SEOTools::setDescription($item->explain);
        SEOTools::opengraph()->setUrl('http://rravagh.com');
        SEOTools::setCanonical('http://rravagh.com');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@rravagh');
        return view('single-post',[
            'item' => $item,
            'posts' => Post::orderBy('created_at', 'desc')->LIMIT(3)->get(),
            'comments' => comment::where('post_id',$id)->orderBy('created_at', 'desc')->get() ,
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
            'writers' => color::orderBy('created_at', 'desc')->get(),
            'tags' => post_tag::where('post_id',$item->id)->orderBy('created_at', 'desc')->get(),
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);

    }

    public function blog() {

        return view('blog',[
            'posts' => Post::orderBy('created_at', 'desc')->get(),
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->get(),
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);

    }

    public function products(Request $request) {
        $sort = $request->get('sort'); 
        if(!isset($sort)){
            $sort='DESC';
        }
        if(Auth::check())
           $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;
        return view('products',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
            'products' => Product::where('lovely',NULL)->orderBy('created_at', 'desc')->paginate('16'),
            'brands' => brand::orderBy('created_at', 'desc')->get(),
            'writers' => color::orderBy('created_at', 'desc')->get(),
            'sort' =>$sort,
            'subscribe' =>  $subscribe,
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(), 
        ]);

    }

    public function discountable(Request $request) {
        $sort = $request->get('sort'); 
        if(!isset($sort)){
            $sort='DESC';
        }
        if(Auth::check())
           $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;
        return view('discountable',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
            'products' => Product::where('discountable','1')->orderBy('created_at', 'desc')->paginate('16'),
            'brands' => brand::orderBy('created_at', 'desc')->get(),
            'writers' => color::orderBy('created_at', 'desc')->get(),
            'sort' =>$sort,
            'subscribe' =>  $subscribe,
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(), 
        ]);

    }

    public function category($slug,Request $request) {
        $sort = $request->get('sort'); 
        if(!isset($sort)){
            $sort='DESC';
        }

        //$pros=array();
        $category=Category::where('slug' , $slug)->FIRST();
        SEOTools::setTitle(' رواق -'.$category->name);
        SEOTools::setDescription($category->desccription);
        SEOTools::opengraph()->setUrl('http://rravagh.com/category/'.$slug);
        SEOTools::setCanonical('http://rravagh.com');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@rravagh');
      	if(Auth::check())
           $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;
        if($category->parent_id === NULL && $slug != 'Accessory'){
           $parent=Category::where('parent_id' , $category->id)->get();
            $products = Product::where('category' , $category->id)->orderBy('price',  $sort)->paginate(16);
            $archive = Product::where('category' , $category->id)->orderBy('price',  $sort)->paginate(16);
            return view('mainproducts',[
                'category'=>$category,
                'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->orderBy('priority', 'desc')->get(),
                'parent' =>$parent,
                'cat_id' => $category->id,
                'products' => $products,
                'writers' => color::orderBy('created_at', 'desc')->get(),
                'archive' => $archive,  
                'brands' => brand::orderBy('created_at', 'desc')->get(),
                'sort' =>$sort,
                'subscribe' =>  $subscribe, 
                'banners' => SliderItem::orderBy('created_at', 'desc')->get(), 
            ]);
        }
        else{
        $products = Product::where('lovely',NULL)->where('category' , $category->id)->orderBy('created_at', 'desc')->get();
        $archive = Product::where('category' , $category->id)->orderBy('created_at', 'desc')->paginate(16);
        return view('products',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','product')->get(),
            'products' => $products,
            'archive' => $archive,  
            'brands' => brand::orderBy('created_at', 'desc')->get(),
            'sort' =>$sort,
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(), 
        ]);

        }
    }
    
    public function Brands($id,Request $request) {
        $sort = $request->get('sort'); 
        if(!isset($sort)){
            $sort='DESC';
        }
        if(Auth::check())
           $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;
        return view('products',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('type','product')->orderBy('priority', 'desc')->get(),
            'products' => Product::where('lovely',NULL)->where('brand' , $id)->orderBy('created_at', 'desc')->get(),
            'archive' => Product::where('brand' , $id)->orderBy('created_at', 'desc')->paginate(16),
            'brands' => brand::orderBy('created_at', 'desc')->get(),
            'sort' =>$sort,
            'subscribe' =>  $subscribe, 
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);

    }


    public function Sproduct($id) {
        $item=Product::find($id);
        $related_products = Product::inRandomOrder()->where('category', $item->category)->limit(6)->get();
        $comments = comment::where('product_id',$id)->orderBy('created_at', 'desc')->get();
        SEOTools::setTitle(' رواق -'.$item->name);
        SEOTools::setDescription($item->explain);
        SEOTools::opengraph()->setUrl('http://rravagh.com');
        SEOTools::setCanonical('http://rravagh.com');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@rravagh');
        if(Auth::check())
          $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;
        return view('single-product',[
            'categories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->orderBy('priority', 'desc')->get(),
            'item' => $item,
            'comments' => $comments ,
            'products' => $related_products,
            'images' => Upload::where('product_id',$item->id)->get(), 
            'idd' => 0,
            'tags' => product_tag::where('product_id',$item->id)->orderBy('created_at', 'desc')->get(),
            'subscribe' =>  $subscribe, 
            'banners' => SliderItem::orderBy('created_at', 'desc')->get(),
        ]);

    }

    public function Message(Request $request) {
        
        $this->validate($request, [
            'img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => ['required', 'string', 'max:255'] ,
            'user_id' => ['nullable','exists:users,id'],
            'urpost' => ['required', 'string', 'max:255'],
            'urphone' => ['nullable', 'string', 'regex:/^((\+98|0)[0-9]+)|((\+۹۸|۰)[۰-۹]+)$/']
        ]);
        $post = new contact([
            'user_id' => $request->input('user_id'),
            'name' => $request->input('name'),
            'job' => $request->input('urpost'),
            'email' => $request->input('urmail'),
            'status' => $request->input('urgent'),
            'number' => $request->input('urphone'),
        ]);
        $post->save();
        return redirect()->back()->with('info', 'درخواست ثبت شد');
        
    }

    
    public function comment(Request $request) {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'] ,
            'user_id' => ['nullable','exists:users,id'],
            'captcha' => 'required|Captcha',
        ]);
        $post = new comment([
            'user_id' => $request->input('user_id'),
            'product_id' => $request->input('product_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'description' => $request->input('content'),
        ]);
        $post->save();
        return redirect()->back()->with('info', 'نظر شما ثبت شد');
    }

    public function postcomment(Request $request) {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'] ,
            'user_id' => ['nullable','exists:users,id'],
        ]);
        $post = new comment([
            'user_id' => $request->input('user_id'),
            'post_id' => $request->input('post_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'description' => $request->input('content'),
        ]);
        $post->save();
        return redirect()->back()->with('info', 'نظر شما ثبت شد');
    }

    public function promot(Request $request) {
        
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'] ,
            'user_id' => ['required','exists:users,id'],
            'img.*' => 'required | mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv|max:5048',
            'mobile' => ['required', 'string', 'regex:/^((\+98|0)[0-9]+)|((\+۹۸|۰)[۰-۹]+)$/']
        ]);
        $post = new promote([
            'user_id' => $request->input('user_id'),
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
        ]);
        //----MAIN PIC
            if($request->hasfile('img'))
            {
            $uploadedFile = $request->file('img');
            $filename = $uploadedFile->getClientOriginalName();
    
            Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
            $post->file = $filename;
            }

        $post->save();
        return redirect()->back()->with('info', 'شما در مسابقه شرکت داده شدید');
        
    }    
    
}
