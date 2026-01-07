<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\User;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;
use App\Upload;
use App\Http\Requests\SplitsKeywords;

class UploadController extends Controller
{
    public function CreatePost(Request $request)
    {
        $post = new Upload();
    //--------------
        $uploadedFile = $request->file('file');
        $filename = $uploadedFile->getClientOriginalName();
        Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
        $post->link = $filename;
        $post->save();
        return redirect()->route('dashboard.admin.uploader.manage')->with('info', 'فایل جدید ذخیره شد' );
    }
    public function GetManagePost(Request $request)
    {
        $posts = Upload::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.uploader.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = Upload::find($id);
        $post->delete();
        return redirect()->back()->with('info', 'فایل پاک شد');
    }

}