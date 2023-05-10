<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\User;
use App\contact;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{

    public function GetManagePost(Request $request)
    {
        $posts = contact::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.contact.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = contact::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.contact.manage')->with('info', 'تماس پاک شد');
    }

}