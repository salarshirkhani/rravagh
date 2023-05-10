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
    <h3 class="latesttitle">لیست خرید <b>آینده</b></h3>
    <div class="container">
      <div class="shopholder">
        <table class="shoplis">
          <tr>
            <th class="pictureplace"> عکس</th>
            <th>نام</th>
            <th>قیمت تکی</th>
            <th>قیمت در صورت تخفیف</th>
            <th class="lastone">مشاهده</th>
          </tr>
        </table>
      </div>
      <div class="shopholder">
        <table class="shoplis">

        @foreach ($likes as $item)          
            <tr>
            <th class="pictureplace"><img src="{{ asset('pics/'.$item->for->pic.'/'.$item->for->pic ) }}" style="width:65px; height:65px;" alt="{{$item->for->name}}"></th>
            <th><p>{{$item->for->name}}</p></th>
            <th><p>{{$item->for->price}}</p></th>
            <th><p>@if($item->for->discount != NULL) {{$item->for->discount}} @else بدون تخفیف @endif</p>
            <th class="lastone"><a class="btn btn-warning" target="_blank" href="{{route('product',['id'=>$item->product_id])}}">مشاهده محصول</a></th>
          </tr>
        @endforeach    
        </table>
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
