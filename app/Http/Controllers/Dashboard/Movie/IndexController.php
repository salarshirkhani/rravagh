<?php
namespace App\Http\Controllers\Dashboard\Movie;
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
        SEOTools::opengraph()->setUrl('http://digireyhan.com');
        SEOTools::setCanonical('http://digireyhan.com');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@digireyhan');
      
      	if(Auth::check())
          $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;

        return view('movie.index',[
        'products' => Product::orderBy('created_at', 'desc')->get(),
        'categories' => Category::whereNull('parent_id')->with('allChildren')->get(),
        'brands' => brand::orderBy('created_at', 'desc')->get(),     
        'subscribe' =>  $subscribe, 
        ]);

    }

    
    public function index3() {

        SEOTools::setTitle('دیجی ریحان');
        SEOTools::setDescription('مرجع فروش محصولات فرهنگی');
        SEOTools::opengraph()->setUrl('http://digireyhan.com');
        SEOTools::setCanonical('http://digireyhan.com');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@digireyhan');
      
      	if(Auth::check())
          $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST();
        else
          $subscribe =NULL ;

        return view('movie.index',[
        'products' => Product::orderBy('created_at', 'desc')->get(),
        'categories' => Category::whereNull('parent_id')->with('allChildren')->get(),
        'brands' => brand::orderBy('created_at', 'desc')->get(),     
        'subscribe' =>  $subscribe, 
        ]);

    }
}
