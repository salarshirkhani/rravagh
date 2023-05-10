<?php
namespace App\Http\Controllers\Movie;
use App\Category;
use App\movies;
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
use App\movie_tag;
use App\post_tag;
use App\subscription;
use App\Rules\JalaliDate;
use Hekmatinasser\Verta\Verta;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use App\transaction;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;
// OR
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;

class IndexController extends Controller
{
    private function escape_like(string $value, string $char = '\\'): string
    {
        return str_replace(
            [$char, '%', '_'],
            [$char.$char, $char.'%', $char.'_'],
            $value
        );
    }

    public function index() {

        SEOTools::setTitle('دیجی ریحان');
        SEOTools::setDescription('مرجع فروش محصولات فرهنگی');
        SEOTools::opengraph()->setUrl('http://digireyhan.com/media');
        SEOTools::setCanonical('http://digireyhan.com/media');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@digireyhan');
      
      	if(Auth::check())
          $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;

        return view('movie.index',[
        'movies' => movies::orderBy('created_at', 'desc')->get(),
        'tags'=>movie_tag::orderBy('created_at', 'desc')->select('name')->distinct()->get()->paginate(7),
        'moviecategories' => Category::whereNull('parent_id')->with('allChildren')->where('show','1')->where('type','movie')->orderBy('priority', 'desc')->get(),
        'categories' => Category::whereNull('parent_id')->where('show','1')->where('type','product')->with('allChildren')->orderBy('priority', 'desc')->get(),
        'subscribe' =>  $subscribe, 
        ]);

    }

    public function moviesearch(Request $request)
    {
        $this->validate($request, [
            'qm' => ['required', 'string', 'max:255'] ,
        ]);

            $posts = movies::where('name', 'LIKE', '%'. $this->escape_like($request['qm']) . '%')->paginate(8);
      		if(Auth::check())
              $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
            else
              $subscribe =NULL ;
      
            return view('movie.moviesearch',['movies' => $posts,
                'categories' => Category::whereNull('parent_id')->where('show','1')->where('type','product')->with('allChildren')->where('type','movie')->orderBy('priority', 'desc')->get(),
				'subscribe' =>  $subscribe, 
            ]);
    }

    //SINGLE MOVIE

    public function single($id) {
        $item=movies::find($id);
        $related_products = movies::inRandomOrder()->where('category', $item->category)->limit(6)->get();
        $comments = comment::where('movie_id',$id)->orderBy('created_at', 'desc')->get();
        SEOTools::setTitle(' دیجی ریحان-'.$item->name);
        SEOTools::setDescription($item->explain);
        SEOTools::opengraph()->setUrl('http://digireyhan.com');
        SEOTools::setCanonical('http://digireyhan.com');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@digireyhan');
        if(Auth::check())
          $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;
        return view('movie.single',[
            'categories' => Category::whereNull('parent_id')->where('show','1')->where('type','product')->with('allChildren')->orderBy('priority', 'desc')->get(),
            'item' => $item,
            'comments' => $comments ,
            'products' => $related_products,
            'category' => Category::find($item->category),
            'tags' => movie_tag::where('movie_id',$item->id)->orderBy('created_at', 'desc')->get(),
            'subscribe' =>  $subscribe, 
        ]);

    } 

    public function comment(Request $request) {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'] ,
            'user_id' => ['nullable','exists:users,id'],
        ]);
        $post = new comment([
            'user_id' => $request->input('user_id'),
            'movie_id' => $request->input('movie_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'description' => $request->input('content'),
        ]);
        $post->save();
        return redirect()->back()->with('info', 'نظر شما ثبت شد');
    }


    //SHOW MOVIE BY CATEGORY

    public function movies(Request $request) {

        if(Auth::check())
           $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;
        return view('movie.all',[
            'categories' => Category::whereNull('parent_id')->where('show','1')->where('type','product')->with('allChildren')->orderBy('priority', 'desc')->get(),
            'movies' => movies::orderBy('created_at', 'desc')->get(),
            'subscribe' =>  $subscribe, 
        ]);

    }  

    public function category($slug,Request $request) {

        //$pros=array();
        $category=Category::where('slug' , $slug)->FIRST();
        SEOTools::setTitle('دیجی ریحان -'.$category->name);
        SEOTools::setDescription($category->desccription);
        SEOTools::opengraph()->setUrl('http://digireyhan.com/media/category/'.$slug);
        SEOTools::setCanonical('http://digireyhan.com');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@digireyhan');
      	if(Auth::check())
           $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;

        $movies = movies::where('category' , $category->id)->get();

        return view('movie.category',[
            'categories' => Category::whereNull('parent_id')->where('show','1')->where('type','product')->with('allChildren')->orderBy('priority', 'desc')->get(),
            'movies' => $movies,
            'category' => $category,

        ]);

    }

    public function tags(Request $request)
    {
        $this->validate($request, [
            'q' => ['required', 'string', 'max:255'] ,
        ]);

            $posts = movie_tag::where('name', 'LIKE', '%'. $this->escape_like($request['q']) . '%')->paginate(8);
            if(Auth::check())
               $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
            else
              $subscribe =NULL ;
            return view('movie.tags',['movies' => $posts,
                'categories' => Category::whereNull('parent_id')->where('show','1')->where('type','product')->with('allChildren')->orderBy('priority', 'desc')->get(),
				'subscribe' =>  $subscribe, 
            ]);
    }
    

}
