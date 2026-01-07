@extends('layouts.frontt')
@section('content')
<div class="container-fluid">
    <div class="formcont">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <form action="{{route('message')}}" method="post" class="contactform">
                    <h1 class="formtitle"><b>تماس با ما</b></h1>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-lg-6">
                            <label for="urpost"><h4>سمت شما</h4></label><br>
                            <input id="urpost" name="urpost" type="text" placeholder="مثلا: فروشنده" required="">
                        </div>
                        <div class="col-md-12 col-lg-6 col-xs-12">
                            <label for="name"><h4>نام و نام خانوادگی شما</h4></label><br>
                            <input id="name" name="name" type="text" placeholder="مثلا: پارسا نیک صفت" required="">   	
                        </div>
                    </div>
                    <div class="row">
                        <div class="formrow2">
                            <div class="col-md-12 col-xs-12 col-lg-6 col-6">
                                <input type="radio" id="email" name="mailorphone" onclick="phoneormail()">
                                <span class="checkmark"></span>
                                <label for="email" class="radiolabel"><h4>ایمیل</h4></label>
                            </div>
                            <div class="col-md-12 col-xs-12 col-lg-6 col-6">
                                <input type="radio" checked="" id="phonenum" name="mailorphone" onclick="phoneormail()">
                                <span class="checkmark"></span>
                                <label for="phonenum" class="radiolabel"><h4>شماره تماس</h4></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="formrow">
                            <div class="col-md-12 col-xs-12 col-lg-12 col-12">
                                <label for="urphone" id="urphonelabel"><h4>شماره تماس</h4></label>
                                <input type="text" id="urphone" name="urphone" placeholder="مثلا: 09121111111">
                                <label for="urmail" id="urmaillabel" style="display:none;"><h4>ایمیل شما</h4></label>
                                <input type="email" id="urmail" name="urmail" placeholder="مثلا: abc@def.ghi" style="display: none;"><br>
                            </div>
                        </div>
                    </div>
                    @csrf   
                    <input type="submit" class="toastrDefaultInfo" value="برقراری تماس">
                </form>
            </div>
            <div class="col-lg-6 col-md-12">
            <div class="contact-image">
                <img src="img/contact 1.png" alt="">
            </div>
        </div>
        </div>
    </div>
</div>
@endsection