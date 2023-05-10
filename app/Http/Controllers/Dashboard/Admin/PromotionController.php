<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\promote;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{

    public function GetManagePost(Request $request)
    {
        $posts = promote::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.promotion.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = promote::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.promotion.manage')->with('info', 'ارسالی پاک شد');
    }

}