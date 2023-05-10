<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Post;
use App\movies;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\User;
use App\Category;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;
use App\movie_tag;

class MoviesController extends Controller
{
    public function GetCreatePost()
    {
        return view('dashboard.admin.movies.create',[
            'categories' => Category::where('type','movie')->orderBy('created_at', 'desc')->get() ,
            ]);
    }

    public function CreatePost(Request $request)
    {


        $post = new movies([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'category'=>$request->input('category'),
            'year' => $request->input('year'),
            'duaration' => $request->input('duaration'),
            'status' => 'publish',
            'trailer' => $request->input('trailer'),
        ]);
        //----MAIN PIC
              if($request->hasfile('img'))
              {
              $uploadedFile = $request->file('img');
              $filename = $uploadedFile->getClientOriginalName();
      
              Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
              $post->image = $filename;
              }
        //-----------

        //----MAIN PIC
                if($request->hasfile('movie'))
                {
                $uploadedFile = $request->file('movie');
                $filename = $uploadedFile->getClientOriginalName();
        
                Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
                $post->link = $filename;
                }
        //-----------
        $post->save();

        $idx = 1;
        if($request->input('tags'))
        {
            foreach ($request->input('tags') as $tag) {
                $tags = new movie_tag([    
                    'name' => $tag['name'],
                ]);
                $tags->post()->associate($post);
                $tags->save();

                $idx++;
            }
        }  

        return redirect()->route('dashboard.admin.movies.create')->with('info', '  پست جدید ذخیره شد و نام آن' . $request->input('title'));
    }
    public function GetManagePost(Request $request)
    {
        $posts = movies::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.movies.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = movies::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.movies.manage')->with('info', 'فیلم پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = movies::find($id);
        return view('dashboard.admin.movies.updatepost', [
        'post' => $post, 
        'id' => $id,
        'tags' => movie_tag::where('movie_id',$post->id)->orderBy('created_at', 'desc')->get(),            
        'categories' => Category::where('type','movie')->orderBy('created_at', 'desc')->get() ,
    ]);
    }

    public function UpdatePost(Request $request)
    {
        $post = movies::find($request->input('id'));
        if (!is_null($post)) {
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->slug = $request->input('slug');
            $post->year = $request->input('year');
            $post->duaration = $request->input('duaration');
            $post->trailer = $request->input('trailer');
            $post->category = $request->input('category_id');

            //----MAIN PIC
            if($request->hasfile('img'))
            {
            $uploadedFile = $request->file('img');
            $filename = $uploadedFile->getClientOriginalName();
    
            Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
            $post->image = $filename;
            }

            if($request->hasfile('movie'))
            {
            $uploadedFile = $request->file('movie');
            $filename = $uploadedFile->getClientOriginalName();
    
            Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
            $post->link = $filename;
            }
            $post->save();
            
        $idx = 1;
        if($request->input('tags'))
        {
            foreach ($request->input('tags') as $tag) {
                $tags = new movie_tag([    
                    'name' => $tag['name'],
                ]);
                $tags->post()->associate($post);
                $tags->save();

                $idx++;
            }
        } 
        }
        return redirect()->route('dashboard.admin.movies.update',$post->id)->with('info', 'فیلم ویرایش شد');
    }
}