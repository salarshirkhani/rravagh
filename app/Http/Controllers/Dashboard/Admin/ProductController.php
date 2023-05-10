<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\User;
use App\Category;
use App\brand;
use App\Upload;
use App\specification;
use App\color;
use App\product_color;
use App\product_tag;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\Admin\ProductStoreRequest;
use App\Http\Requests\Dashboard\Admin\ProductUpdateRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    public function GetCreatePost()
    {
        return view('dashboard.admin.product.create',[
        'categories' => Category::hierarchy() ,
        'brands' => brand::orderBy('created_at', 'desc')->get(),
        'colors' => color::orderBy('created_at', 'desc')->get() 
        ]);
    }

    public function CreatePost(Request $request)
    {
        $this->validate($request, [
            'img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => ['required', 'string', 'max:255'] ,
            'explain' => ['required'] ,
            'price' => ['required'] ,
            'inventory' => ['required'] ,
            'discount' => ['nullable'] ,
            'category' => ['required', 'string', 'max:255'] ,
            'brand' => ['required'],
            'discountable' => ['required'],
            'lovely' => ['nullable'],
            'cheap' => ['nullable'],
            'content' => ['required'],
        ]);

        $post = new product([
            'name' => $request->input('title'),
            'explain' => $request->input('explain'),
            'price' => $request->input('price'),
            'inventory' => $request->input('inventory'),
            'discount' => $request->input('discount'),
            'brand' => $request->input('brand'),
            'category'=>$request->input('category'),
            'lovely'=>$request->input('lovely'),
            'discountable'=>$request->input('discountable'),
            'cheap'=>$request->input('cheap'),
            'content' => $request->input('content'),
        ]);
        //----MAIN PIC
        if($request->hasfile('pic'))
        {
        $uploadedFile = $request->file('pic');
        $filename = $uploadedFile->getClientOriginalName();
   
        Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
        $post->pic = $filename;
        }
        $post->save();

        
        if($request->input('color')){
            //ADD COLORS
            foreach($request->input('color') as $item)
            {
                $color = new product_color([
                    'color_id' => $item,
                ]); 
                $color-> product()->associate($post);
                $color->save();
            }
        }

    //--------------IMAGE CONTROLLER
    if($request->hasfile('img'))
    {
        foreach($request->file('img') as $uploadedFile)
        {
            $image= new Upload();
            $filename = $uploadedFile->getClientOriginalName();
            Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
            $image->link= $filename;
            $image->product()->associate($post);
            $image->save();
        }    
    }   
    //-------------

        $idx = 1;
        if($request->input('specifications'))
        {
            foreach ($request->input('specifications') as $specification) {
                $spec = new specification($specification);
                $spec->order = $idx;
                $spec->product()->associate($post);
                $spec->save();

                $idx++;
            }
        }   

        $idx = 1;
        if($request->input('tags'))
        {
            foreach ($request->input('tags') as $tag) {
                $tags = new product_tag([
                    'name' => $tag['name'],
                ]);
                $tags->product()->associate($post);
                $tags->save();

                $idx++;
            }
        }  

        return redirect()->route('dashboard.admin.product.manage')->with('info', 'محصول جدید ایجاد شد و نام آن ' . $request->input('title'));
    }
    
    public function GetManagePost(Request $request)
    {
        $posts = product::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.product.manage', [
       'posts' => $posts,  
       'brands' => brand::orderBy('created_at', 'desc')->get() 
        ]);
    }

    public function DeletePost($id){
        $post = product::find($id);

        $specification = specification::where('product_id',$post->id)->get();
        foreach($specification as $item){
            $item->delete();
        }

        $product_color = product_color::where('product_id',$post->id)->get();
        foreach($product_color as $item){
            $item->delete();
        }

        $uploads = Upload::where('product_id',$post->id)->get();
        foreach($uploads as $item){
            $item->delete();
        }

        $post->delete();
        return redirect()->route('dashboard.admin.product.manage')->with('info', 'پست پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = product::find($id);
        return view('dashboard.admin.product.updatepost', [
        'post' => $post, 
        'id' => $id,
        'categories' => Category::hierarchy(),
        'brands' => brand::orderBy('created_at', 'desc')->get() ,
        'images' => Upload::where('product_id',$post->id)->get(), 
        'colors' => color::orderBy('created_at', 'desc')->get() ,
        'tags' => product_tag::where('product_id',$post->id)->orderBy('created_at', 'desc')->get(),
         ]);
    }

    public function UpdatePost(Request $request)
    {
        $post = product::find($request->input('id'));
        if (!is_null($post)) {
            
            $post->name = $request->input('title');
            $post->explain = $request->input('explain');
            $post->price = $request->input('price');
            $post->discount = $request->input('discount');
            $post->brand = $request->input('brand');
            $post->lovely = $request->input('lovely');
            $post->inventory = $request->input('inventory');
            $post->cheap = $request->input('cheap');
            $post->discountable = $request->input('discountable');
            $post->content = $request->input('content');
            $post->category = $request->input('category_id');
            //----MAIN PIC
            if($request->hasfile('pic'))
            {
                $uploadedFile = $request->file('pic');
                $filename = $uploadedFile->getClientOriginalName();
           
                Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
                $post->pic = $filename;
            }

            //--------------IMAGE CONTROLLER
            if($request->hasfile('img'))
            {
                foreach($request->file('img') as $uploadedFile)
                {
                    $image= new Upload();
                    $filename = $uploadedFile->getClientOriginalName();
                    Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
                    $image->link= $filename;
                    $image->product()->associate($post);
                    $image->save();
                }    
            } 
            
            $post->save();
          
            $idx = 1;
            if($request->input('tags'))
            {
                foreach ($request->input('tags') as $tag) {
                    $tags = new product_tag([
                        'name' => $tag['name'],
                    ]);
                    $tags->product()->associate($post);
                    $tags->save();

                    $idx++;
                }
            }  
          
            $colors=product_color::where('product_id',$request->input('id'))->get();
            foreach($colors as $item){
                    $item->delete();
            }
            //ADD COLORS
            
            if($request->input('color')){
            foreach($request->input('color') as $item)
            {

                $color = new product_color([
                    'color_id' => $item,
                    'product_id' => $request->input('id'),
                ]); 
                $color->save();
            }
            }
            
        }
        return redirect()->route('dashboard.admin.product.manage',$post->id)->with('info', 'محصول ویرایش شد');
    }
}