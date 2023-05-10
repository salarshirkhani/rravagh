@extends('layouts.panel')
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.customer.index" />
@endsection
@section('panel')
<style>
  .checkout-button{
	text-decoration: none;
	color: inherit;
	margin: 0 20px;
	background-color: gold;
	border: 1px solid transparent;
	padding: 20px 25px;
	border-radius: 5px;
	transition: 0.5s;
	position: relative;
    top: 45px;
  }
  .checkout-button:hover{
	text-decoration: none;
  	color: inherit;
	box-shadow: 1px 1px 20px 0.2px #ffd700b0;
    background: transparent;
    border: 1px solid gold;
  }
</style>

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
            <th class="pictureplace"><img src="{{ asset('pics/'.$item->model->pic.'/'.$item->model->pic ) }}" alt=""></th>
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
        <a href="{{route('cart')}}" class="checkout-button">پرداخت</a>

 
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
