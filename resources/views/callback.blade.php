@extends('layouts.frontt')
@section('content')
    <style>
        .daste {
            width: 100%;
        }
    </style>
<section class="content">
<div class="container">
    <div class="whereareyou">
        <a href="">صفحه اصلی</a> > <a href="#">نتیجه پرداخت</a> 
    </div>

@if(Session::get('info')=='notpaid')
    <div class="payfailed">
        <img src="{{ asset('img/close_ring.svg')}}" alt="">
        <h3>متاسفانه مشکلی پیش آمده است</h3>
        <div class="daste">
            <a href="{{route('/')}}" class="group">بازگشت به پنل کاربری</a>
        </div>
    </div>
@else
    <div class="paysuccess">
        <img src="{{ asset('img/check_ring_round.svg')}}" alt="">
        <h3>پرداخت با موفقیت انجام شد</h3>
        <p>کد پرداخت: {{ $transaction->transaction}}</p>
        <div class="daste">
            <a href="{{route('/')}}" class="group">بازگشت به پنل کاربری</a>
        </div>
    </div>
@endif
</div>
</section>
@endsection