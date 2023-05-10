@extends('layouts.frontt')
@section('content')
<script>
function validateForm() {
  let x = document.forms["myForm"]["city"].value;
  if (x == "") {
    return false;
  }
    let x = document.forms["myForm"]["city"].value;
  if (x == "") {
    return false;
  }
    let x = document.forms["myForm"]["region"].value;
  if (x == "") {
    return false;
  }
    let x = document.forms["myForm"]["address"].value;
  if (x == "") {
    return false;
  }
    let x = document.forms["myForm"]["postcode"].value;
  if (x == "") {
    return false;
  }
      let x = document.forms["myForm"]["phone"].value;
  if (x == "") {
    return false;
  }
}
</script>
<div class="container">
    @if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info" style="text-align: right; direction:rtl;">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
    <div class="row">
        <div class="col-md-6">
            <div class="formpl">
               <form name="myForm" action="{{route('payment.pay')}}"  id="pay" method="POST">
                   <input type="hidden" value="{{$price}}" name="price" >
                   <input type="hidden" value="{{$copon}}" name="discount" >
                   <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label for="city">شهر</label><br>
                        <input type="text" name="city" id="city" required>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="region">استان</label><br>
                        <input type="text" name="region" id="region" required>
                    </div>
                    </div>
                    <div class="col-md-12">
                        <label for="address">آدرس</label><br>
                        <input type="text" name="address" id="address" required>
                    </div>
                    <div class="col-md-12">
                        <label for="postcode">کدپستی</label><br>
                        <input type="number" name="postcode" id="postcode" required>
                    </div>
                    <div class="col-md-12">
                        <label for="phone">تلفن جهت تماس ضروری</label><br>
                        <input type="phone" name="phone" id="phone" required>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="checkouttbl">
                <h2 class="sumtitle">جمع کل سبد خرید</h2>
                <div class="sumtablepl">
                    <table class="sumtable">
                        <tr>
                            <th>جمع جزء</th>
                            <td data-title="جمع جزء"><p>{{Cart::subtotal()}}</p></td>
                        </tr>
                        <tr>
                            <th>هزینه ارسال</th>
                            <td data-title="جمع جزء"><p>20,000 تومان</p></td>
                        </tr>
                        <tr class="order-total">
                            <th>مجموع</th>
                            <td data-title="مجموع"><p>{{$price }} تومان</p></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="col-md-12">
                                    <input type="radio" id="paymentmethod1" value="1" name="mailorphone">
                                    <label for="paymentmethod1">درگاه پرداخت زرین پال</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>         
                

                <div class="proceed-to-checkout">
                    <button onclick="document.getElementById('pay').submit();"  class="checkout-button">ثبت سفارش</button>
                </div>
            </div>
      </div>
    </div>
</div>
@endsection