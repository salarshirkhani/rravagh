<div class="col-md-3">
    <span class="humburger-menu" onclick="openNav()">☰</span>
    <div id="mySidenav" class="sidenav" style="display: none;">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <div class="logo"><img src="{{ asset('/images/logo.png') }}"></div>
      <div class="panelmenu">
        <ul>
          <li>
            <a href="{{route('dashboard.buyer.index')}}" onmouseover="mousehover1()" onmouseout="mouseunhover1()"><img src="{{ asset('/images/Home.png') }}" alt="" id="image">خانه</a>
          </li>
          <li>
            
            <a href="{{route('dashboard.buyer.cart')}}" onmouseover="mousehover2()" onmouseout="mouseunhover2()"><img src="{{ asset('/images/Paper.png') }}" alt="" id="image2">لیست خرید</a>
          </li>
          <li>
            <a href="{{route('dashboard.buyer.likes')}}"><img src="{{ asset('/images/Paper-Upload.png') }}" alt="" id="image">لیست خرید آینده</a>
          </li>
          <!--
          <li>
            <a href=""><img src="{{ asset('/images/Edit.png') }}" alt="" id="image">ویرایش پروفایل</a>
          </li>
          <li>
            <a href=""><img src="{{ asset('/images/Setting.png') }}" alt="" id="image">تنظیمات</a>
          </li>
        -->
          <li class="gohome">
            <a href="{{route('/')}}" class="gohome"><img src="{{ asset('/images/Arrow-Right-2.png') }}" alt="">صفحه اصلی</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="panel-side">
      <div class="logo">
        <img src="{{ asset('/images/logo.png') }}" alt="">
      </div>
      <div class="panelmenu">
        <ul>
          <li>
            <a href="{{route('dashboard.buyer.index')}}" onmouseover="mousehover1()" onmouseout="mouseunhover1()"><img src="{{ asset('/images/Home.png') }}" alt="" id="image">خانه</a>
          </li>
          <li>
            
            <a href="{{route('dashboard.buyer.cart')}}" onmouseover="mousehover2()" onmouseout="mouseunhover2()"><img src="{{ asset('/images/Paper.png') }}" alt="" id="image2">لیست خرید</a>
          </li>
          <li>
            <a href="{{route('dashboard.buyer.likes')}}"><img src="{{ asset('/images/Paper-Upload.png') }}" alt="" id="image">لیست خرید آینده</a>
          </li><!--
          <li>
            <a href=""><img src="{{ asset('/images/Edit.png') }}" alt="" id="image">ویرایش پروفایل</a>
          </li>
          <li>
            <a href=""><img src="{{ asset('/images/Setting.png') }}" alt="" id="image">تنظیمات</a>
          </li> -->
          <li class="gohome">
            <a href="{{route('/')}}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="gohome"><img src="{{ asset('/images/Arrow-Right-2.png') }}" alt="">صفحه اصلی</a>
          </li>
        </ul>
      </div>
    </div>
  </div>