<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\brand;
use App\teacher;
use App\academy;
use App\order;
use App\likes;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Auth;

class AcademyController extends Controller
{
    public function index() {

        return view('academy',[
        'teacher' => teacher::orderBy('created_at', 'desc')->get(),
        'brands' => brand::orderBy('created_at', 'desc')->get(),
        'categories' => Category::whereNull('parent_id')->with('allChildren')->get(),
        ]);

    }

    public function brands($id) {

        $brand= brand::find($id);
        return view('brand',[
        'academy' => teacher::orderBy('created_at', 'desc')->get(),
        'brand' => $brand,
        'teacher' => academy::orderBy('created_at', 'desc')->where('brand_id',$id)->get(),
        'categories' => Category::whereNull('parent_id')->with('allChildren')->get(),
        ]);

    }
}