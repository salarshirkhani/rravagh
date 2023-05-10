@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
<x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
<x-breadcrumb-item title="کاربران" route="dashboard.admin.users.index" />
<x-breadcrumb-item title="ویرایش کاربری" route="dashboard.admin.users.edit" />
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
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>ویرایش کاربر ها</x-card-header>
        <form style="padding:15px;" action="{{ route('dashboard.admin.users.ediit', $user->id) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="first_name" value="{{$user->first_name}}"  placeholder="نام">  
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="last_name" value="{{$user->last_name}}"  placeholder="نام خانوادگی">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="email" value="{{$user->email}}"  placeholder="ایمیل">  
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" name="mobile" value="{{$user->mobile}}"  placeholder="موبایل">  
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
                  <input id="date" name="birthdate" value="{{ Facades\Verta::instance($user->birthdate)->format('Y/n/j')}}" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
                </div>
                <!-- /.input group -->
            </div>
             <input type="hidden" name="id" value="{{$user->id}}">
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
    <script type="text/javascript">
        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                renameFile: function(national_pic) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+national_pic.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 500000,
                success: function(national_pic, response)
                {
                    console.log(response);
                },
                error: function(national_pic, response)
                {
                    return 1;
                }
            };
        </script>
    @endsection