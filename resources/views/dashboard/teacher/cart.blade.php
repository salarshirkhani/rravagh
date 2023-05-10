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
    <h3 class="latesttitle">سبد <b>خرید</b></h3>
    <div class="container">
      <div class="shopholder">
        <table class="shoplis">
          <tr>
            <th class="pictureplace"> عکس</th>
            <th>نام</th>
            <th>تعداد</th>
            <th>قیمت تکی</th>
            <th>قیمت تعداد</th>
            <th class="lastone">وضعیت</th>
          </tr>
        </table>
      </div>
      <div class="shopholder">
        <table class="shoplis">

        @if(Cart::count() > 0)
        @foreach (Cart::content() as $item)          
            <tr>
            <th class="pictureplace"><img src="../images/119900674-removebg-preview 2.png" alt=""></th>
            <th><h6><br>{{$item->model->name}}</h6></th>
            <th><h6><br>{{$item->qty}}</h6></th>
            <th><p>{{$item->price}}</p>
              <h6>{{$item->price}}</h6></th>
            <th><p><?php echo $item->qty * $item->price ; ?></p>
              <h6><?php echo $item->qty * $item->price ; ?></h6></th>
            <th class="lastone"><h6 class="status"><br>موجود در سبد</h6></th>
          </tr>
        @endforeach    
        @endif
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
    @include('dashboard.teacher.sidebar')
@endsection
