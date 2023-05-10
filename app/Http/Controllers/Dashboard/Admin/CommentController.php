<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\User;
use App\comment;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{

    public function GetManagePost(Request $request)
    {
        $posts = comment::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.comment.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = comment::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.comment.manage')->with('info', 'نظر پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = comment::find($id);
        return view('dashboard.admin.comment.updatecomment', ['post' => $post, 'id' => $id]);
    }

    public function UpdatePost(Request $request)
    {
        $post = comment::find($request->input('id'));
        if (!is_null($post)) {
            $post->name = $request->input('name');
            $post->description = $request->input('content');
            $post->status = 'accept';

            $post->save();
        }
        return redirect()->route('dashboard.admin.comment.manage',$post->id)->with('info', 'نظر منتشر شد');
    }
}