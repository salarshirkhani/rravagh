<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function get() {
        switch (\Auth::user()->type) {
            case 'admin':
                return redirect()->route('dashboard.admin.index');
            case 'buyer':
                return redirect()->route('dashboard.customer.index');
            case 'seller':
                return redirect()->route('dashboard.buyer.index');
            case 'teacher':
                return redirect()->route('dashboard.teacher.index');
        }
        return redirect()->route('index');
    }
}
