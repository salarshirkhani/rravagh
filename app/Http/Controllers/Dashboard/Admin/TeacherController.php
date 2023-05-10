<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\User;
use App\Product;
use App\teacher;
use App\brand;
use App\academy;
use App\Rules\JalaliDate;
use Hekmatinasser\Verta\Verta;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function getprofile() {
        $user=User::where('type','teacher')->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.teachers.index', [
        'user' => $user,

        ]);
    }

    public function getEditprofile($id) {
        $user=User::find($id);
        $teacher=teacher::where('user_id',$id)->FIRST();
        return view('dashboard.admin.teachers.edit', [
        'id'=>$id,
        'user'=>$user,
        'teacher'=>$teacher,
         ]);
    }

    public function DeletePost($id){
        $post = User::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.teachers.index')->with('info', 'کاربر پاک شد');
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
        $teacher=teacher::where('user_id',$request->input('id'))->FIRST();
        if($teacher===NULL){
            $teacher = new teacher([
                'user_id' => $request->input('id'),
                'level' => $request->input('level'),
                'instagram' => $request->input('instagram'),
                'description' => $request->input('description'),
            ]); 
        }
        else{
            $teacher->level = $request->input('level');
            $teacher->instagram = $request->input('instagram');
            $teacher->description = $request->input('description');
        }
        $teacher->save();   
        return redirect()->route('dashboard.admin.teachers.index',$request->input('id'))->with('info', 'اکانت کاربری  با موفقیت ویرایش شد');
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
        $teacher=teacher::where('user_id',$user->id)->FIRST();
        return view('dashboard.admin.teachers.show', [
        'user' => $user,
        'id' => $id,
        'teacher'=>$teacher,
        'brands' => brand::orderBy('created_at', 'desc')->get(),
        'academy' => academy::orderBy('created_at', 'desc')->where('user_id',$user->id)->get(),
        ]);
    }
       
    public function brand(Request $request)
    {
        $post = new academy([
            'brand_id' => $request->input('brand'),
            'user_id' => $request->input('id'),
        ]);
        $post->save();
        return redirect()->back()->with('info', ' برند جدید اضافه شد' );
    }

    public function deletebrand($id){
        $post = academy::find($id);
        $post->delete();
        return redirect()->back()->with('info', 'برند پاک شد');
    }
}
 