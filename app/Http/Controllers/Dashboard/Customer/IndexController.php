<?php
namespace App\Http\Controllers\Dashboard\Customer;
use App\Category;
use App\likes;
use App\order;
use App\discounts;
use App\notification;
use Carbon\Carbon;
use App\code;
use App\User;
use App\subscribe;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function get() {
        return view('dashboard.customer.index', [
            'categories' => Category::all(),
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),
            'code' => code::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->FIRST(),      
			'subscribe' =>  $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST(),  
        ]);
    }

    public function cart(){
        return view('dashboard.customer.cart',[
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(),
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),
            'code' => code::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->FIRST(),    
			'subscribe' =>  $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST(),

        ]);
    }

    public function likes(){

        return view('dashboard.customer.likes',[
            'likes' => likes::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),
            'code' => code::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->FIRST(),      
			'subscribe' =>  $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST(),
        ]);
    }

    public function notification($id){
        return view('dashboard.customer.notification',[
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),
            'notifi'=>notification::find($id),
            'code' => code::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->FIRST(),      
			'subscribe' =>  $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST(),
        ]);
    }
  
   public function profile(){
        return view('dashboard.customer.profile',[
            'discount' => discounts::where('user_id' , Auth::user()->id)->FIRST(), 
            'orders' => order::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->get(),      
            'notification' =>notification::where('role',Auth::user()->type)->orWhere('role','all')->orderBy('created_at', 'desc')->get(),
            'code' => code::where('user_id' , Auth::user()->id)->orderBy('created_at', 'desc')->FIRST(),      
			'subscribe' =>  $subscribe= subscribe::where('status' , 'new')->where('user_id' , Auth::user()->id)->where('finish_date' , '!=' , NULL)->where('finish_date','>',carbon::now())->orderBy('created_at', 'desc')->FIRST(),
        ]);
    }
  
    public function Editprofile(Request $request)
    {
        $this->validate($request, [
            'pic.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'melli' => ['nullable','numeric', 'min:8','max:9999999999', 'unique:users'],
            'account' => ['nullable','string', 'min:8', 'max:35'],
            'id' => ['required','exists:users,id'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
        $post = User::find($request->input('id'));
        
        if (!is_null($post)) {
            $post->first_name = $request->input('first_name');
            $post->last_name = $request->input('last_name');
         	$post->account = $request->input('account');
            if (!empty($request->input('melli')))
            	$post->melli = $request->input('melli');
            if (!empty($request->input('password')))
            	$post->password = Hash::make($request->input('password'));
            if($request->hasfile('pic'))
            {
            $uploadedFile = $request->file('pic');
            $filename = $uploadedFile->getClientOriginalName();
       
            Storage::disk('local')->putFileAs($filename, $uploadedFile, $filename);
            $post->profile = $filename;
            }
            $post->save();
        }

        return redirect()->route('dashboard.customer.profile')->with('info', 'اکانت کاربری  با موفقیت ویرایش شد');
    }
}
