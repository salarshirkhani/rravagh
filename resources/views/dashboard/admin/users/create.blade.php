@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
<x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
<x-breadcrumb-item title="کاربران" route="dashboard.admin.users.index" />
<x-breadcrumb-item title="ساخت کاربر جدید" route="dashboard.admin.users.create" />
@endsection
@section('content')
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
<div class="wrap-messages">
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
</div>
@endif
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>ایجاد کاربر جدید</x-card-header>
        <form style="padding:15px;" action="{{ route('dashboard.admin.users.create') }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="first_name" placeholder="نام">  
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="last_name"  placeholder="نام خانوادگی">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="email"  placeholder="ایمیل">  
            <input type="password" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="password"  placeholder="رمز عبور">  
            <input type="password" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="password_confirmation"  placeholder="تکرار رمز">  
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="mobile"   placeholder="موبایل">  
            <x-select-group name="type" label="نوع کاربری" required :model="$model ?? null">
                <x-select-item value="buyer">خریدار</x-select-item>
                <x-select-item value="teacher">مدرس</x-select-item>
                <x-select-item value="seller">خریدار عمده</x-select-item>
                <x-select-item value="admin">ادمین</x-select-item>
            </x-select-group> 
            <div class="form-group">
                <label>تاریخ تولد:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input id="date" name="birthdate" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
                </div>
                <!-- /.input group -->
            </div>
            <input type="file" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;" class="dropzone"  name="pic" >
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
             <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-primary">ارسال</button>
             </x-card-footer>
            </form>
    </x-card>
    </div>
    @endsection