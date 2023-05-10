<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\color;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class ColorController extends Controller
{

    public function GetCreatePost()
    {
        return view('dashboard.admin.colors.create');
    }

    public function CreatePost(Request $request)
    {
        $post = new color([
            'name' => $request->input('name'),
        ]);
        $post->save();
        return redirect()->route('dashboard.admin.colors.manage')->with('info', 'نویسنده جدید ایجاد شد و نام آن ' .' '. $request->input('name'));
    }

    public function GetManagePost(Request $request)
    {
        $posts = color::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.colors.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = color::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.colors.manage')->with('info', 'نویسنده پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = color::find($id);
        return view('dashboard.admin.colors.update', ['post' => $post, 'id' => $id]);
    }

    public function UpdatePost(Request $request)
    {
        $post = color::find($request->input('id'));
        if (!is_null($post)) {
            $post->name = $request->input('name');
        }

       $post->save();

        return redirect()->route('dashboard.admin.colors.manage',$post->id)->with('info', 'نویسنده ویرایش شد');
    }
}