<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\User;
use App\Product;
use App\teacher;
use App\Rules\JalaliDate;
use Hekmatinasser\Verta\Verta;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class BuyerController extends Controller
{
    public function getprofile() {
        $user=User::where('type','buyer')->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.buyer.index', [
        'user' => $user,
        ]);
    }

    public function getEditprofile($id) {
        $user=User::find($id);
        return view('dashboard.admin.buyer.edit', [
        'id'=>$id,
        'user'=>$user,
         ]);
    }

    public function DeletePost($id){
        $post = User::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.buyer.index')->with('info', 'کاربر پاک شد');
    }

    public function Editprofile(Request $request)
    {
        $post = User::find($request->input('id'));
        if (!is_null($post)) {
            $post->first_name = $request->input('first_name');
            $post->last_name = $request->input('last_name');
            $post->email = $request->input('email');
            $post->type = $request->input('type');
            $post->birthdate = Jalalian::fromFormat('Y/n/j', $request->input('birthdate'))->toCarbon()->format('Y/m/d');
            $post->mobile = $request->input('mobile');
            if($request->hasfile('pic'))
            {
            $uploadedFile = $request->file('pic');
            $filename = $uploadedFile->getClientOriginalName();
       
            Storage::disk('public')->putFileAs($filename, $uploadedFile, $filename);
            $post->profile = $filename;
            }
            $post->save();
        }
        return redirect()->route('dashboard.admin.buyer.index',$post->id)->with('info', 'اکانت کاربری  با موفقیت ویرایش شد');
    }

    public function Role(Request $request)
    {
        $post = User::find($request->input('user_id'));
        if (!is_null($post)) {
            $post->type = $request->input('role');
            $post->save();
            if($request->input('role') == 'teacher'){
                $teacher=teacher::where('user_id',$post->id)->FIRST();
                if($teacher==NULL){
                    $teacer = new teacher([
                        'user_id' => $post->id,
                    ]); 
                    $teacer->save();
                }
            }
        }
        return redirect()->route('dashboard.admin.users.index',$post->id)->with('info', 'اکانت کاربری  با موفقیت ویرایش شد');
    }
    
    public function getuser($id) {
        $user=User::find($id);
        $products=product::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.buyer.show', [
        'user' => $user,
        'id' => $id,
        'products' => $products,
        ]);
    }
       

}
 