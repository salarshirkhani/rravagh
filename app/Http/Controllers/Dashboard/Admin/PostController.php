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
use App\post_tag;

class PostController extends Controller
{
    public function GetCreatePost()
    {
        return view('dashboard.admin.news.create');
    }

    public function CreatePost(Request $request)
    {
        $post = new post([
            'title' => $request->input('title'),
            'explain' => $request->input('explain'),
            'slug' => $request->input('slug'),
            'writer' => $request->input('writer'),
            'iframe' => $request->input('iframe'),
            'content' => $request->input('content'),
        ]);
        //----MAIN PIC
              if($request->hasfile('img'))
              {
              $uploadedFile = $request->file('img');
              $filename = $uploadedFile->getClientOriginalName();
      
              Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
              $post->pic = $filename;
              }
        //-----------
        $post->save();

        $idx = 1;
        if($request->input('tags'))
        {
            foreach ($request->input('tags') as $tag) {
                $tags = new post_tag([    
                    'name' => $tag['name'],
                ]);
                $tags->post()->associate($post);
                $tags->save();

                $idx++;
            }
        }  

        return redirect()->route('dashboard.admin.news.create')->with('info', '  پست جدید ذخیره شد و نام آن' . $request->input('title'));
    }
    public function GetManagePost(Request $request)
    {
        $posts = post::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.news.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = post::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.news.manage')->with('info', 'پست پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = post::find($id);
        return view('dashboard.admin.news.updatepost', ['post' => $post, 'id' => $id,'tags' => post_tag::where('post_id',$post->id)->orderBy('created_at', 'desc')->get(),]);
    }

    public function UpdatePost(Request $request)
    {
        $post = post::find($request->input('id'));
        if (!is_null($post)) {
            $post->title = $request->input('title');
            $post->explain = $request->input('explain');
            $post->slug = $request->input('slug');
            $post->iframe = $request->input('iframe');
            $post->writer = $request->input('writer');
            $post->content = $request->input('content');
            //----MAIN PIC
            if($request->hasfile('img'))
            {
            $uploadedFile = $request->file('img');
            $filename = $uploadedFile->getClientOriginalName();
    
            Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
            $post->pic = $filename;
            }
            $post->save();
        $idx = 1;
        if($request->input('tags'))
        {
            foreach ($request->input('tags') as $tag) {
                $tags = new post_tag([    
                    'name' => $tag['name'],
                ]);
                $tags->post()->associate($post);
                $tags->save();

                $idx++;
            }
        } 
        }
        return redirect()->route('dashboard.admin.news.updatepost',$post->id)->with('info', 'پست ویرایش شد');
    }
}