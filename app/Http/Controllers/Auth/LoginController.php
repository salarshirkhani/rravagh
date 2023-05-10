<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Mews\Captcha;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'captcha' => 'required|Captcha',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        // Add your own logic here if you need to customize the login attempt
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }
    
    public function login(Request $request)
    {
        $this->validator($request->all())->validate();

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }
}

