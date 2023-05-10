@extends('layouts.panel')
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.buyer.index" />
@endsection
@section('panel')

        <div class="col-md-6">
          <h3 class="pagetitle">خانه</h3>
        </div>
      </div>
    </div>
    <h3 class="latesttitle">آخرین <b>خریدها</b></h3>
    <div class="container">
      <div class="shopholder">
        <table class="shoplis">
          <tr>
            <th class="pictureplace"> عکس</th>
            <th>نام</th>
            <th>قیمت تکی</th>
            <th>کد پرداخت</th>
            <th class="lastone">وضعیت</th>
          </tr>
        </table>
      </div>
      <div class="shopholder">
        <table class="shoplis">

        @foreach ($orders as $item)          
            <tr>
            <th class="pictureplace"><img src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" style="width:250px; height:250px;" alt="{{$item->for->name}}"></th>
            <th><p>{{$item->for->name}}</p></th>
            <th><p>{{$item->for->price}}</p></th>
            <th><p>@if($item->transaction_id != NULL) {{$item->transaction->transaction}} @else پرداخت نشده @endif</p>
            <th class="lastone"><h6 class="status"><br>@if($item->status == 'success')موفق @else <p style="color:red">نا موفق</p> @endif</h6></th>
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
                <h5><b>کد تخفیف</b>برای خرید بعدی</h5>
                <p>اعتبار تا تاریخ {{ Facades\Verta::instance($discount->finish_date)->format('Y/n/j')}}</p>
                <h5><b> {{$discount->code}}</b></h5>
                <p>{{$discount->discount}}</p>
              </div> 
            @endisset 
        </div>
    </div>
  </div>
    @include('dashboard.buyer.sidebar')
@endsection
