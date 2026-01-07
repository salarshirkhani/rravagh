<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\page;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use Illuminate\Session\Store;
use App\User;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;
use App\page_tag;

class PageController extends Controller
{
    public function GetCreatePost()
    {
        return view('dashboard.admin.page.create',[
            'categories' => Category::where('type','post')->orderBy('created_at', 'desc')->get() ,
        ]);
    }

    public function CreatePost(Request $request)
    {
        $post = new page([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
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
                $tags = new page_tag([    
                    'name' => $tag['name'],
                ]);
                $tags->post()->associate($post);
                $tags->save();

                $idx++;
            }
        }  

        return redirect()->route('dashboard.admin.page.create')->with('info', '  لندینگ جدید ذخیره شد و نام آن' . $request->input('title'));
    }
    public function GetManagePost(Request $request)
    {
        $posts = page::orderBy('created_at', 'desc')->get();

        return view('dashboard.admin.page.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = page::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.page.manage')->with('info', 'لندینگ پاک شد');
    }

    public function DeleteTag($id){
        $item = page_tag::find($id);
        $item->delete();
        return redirect()->back()->with('info', 'تگ پاک شد');
    }


    public function GetEditPost($id)
    { 
        $post = page::find($id);
        return view('dashboard.admin.page.updatepost', ['post' => $post, 'id' => $id,
        'tags' => page_tag::where('post_id',$post->id)->orderBy('created_at', 'desc')->get(),
        'categories' => Category::where('type','post')->orderBy('created_at', 'desc')->get() ,
        ]);
    }

    public function UpdatePost(Request $request)
    {
        $post = page::find($request->input('id'));
        if (!is_null($post)) {
            $post->title = $request->input('title');
            $post->explain = $request->input('explain');
            $post->slug = $request->input('slug');
            $post->iframe = $request->input('iframe');
            $post->writer = $request->input('writer');
            $post->content = $request->input('content');
            $post->category = $request->input('category');
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
                    $tags = new page_tag([    
                        'name' => $tag['name'],
                    ]);
                    $tags->post()->associate($post);
                    $tags->save();
    
                    $idx++;
                }
            } 
        }
        return redirect()->route('dashboard.admin.page.updatepost',$post->id)->with('info', 'لندینگ ویرایش شد');
    }
}