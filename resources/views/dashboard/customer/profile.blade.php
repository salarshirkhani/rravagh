@extends('layouts.panel')
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.customer.index" />
@endsection
@section('panel')

        <div class="col-md-6">
          <h3 class="pagetitle">خانه</h3>
        </div>
      </div>
    </div>
    <h3 class="latesttitle">ویرایش <b>پروفایل</b></h3>
    <div class="container">
      <div class="shopholder">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
                    @if(Session::has('info'))
                        <div class="row">
                            <div class="col-md-12">
                                <p class="alert alert-info">{{ Session::get('info') }}</p>
                            </div>
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="col-md-12">
                                <p class="alert alert-danger">{{ $error }}</p>
                            </div>
                        @endforeach
                    @endif
		<form style="padding:15px;" action="{{ route('dashboard.customer.profile.edit') }}" method="post" role="form" class="form-horizontal" autocomplete="off" enctype="multipart/form-data">
            <label for="first_name">نام </label> 
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="first_name" value="{{Auth::user()->first_name}}"  placeholder="نام">  
            <label for="last_name">نام خانوادگی</label> 
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="last_name" value="{{Auth::user()->last_name}}"  placeholder="نام خانوادگی">
            <label for="account">شماره شبا</label> 
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" autocomplete="off" name="account" value="{{Auth::user()->account}}"  placeholder="شماره شبا خود را به صورت دقیق وارد کنید">  
			@isset(Auth::user()->melli)
            <p style="margin:20px 0px; color:orange">کد ملی نوشته شده توسط شما {{Auth::user()->melli}} می باشد در صورت تمایل به تغییر لطفا با ما تماس بگیرید</p>
            @else
            <label for="melli">کد ملی</label> 
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" autocomplete="off" name="melli" value="{{Auth::user()->melli}}"  placeholder="کد ملی">        
          	@endisset
          <input type="hidden" name="id" value="{{Auth::user()->id}}">
            <label for="pic">ویرایش عکس پروفایل</label>
            <input type="file" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;" class="dropzone"  name="pic" >
          
          <div style="margin-top:50px;"></div>
          <p>جهت تمایل به تغیر رمز عبور خود کادر های پایین را پر کنید در غیر این صورت دو کادر پایین را خالی بگذارید</p>
           <input type="password" name="password" class="form-control"  placeholder="کلمه عبور" id="id_password" autocomplete="off">
           <input type="password" name="password_confirmation" class="form-control"  placeholder="تکرار کلمه عبور" id="id_password_confirmation">
            <script type="text/javascript">
                    Dropzone.options.dropzone =
                    {
                        maxFilesize: 12,
                        renameFile: function(pic) {
                            var dt = new Date();
                            var time = dt.getTime();
                            return time+pic.name;
                        },
                        acceptedFiles: ".jpeg,.jpg,.png,.gif",
                        addRemoveLinks: true,
                        timeout: 500000,
                        success: function(pic, response)
                        {
                            console.log(response);
                        },
                        error: function(pic, response)
                        {
                            return 1;
                        }
                    };
            </script>
             {{ csrf_field() }}
     
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px; background: #ffe700;"  class="checkout-button">ارسال</button>
 
            </form>
      </div>



      <div class="latestfoot">
        <div class="footcol1">
              <h5>تعداد کل <b>خریدهای شما</b></h5>
              <h5><b>{{$orders->count()}}</b><br>عدد</h5>
            </div>
            @isset($discount) 
              <div class="footcol2">
                <h5><b> کد تخفیف</b> برای خرید بعدی</h5>
                <p>اعتبار تا تاریخ {{ Facades\Verta::instance($discount->finish_date)->format('Y/n/j')}}</p>
                <h5><b> {{$discount->code}}</b></h5>
                <p>%{{$discount->discount}} </p>
              </div> 
            @endisset 
        </div>
    </div>
  </div>
    @include('dashboard.customer.sidebar')
@endsection
