<!doctype html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {!! SEO::generate() !!}

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
  <link rel="stylesheet" href="{{asset('css/main.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/flickity.min.css')}}">
  <link rel="manifest" href="/manifest.json">
  <link rel="manifest" href="/manifest.json">
  <link rel="manifest" href="/manifest.json">
  <!-- Najva Push Notification -->
<script type="text/javascript">
  (function(){
       var now = new Date();
       var version = now.getFullYear().toString() + "0" + now.getMonth() + "0" + now.getDate() +
           "0" + now.getHours();
       var head = document.getElementsByTagName("head")[0];
       var link = document.createElement("link");
       link.rel = "stylesheet";
       link.href = "https://van.najva.com/static/cdn/css/local-messaging.css" + "?v=" + version;
       head.appendChild(link);
       var script = document.createElement("script");
       script.type = "text/javascript";
       script.async = true;
       script.src = "https://van.najva.com/static/js/scripts/new-website233741-website-47658-3ba7571a-d302-4c41-9965-9992be2b551b.js" + "?v=" + version;
       head.appendChild(script);
       })()
</script>
<!-- END NAJVA PUSH NOTIFICATION --> 
  <meta name="theme-color" content="#fafafa">
</head>
<style>
.menu ul li {
    padding: 0 13px;
}
</style>
<body>
  @foreach ($banners->where('place','up')->take(1) as $item)
  <div class="col-md-12">
    <a class="middlebanner" href="{{$item->url}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}" style="width:100%;"></a>
  </div>
  @endforeach
  <header class="desktopheader">
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <div class="logo">
            <a href="{{route('/')}}">
              <img src="{{asset('img/logo1.png')}}" alt="رواق">
            </a>
          </div>
        </div>
        <div class="col-md-7">
          <div class="menu">
            <ul>
              <li class="hassubmenu"><a href="">
                <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.625 19.8333H11C11.4644 19.8333 11.6966 19.8333 11.8916 19.859C13.2378 20.0362 14.2971 21.0955 14.4743 22.4417C14.5 22.6367 14.5 22.8689 14.5 23.3333V10.6667C14.5 7.83823 14.5 6.42402 13.6213 5.54534C12.7426 4.66666 11.3284 4.66666 8.5 4.66666H5.625C4.68219 4.66666 4.21079 4.66666 3.91789 4.95955C3.625 5.25244 3.625 5.72385 3.625 6.66666V17.8333C3.625 18.7761 3.625 19.2475 3.91789 19.5404C4.21079 19.8333 4.68219 19.8333 5.625 19.8333Z" fill="#7E869E" fill-opacity="0.25" stroke="#2892A8" stroke-width="1.2"/><path d="M23.375 19.8334H18C17.5356 19.8334 17.3034 19.8334 17.1084 19.859C15.7622 20.0362 14.7029 21.0956 14.5257 22.4418C14.5 22.6367 14.5 22.8689 14.5 23.3334V10.6667C14.5 7.83826 14.5 6.42405 15.3787 5.54537C16.2574 4.66669 17.6716 4.66669 20.5 4.66669H23.375C24.3178 4.66669 24.7892 4.66669 25.0821 4.95958C25.375 5.25247 25.375 5.72388 25.375 6.66669V17.8334C25.375 18.7762 25.375 19.2476 25.0821 19.5405C24.7892 19.8334 24.3178 19.8334 23.375 19.8334Z" fill="#7E869E" fill-opacity="0.25" stroke="#2892A8" stroke-width="1.2"/></svg>دسته‌بندی کتاب‌ها</a>
                 <ul class="submenu">
					@foreach($categories as $category)
						<li>
						    <a href="{{route('category',['slug'=>$category->slug])}}">{{ $category->name }}</a>
						</li>
					@endforeach
                 </ul>
                </li>
              <li><a href="{{route('blog')}}">مقالات</a></li>
              <li><a href="{{route('/')}}">آموزش</a></li>
              <li><a href="{{route('discountable')}}">حمایت از کتاب</a></li>
              <li><a href="{{route('about')}}">درباره ما</a></li>
              <li><a href="{{route('contact')}}">تماس با ما</a></li>
              <li><a href="">فیلم‌ها</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="login">
            <a href="#" class="search" id="myBtn">
              <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="14.2083" cy="14.2083" r="7.75" fill="white" stroke="#2892A8" stroke-width="2.2"/>
                <path d="M25.8333 25.8333L21.9583 21.9583" stroke="#2892A8" stroke-width="2.2" stroke-linecap="round"/>
                </svg>
            </a>
            <!-- The Modal -->
            <div id="myModal" class="modal">

              <!-- Modal content -->
              <div class="modal-content">
                <span class="close">&times;</span>
                <form action="{{ route('productsearch') }}" method="post">
                  @csrf
                  <input type="text" name="q" id="" placeholder="جستجو بین محصولات...">
                  <input type="submit" hidden>
                </form>
              </div>

            </div>
            <div class="shopbagsvg" onmouseenter="openshop()">
              <svg width="37" height="39" viewBox="0 0 37 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.3333 19.5L12.3333 12.6667C12.3333 9.26091 15.0943 6.5 18.5 6.5V6.5C21.9058 6.5 24.6667 9.26091 24.6667 12.6667L24.6667 19.5" stroke="#2892A8" stroke-width="2" stroke-linecap="round"/>
                <path d="M5.87535 18.3097C6.01358 16.5614 6.08269 15.6872 6.65745 15.1561C7.23221 14.625 8.10911 14.625 9.86291 14.625H27.1371C28.8909 14.625 29.7678 14.625 30.3426 15.1561C30.9173 15.6872 30.9864 16.5614 31.1246 18.3097L32.2044 31.9674C32.2843 32.9774 32.3242 33.4823 32.0273 33.8037C31.7303 34.125 31.2238 34.125 30.2106 34.125H6.78936C5.77623 34.125 5.26967 34.125 4.97274 33.8037C4.67581 33.4823 4.71573 32.9774 4.79558 31.9674L5.87535 18.3097Z" stroke="#2892A8" stroke-width="2"/>
              </svg>                
            </div>
            @if(Auth::check())
            <a href="{{route('dashboard.customer.index')}}" class="signupbtn">
              <svg width="29" height="27" viewBox="0 0 29 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.503 23.2941C21.0899 22.0981 20.1797 21.0412 18.9135 20.2874C17.6474 19.5336 16.096 19.125 14.5 19.125C12.904 19.125 11.3527 19.5336 10.0865 20.2874C8.82031 21.0412 7.91011 22.0981 7.49704 23.2941" stroke="white" stroke-width="2"/>
                <ellipse cx="14.5" cy="11.25" rx="3.625" ry="3.375" stroke="white" stroke-width="2" stroke-linecap="round"/>
                <rect x="3.41666" y="3.25" width="22.1667" height="20.5" rx="3" stroke="white" stroke-width="2"/>
              </svg>
              {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
            </a>
            @else 
            <a href="{{route('login')}}" class="signupbtn">
              <svg width="29" height="27" viewBox="0 0 29 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21.503 23.2941C21.0899 22.0981 20.1797 21.0412 18.9135 20.2874C17.6474 19.5336 16.096 19.125 14.5 19.125C12.904 19.125 11.3527 19.5336 10.0865 20.2874C8.82031 21.0412 7.91011 22.0981 7.49704 23.2941" stroke="white" stroke-width="2"/>
                <ellipse cx="14.5" cy="11.25" rx="3.625" ry="3.375" stroke="white" stroke-width="2" stroke-linecap="round"/>
                <rect x="3.41666" y="3.25" width="22.1667" height="20.5" rx="3" stroke="white" stroke-width="2"/>
              </svg>
              ورود و ثبت‌نام
            </a>            
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="shopbag" id="shopbag" style="display:none;" onmouseleave="closeshop()">
      <h4 style="margin-top:12px;"><b>سبد خرید</b></h4>
      @if(Cart::count() > 0)
      @foreach (Cart::content() as $item)  
        <div class="listbuy">
          <a href="{{route('product',['id'=>$item->id])}}">
            <img src="{{ asset('pics/'.$item->model->pic.'/'.$item->model->pic ) }}" style="width:51px !important; height:51px !important;" alt="{{$item->model->name}}">
            <div class="shopbagnum">
              <p>{{$item->qty}} عدد</p>
              <h5>{{$item->model->name}}</h5>
            </div>
          </a>
        </div>
      @endforeach
      @else 
        <h5>محصولی موجود نیست</h5>
      @endif
      <div class="bagbtns">
        <p class="itemnum">{{Cart::count()}} آیتم</p>
        <a href="{{route('cart')}}" class="paybag">پرداخت</a>
      </div>
  </div>
  </header>
  <header class="phoneheader">
    <div class="logo">
      <img src="{{asset('img/logo1.png')}}" alt="رواق">
    </div>
    <div class="searchphone">
      <a href="#" id="myBtn2">
          <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="14.2083" cy="14.2083" r="7.75" fill="white" stroke="#2892A8" stroke-width="2.2"/>
                <path d="M25.8333 25.8333L21.9583 21.9583" stroke="#2892A8" stroke-width="2.2" stroke-linecap="round"/>
                </svg>
      </a>
    </div>
  </div>
  <!-- The Modal -->
            <div id="myModal2" class="modal2">

              <!-- Modal content -->
              <div class="modal-content2">
                <span class="close2">&times;</span>
                <form action="{{ route('productsearch') }}" method="post">
                  @csrf
                  <input type="text" name="q" id="" placeholder="جستجو بین محصولات...">
                  <input type="submit" hidden>
                </form>
              </div>

            </div>
  </header>
<style>
  .carouseldn {
    padding: 10px 10px;
  }
  .carousels {
    margin-top: 20px;
 }

</style>
  @yield('content')

  <footer class="phonefooter">
    <div class="container">
      <div class="row">
        <div class="col">
          <li class="homebtn">
            <a href=""><svg width="52" height="48" viewBox="0 0 52 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="52" height="48" rx="15" fill="white"/>
              <path d="M10.8334 25.5192C10.8334 22.8037 10.8334 21.4459 11.428 20.2525C12.0227 19.059 13.1395 18.1754 15.3731 16.4081L17.5398 14.6939C21.5769 11.4996 23.5955 9.90247 26 9.90247C28.4045 9.90247 30.4231 11.4996 34.4603 14.6939L36.627 16.4081C38.8606 18.1754 39.9774 19.059 40.572 20.2525C41.1667 21.4459 41.1667 22.8037 41.1667 25.5192V34C41.1667 37.7712 41.1667 39.6569 39.8975 40.8284C38.6283 42 36.5855 42 32.5 42H19.5C15.4145 42 13.3718 42 12.1026 40.8284C10.8334 39.6569 10.8334 37.7712 10.8334 34V25.5192Z" fill="#2892A8" stroke="#2892A8" stroke-width="2"/>
              <path d="M31.4167 42V31C31.4167 30.4477 30.969 30 30.4167 30H21.5834C21.0311 30 20.5834 30.4477 20.5834 31V42" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </li>
        </div>
        <div class="col">
          <li class="menubtn">
            <a href="">
              <svg width="31" height="32" viewBox="0 0 31 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="31" height="32" rx="5" fill="#2892A8"/>
                <path d="M6.45837 9.33331H24.5417" stroke="white" stroke-width="2" stroke-linecap="round"/>
                <path d="M6.45837 16H19.375" stroke="white" stroke-width="2" stroke-linecap="round"/>
                <path d="M6.45837 22.6667H14.2084" stroke="white" stroke-width="2" stroke-linecap="round"/>
              </svg>                
            </a>
          </li>
        </div>
        <div class="col">
          <li class="profbtn">
            <a href="">
              <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M29.9289 30.514C30.5185 30.3911 30.8694 29.7759 30.6027 29.2358C29.7137 27.4352 28.2002 25.8526 26.2183 24.6698C23.8606 23.2627 20.9718 22.5 18 22.5C15.0282 22.5 12.1394 23.2627 9.78174 24.6698C7.79985 25.8526 6.28632 27.4352 5.39731 29.2358C5.13068 29.7759 5.48155 30.3911 6.07116 30.514L9.83916 31.2992C15.2219 32.421 20.7781 32.421 26.1609 31.2992L29.9289 30.514Z" fill="#2892A8"/>
                <circle cx="18" cy="12" r="7.5" fill="#2892A8"/>
              </svg>                
            </a>
          </li>
        </div>
        <div class="col">
          <li class="sabadbtn">
            <a href="">
              <svg width="37" height="39" viewBox="0 0 37 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.3333 19.5L12.3333 12.6667C12.3333 9.26091 15.0943 6.5 18.5 6.5V6.5C21.9058 6.5 24.6667 9.26091 24.6667 12.6667L24.6667 19.5" stroke="#2892A8" stroke-width="2" stroke-linecap="round"/>
                <path d="M5.87535 18.3097C6.01358 16.5614 6.08269 15.6872 6.65745 15.1561C7.23221 14.625 8.10911 14.625 9.86291 14.625H27.1371C28.8909 14.625 29.7678 14.625 30.3426 15.1561C30.9173 15.6872 30.9864 16.5614 31.1246 18.3097L32.2044 31.9674C32.2843 32.9774 32.3242 33.4823 32.0273 33.8037C31.7303 34.125 31.2238 34.125 30.2106 34.125H6.78936C5.77623 34.125 5.26967 34.125 4.97274 33.8037C4.67581 33.4823 4.71573 32.9774 4.79558 31.9674L5.87535 18.3097Z" stroke="#2892A8" stroke-width="2"/>
              </svg>                
            </a>
          </li>
        </div>
        <div class="col">
          <li class="bookbtn">
            <svg width="39" height="35" viewBox="0 0 39 35" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6.875 24.7916H15.125C16.4056 24.7916 17.0459 24.7916 17.5568 24.9839C18.3653 25.2882 19.0034 25.9263 19.3077 26.7349C19.5 27.2458 19.5 27.8861 19.5 29.1666V11.8333C19.5 9.00489 19.5 7.59067 18.6213 6.71199C17.7426 5.83331 16.3284 5.83331 13.5 5.83331H6.875C5.93219 5.83331 5.46079 5.83331 5.16789 6.12621C4.875 6.4191 4.875 6.8905 4.875 7.83332V22.7916C4.875 23.7345 4.875 24.2059 5.16789 24.4988C5.46079 24.7916 5.93219 24.7916 6.875 24.7916Z" fill="#2892A8" stroke="#2892A8" stroke-width="1.2"/>
              <path d="M32.125 24.7917H23.875C22.5944 24.7917 21.9541 24.7917 21.4432 24.984C20.6347 25.2883 19.9966 25.9264 19.6923 26.735C19.5 27.2458 19.5 27.8861 19.5 29.1667V11.8334C19.5 9.00495 19.5 7.59073 20.3787 6.71205C21.2574 5.83337 22.6716 5.83337 25.5 5.83337H32.125C33.0678 5.83337 33.5392 5.83337 33.8321 6.12627C34.125 6.41916 34.125 6.89057 34.125 7.83338V22.7917C34.125 23.7345 34.125 24.2059 33.8321 24.4988C33.5392 24.7917 33.0678 24.7917 32.125 24.7917Z" fill="#2892A8" stroke="#2892A8" stroke-width="1.2"/>
            </svg>              
          </li>
        </div>
      </div>
    </div>
  </footer>
  <footer class="desktopfooter">
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <div class="footlogo">
            <img src="{{asset('img/logo1.png')}}" alt="رواق">
          </div>
        </div>
        <div class="col-md-5">
          <div class="aboutft">
            <h3>درباره‌ی رواق</h3>
            <p>
              یکی از بیشترین کاربردهای استفاده از این‌گونه روسری معمولاً در زمینه پوشاک بانوان  حفظ حجاب زنان کاربرد بسیار زیادی دارد که بسیار قابل توجه است </p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="footmenu">
            <h3>راهنمای مشتریان</h3>
            <ul>
              <li><a href="{{route('about')}}">درباره ما</a></li>
              <li><a href="{{route('about')}}">راهنمای خرید</a></li>
              <li><a href="{{route('contact')}}">تماس با ما</a></li>
              <li><a href="{{route('subscription')}}">اشتراک</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-2">
          <div class="footother">
            <img src="{{asset('img/zarin1.png')}}" alt="">
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script src="{{asset('js/vendor/modernizr-3.11.2.min.js')}}"></script>
  <script src="{{asset('js/plugins.js')}}"></script>
  <script src="{{asset('js/main.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script src="{{asset('js/flickity.pkgd.min.js')}}"></script>
  <script>
    $('.firstcarousel').flickity({
    freeScroll: true,
    contain: true,
    prevNextButtons: false,
    pageDots: false,
    autoPlay: true,
    rightToLeft: true,  
  });
  $('.inccarousel').flickity({
    freeScroll: true,
    contain: true,
    prevNextButtons: false,
    pageDots: false,
    autoPlay: true,
    rightToLeft: true,  
  });
  </script>
  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set', 'anonymizeIp', true); ga('set', 'transport', 'beacon'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async></script>
  
</body>

</html>





