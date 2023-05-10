@extends('layouts.panel')
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.teacher.index" />
@endsection
@section('panel')

        <div class="col-md-6">
          <h3 class="pagetitle">خانه</h3>
        </div>
      </div>
    </div>
    <h3 class="latesttitle">{{$notifi->title}}</h3>
    <div class="container">
      <div style="font-size: 22px; text-align:right;">
      {!!$notifi->content!!}
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
  @include('dashboard.teacher.sidebar')
  @endsection
