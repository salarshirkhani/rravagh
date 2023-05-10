<?php
namespace App\Http\Controllers\Dashboard\Admin;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\User;
use App\transaction;
use App\order;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;


class TransactionController extends Controller
{
    public function GetManagePost(Request $request)
    {
        $posts = transaction::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.transaction.manage', [
       'posts' => $posts,  
        ]);
    }

    public function GetOrders(Request $request)
    {
        $posts = order::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.orders.manage', [
       'posts' => $posts,  
        ]);
    }

}