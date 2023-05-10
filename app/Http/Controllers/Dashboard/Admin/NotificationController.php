<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\User;
use App\notification;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
    public function GetCreatePost()
    {
        return view('dashboard.admin.notification.create');
    }

    public function CreatePost(Request $request)
    {
        $post = new notification([
            'title' => $request->input('title'),
            'explain' => $request->input('explain'),
            'role' => $request->input('role'),
            'status' => $request->input('status'),
            'content' => $request->input('content'),
        ]);
        //----MAIN PIC
        if($request->hasfile('img'))
        {
        $uploadedFile = $request->file('img');
        $filename = $uploadedFile->getClientOriginalName();
   
        Storage::disk('public')->putFileAs($filename, $uploadedFile, $filename);
        $post->pic = $filename;
        }
         
        $post->save();
        return redirect()->route('dashboard.admin.notification.create')->with('info', '  اعلان جدید ذخیره شد و نام آن' .' '. $request->input('title'));
    }
    public function GetManagePost(Request $request)
    {
        $posts = notification::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.notification.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = notification::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.notification.manage')->with('info', 'اعلان پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = notification::find($id);
        return view('dashboard.admin.notification.updatenotification', ['post' => $post, 'id' => $id]);
    }

    public function UpdatePost(Request $request)
    {
        $post = notification::find($request->input('id'));
        if (!is_null($post)) {
            $post->name = $request->input('title');
            $post->explain = $request->input('explain');
            $post->slug = $request->input('role');
            $post->status = $request->input('status');
            $post->content = $request->input('content');
            //----MAIN PIC
            if($request->hasfile('img'))
            {
            $uploadedFile = $request->file('img');
            $filename = $uploadedFile->getClientOriginalName();
    
            Storage::disk('public')->putFileAs($filename, $uploadedFile, $filename);
            $post->pic = $filename;
            }
            $post->save();
        }
        return redirect()->route('dashboard.admin.notification.updatenotification',$post->id)->with('info', 'اعلان ویرایش شد');
    }
}