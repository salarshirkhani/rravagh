@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="افزودن تخفیف " route="dashboard.admin.brands.create" />
@endsection
@section('content')
@if ($errors->any())
<div class="wrap-messages">
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
</div>
@endif
@if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>افزودن کد تخفیف جدید</x-card-header>
        <form style="padding:10px;" action="{{ route('dashboard.admin.discount.create') }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="code"  placeholder="کد تخفیف">            
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required name="discount"  placeholder="درصد تخفیف ">


            <x-select-group name="user_type" label="نوع کاربران" required :model="$model ?? null">
                    <x-select-item value="everybody">همه کاربران</x-select-item>
                    <x-select-item value="users">خریداران عمده</x-select-item>
            </x-select-group>

            <x-select-group name="discount_type" label="مدل تخفیف" required :model="$model ?? null">
                <x-select-item value="product">محصولات</x-select-item>
                <x-select-item value="subscribe">اشتراک</x-select-item>
             </x-select-group>
             <div class="form-group">
                <label>تاریخ پایان:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input name="finish_date" type="text" id="date1" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
                </div>
                <!-- /.input group -->
            </div>
            {{ csrf_field() }}
             <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-primary">ارسال</button>
             </x-card-footer>
            </form>
    </x-card>
    </div>
    @endsection