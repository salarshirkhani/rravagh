<?php

namespace App\Http\Controllers\Dashboard\Admin;
use App\Product;
use App\User;
use App\Category;
use App\comment;
use App\Rules\JalaliDate;
use Hekmatinasser\Verta\Verta;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use App\transaction;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    public function get() {

        $transaction=transaction::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
           // return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $transac=transaction::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y'); // grouping by years
        });

        $transa=transaction::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('d'); // grouping by days
        });

        return view('dashboard.admin.index',[
            'categories' => Category::hierarchy() ,
            'Product' => Product::orderBy('created_at', 'desc')->get(),
            'user' => User::orderBy('created_at', 'desc')->get(),
            'transactionm' => $transaction,
            'transac' => $transac,
            'transa' => $transa,
            'birth'=>User::birthDayBetween(Carbon::now(), Carbon::now()->addWeek())->get(),
            'comments' => comment::orderBy('created_at', 'desc')->LIMIT(5)->get(),
            ]);
    }
}
