<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\User;
use App\Rules\JalaliDate;
use Hekmatinasser\Verta\Verta;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use App\discounts;
use App\Category;
use App\brand;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class DiscountController extends Controller
{

    public function GetCreatePost()
    {
        return view('dashboard.admin.discount.create',[
        'users' => User::orderBy('created_at', 'desc')->where('type','teacher')->get() ,
        'brands' => brand::orderBy('created_at', 'desc')->get(),
        'categories' => Category::whereNull('parent_id')->with('allChildren')->get(),
        ]);
    }

    public function CreatePost(Request $request)
    {

        $post = new discounts([
            'user_id' => $request->input('user'),
            'user_type' => $request->input('user_type'),
            'discount_type' => $request->input('discount_type'),
            'code' => $request->input('code'),
            'discount' => $request->input('discount'),
            'finish_date' => Jalalian::fromFormat('Y/n/j',$request->input('finish_date'))->toCarbon()->format('Y/m/d'),
        ]);
        $post->save();

        return redirect()->route('dashboard.admin.discount.manage')->with('info', 'کد تخفیف جدید ایجاد شد و کد آن ' . $request->input('code'));
    }

    public function GetManagePost(Request $request)
    {
        $posts = discounts::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.discount.manage', [
            'posts' => $posts,  
            'users' => User::orderBy('created_at', 'desc')->get() 
        ]);
    }

    public function DeletePost($id){
        $post = discounts::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.discount.manage')->with('info', 'کد پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = discounts::find($id);
        return view('dashboard.admin.discount.updatediscount', [
        'post' => $post, 
        'id' => $id,
        'users' => User::orderBy('created_at', 'desc')->get() 
         ]);
    }

    public function UpdatePost(Request $request)
    {
        $post = product::find($request->input('id'));
        if (!is_null($post)) {
            $post->user_id = $request->input('user_id');
            $post->user_type = $request->input('user_type');
            $post->discount_type = $request->input('discount_type');
            $post->code = $request->input('code');
            $post->discount = $request->input('discount');
            $post->finish_date = Carbon::fromJalali($request->input('finish_date'));
            $post->save();
        }
        return redirect()->route('dashboard.admin.discount.manage',$post->id)->with('info', 'کدتخفیف ویرایش شد');
    }
}