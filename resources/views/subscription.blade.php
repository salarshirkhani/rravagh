@extends('layouts.frontt')
@section('content')
<style>
/*.buysub {
    position: absolute;
    left: 40px;
    top: 35px;
}*/
</style>
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
    <section class="content">
      <div class="container">
          <div class="whereareyou">
              <a href="">صفحه اصلی</a> > <a href="">عنوان دسته‌بندی</a> > <a href="">عنوان دسته‌بندی</a>
          </div>
       @isset($subscribe)
          
          <p style="text-align:center; color:red; font-size:30px; font-weight:800;">شما اشتراک دارید</p>
      
       @else
       @foreach ($posts as $item)
          <div class="subsection">
              <div class="row">
                  <div class="col-md-2 col-2">
                      <div class="subimg">
                          <span class="percents">
                            @if ($item->discount != NULL)
                            <?php echo round(100-(($item->discount*100)/$item->price)).'%'; ?>تخفیف
                            @endif
                            @if ($item->discount == NULL)
                            <?php echo '0%'; ?>تخفیف
                            @endif
                          </span>
                          <img src="{{asset('img/Date_range.svg')}}" alt="">                      
                      </div>
                  </div>
                  <div class="col-md-10 col-10">
                      <div class="subdetails">
                        <div class="watchsub">
                          <h3>{{$item->name}}</h3>
                          <div class="subprices">
                            @if ($item->discount != NULL)
                              <p class="suborgprice">
                                <?php echo number_format($item->price) ?> تومان
                              </p>
                              <p class="subfinprice">
                                  <span><?php echo number_format($item->discount) ?></span>
                                  تومان
                              </p>
                            @else
                            <p class="subfinprice">
                              <span><?php echo number_format(((100-$dis)*$item->price)/100);  ?></span>
                              تومان
                            </p>
                            @endif
                          </div>
                        </div>
                        @auth
                        <a href="#" onclick="document.getElementById('addsubs{{$item->id}}').submit();" class="buysub"><svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M29.5112 17.5L26.478 20.5852C24.059 23.0456 22.8495 24.2758 21.3753 24.4652C21.0141 24.5116 20.6486 24.5116 20.2874 24.4652C18.8133 24.2758 17.6038 23.0456 15.1848 20.5852L12.1515 17.5" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                          </svg>
                          خرید</a>
                          <form id="addsubs{{$item->id}}" action="{{route('subs')}}" method="post" style="display: inline-flex;">
                            @csrf 
                            <input type="hidden" name="subscribe_id" value="{{$item->id}}" > 
                            @if ($item->discount != NULL)
                            <input type="hidden" name="price" value="{{$item->discount}}" >
                            @else
                            <input type="hidden" name="price" value="<?php echo number_format(((100-$dis)*$item->price)/100);  ?>" >
                            @endif
                            <input type="hidden" name="time" value="{{$item->time}}" >
                         </form>
                         @else
                         <a href="{{route('login')}}" class="buysub"><svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M29.5112 17.5L26.478 20.5852C24.059 23.0456 22.8495 24.2758 21.3753 24.4652C21.0141 24.5116 20.6486 24.5116 20.2874 24.4652C18.8133 24.2758 17.6038 23.0456 15.1848 20.5852L12.1515 17.5" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                          </svg>
                          برای خرید اشتراک وارد سایت شوید</a>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
          <div style="margin-top:37px;"></div>
          <div class="col-12">
            <div class="coupon" style="border-radius:19px; background: #F5F5F5; padding:15px;">
                <span style="font-size:22px; font-weight:800; padding: 5px;">کد تخفیف دارید ؟ </span>
                   <form action="{{route('discount')}}" style="margin: 27px 0px 0px 0px !important;" method="GET">
                      <label for="coupon_code">کدتخفیف:</label> 
                      <input type="hidden" name="type" value="subscribe">
                      <input size="16" type="text" style=" border: none; padding: 8px; border-radius: 15px;" name="coupon_code" class="input-text" id="coupon_code" value="{{ Session::get('discount') }}" placeholder="کد تخفیف" /> 
                      <button type="submit" class="button coup" name="apply_coupon" value="اعمال کوپن">اعمال کوپن</button>
                  </form> 
            </div>
           </div>
        @endif
        <div class="campaignfaq">
          <h1>سوالات متداول
            <img src="{{asset('img/Group 8.svg')}}" alt="">
          </h1>
           <div class="accordion faqbox" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
              <h3 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                  چطوری اشتراک بخریم؟
                </button>
              </h3>
              <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                  <p>بعد از اینکه ثبت نام شما تکمیل شد، در همان صفحه گزینه خرید اشتراک وجود دارد</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h3 class="accordion-header" id="panelsStayOpen-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                  همینکه ثبت نام کنیم اشتراک خودش فعال میشه؟
                </button>
              </h3>
              <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                  <p>خیر! ثبت نام فقط برای احراز و ثبت هویت شماست. و برای اینکه شماره حساب و سایر مشخصات شما درج شود. خرید اشتراک کاری است که در مرحله بعد باید انجام بشود.</p>
                </div>
              </div>
            </div>
      
      
      </div>
        </div>
    
      </div>
    </section>

@endsection