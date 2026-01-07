@extends('layouts.frontt')
@section('content')
<div class="container">
    @if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info" style="text-align: right; direction:rtl;">{{ Session::get('info') }}</p>
        </div>
    </div>
    @endif
   @if(Session::has('discount'))
    <div class="row">
        <div class="col-md-12">
            @if(Session::get('discount') == 'no')
            <p class="alert alert-danger" style="text-align: right; direction:rtl;">کد تخفیف وارد شده اشتباه است</p>
            <?php $dis=0; ?>
            @else
            <p class="alert alert-info" style="text-align: right; direction:rtl;"> کد تخفیف اعمال شد</p>
            <?php $dis=Session::get('discount'); ?>
            @endif
        </div>
    </div>
    @else
    <?php $dis=0; ?>
    @endif
    <div class="producttbl table-responsive">
        <table class="productlist table">
            <thead>
                <tr>
                    <th class="product-remove">&nbsp;</th>
                    <th class="product-thumbnail">&nbsp;</th>
                    <th class="product-name">محصول</th>
                    <th class="product-price">قیمت</th>
                    <th class="product-color">جزییات</th>
                    <th class="product-quantity">تعداد</th>
                    <th class="product-subtotal">جمع جزء</th>
                </tr>
            </thead>
            <tbody>
                @if(Cart::count() > 0)
                @foreach (Cart::content() as $item)       
                <tr class="woocommerce-cart-form__cart-item cart_item">
                    <td class="product-remove">
                        <form action="{{route('cart.destroy',['id'=>$item->rowId])}}" method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="submit" class="remove">&times;</button>	
                        </form>					
                    </td>
                    <td class="product-thumbnail">
                        <a href="{{route('product',['id'=>$item->id])}}"><img src="{{ asset('pics/'.$item->model->pic.'/'.$item->model->pic ) }}" alt=""></a>						
                    </td>    
                    <td class="product-name" data-title="محصول">
                        <a href="{{route('product',['id'=>$item->id])}}">{{$item->model->name}}</a>
                    </td>
                    <td class="product-price" data-title="قیمت">
                        <p><?php echo number_format($item->price) ?></p>
                    </td>
                    <td class="product-color" data-title="جزییات">
                        <p><?php echo ($item->options->has('color') ? $item->options->color : ''); ?></p>						
                    </td>
                    <td class="product-quantity" data-title="تعداد">
                        <p>{{$item->qty}}</p>						
                    </td>
                    <td class="product-subtotal" data-title="جمع جزء">
                        <p><?php echo number_format($item->qty * $item->price) ?></p>						
                    </td>
                </tr>
                @endforeach
                @else 
                    <p>محصولی موجود نیست</p>
                @endif
                <tr>
                    <td colspan="6" class="actions">
                        <div class="coupon">
                            <form action="{{route('discount')}}"  method="GET">
                                <label for="coupon_code">کدتخفیف:</label> 
                                <input size="16" type="text"  name="coupon_code" class="input-text" id="coupon_code" value="{{ Session::get('discount') }}" placeholder="کد تخفیف" /> 
                                <input type="hidden" name="type" value="product">
                                <button type="submit" class="button coup" name="apply_coupon" value="اعمال کوپن">اعمال کوپن</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <h2 class="sumtitle">جمع کل سبد خرید</h2>
    <div class="sumtablepl">
        <table class="sumtable">
            <tr>
                <th>جمع جزء</th>
                <td data-title="جمع جزء"><p><?php echo number_format(Cart::subtotal()); ?> تومان</p></td>
            </tr>
            <tr>
                <th>هزینه ارسال</th>
                <td data-title="جمع جزء"><p>20,000 تومان</p></td>
            </tr>
            <tr>
                <th>تخفیف به درصد</th>
                <td data-title="تخفیف به درصد"><p>{{Session::get('discount')}}</p></td>
            </tr>
            <tr class="order-total">
                <th>مجموع</th>
                <?php $price=(((100-Session::get('discount'))*Cart::subtotal() + 20)/100); ?>
                <td data-title="مجموع"><p><?php echo number_format($price) ?> تومان</p></td>
            </tr>
        </table>
    </div>
    <div class="proceed-to-checkout">
        @if(Auth::check())
        <form id="checkout" action="{{route('checkout')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$price}}" name="price" >
        @if(isset($copon))
        <input type="hidden" value="{{$copon}}" name="copon" >
        @endif
         <a href="#" onclick="document.getElementById('checkout').submit();" class="checkout-button">ادامه جهت تسویه حساب</a>
        </form>
        @else 
         <a href="{{route('login')}}" class="checkout-button">ورود به حساب کاربری و ادامه</a>
        @endif
    </div>
</div>
@endsection