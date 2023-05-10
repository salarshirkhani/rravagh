@extends('layouts.auth')

@section('content')



    <form class="login100-form validate-form" action="{{ route('login') }}" method="POST">

        @csrf
        <span class="login100-form-title"> ورود به حساب</span>
            @if ($errors->any())

                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
        
             @endif
        <div class="wrap-input100 validate-input" data-validate="ایمیل اجباری است!">
            <input type="email" name="email" maxlength="100" class=" input100" placeholder="ایمیل" required=""
                   id="id_email" value="{{ old('email') ?? '' }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
        </div>

-
        <div class="wrap-input100 validate-input" data-validate="رمزعبور اجباری است!">
            <input type="password" name="password" class=" input100" placeholder="کلمه‌عبور" id="id_password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
			    <i class="fa fa-lock" aria-hidden="true"></i>
			</span>
        </div>
        <!--  CAPTCHA   -->
        <div style="border: 1px solid rgb(160, 160, 255); border-radius:10px; padding:7px;">
            <img src="{!!Captcha::src('default')!!}" style="width:60%; display:block; margin-left:auto; margin-right:auto; margin-bottom:5px;">
            <div class="wrap-input100 validate-input" data-validate="کپچا به درستی وارد نشده است">
                <input type="text" name="captcha" class=" input100" placeholder="کد کپچا" id="id_capctha" required>
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </span>
            </div>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                ورود
            </button>
        </div>

        {{--        <div class="text-center p-t-12">--}}
        {{--            <a class="txt2" href="#">--}}
        {{--                رمزعبور خود--}}
        {{--            </a>--}}
        {{--            <span class="txt1">--}}
        {{--							را فراموش کرده‌اید؟--}}
        {{--						</span>--}}
        {{--        </div>--}}

        <div class="text-center p-t-136">
            <a class="txt2" href="{{ route('register') }}">
                {{ __('میخواهید ثبت‌نام کنید؟') }}
                <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
            </a>
            <br>
            <a class="txt2" href="{{ route('password.request') }}">
                {{ __('رمز خود را فراموش کرده‌اید؟') }}
                <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
            </a>
            <br>

        </div>
    </form>
@endsection
