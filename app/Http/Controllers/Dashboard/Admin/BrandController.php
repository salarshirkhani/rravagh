<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\brand;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{

    public function GetCreatePost()
    {
        return view('dashboard.admin.brands.create');
    }

    public function CreatePost(Request $request)
    {
        $post = new brand([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
        ]);
    //--------------
    if($request->hasfile('img'))
    {   
        $uploadedFile = $request->file('img');
        $filename = $uploadedFile->getClientOriginalName();
        Storage::disk('public')->putFileAs($filename, $uploadedFile, $filename);
        $post->image = $filename;
    }       
         //-------------
         
        $post->save();
        return redirect()->route('dashboard.admin.brands.manage')->with('info', 'ناشر جدید ایجاد شد و نام آن ' .' '. $request->input('name'));
    }

    public function GetManagePost(Request $request)
    {
        $posts = brand::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.brands.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = brand::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.brands.manage')->with('info', 'ناشر پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = brand::find($id);
        return view('dashboard.admin.brands.update', ['post' => $post, 'id' => $id]);
    }

    public function UpdatePost(Request $request)
    {
        $post = brand::find($request->input('id'));
        if (!is_null($post)) {
            $post->name = $request->input('name');
            $post->url = $request->input('url');
        }
            //--------------
            if($request->file('img') !=NULL){

            $uploadedFile = $request->file('img');
            $filename = $uploadedFile->getClientOriginalName();
            Storage::disk('public')->putFileAs($filename, $uploadedFile, $filename);
            $post->image = $filename;
           
            }

       $post->save();

        return redirect()->route('dashboard.admin.brands.manage',$post->id)->with('info', 'ناشر ویرایش شد');
    }
}