<!DOCTYPE html>
<html lang="fa_IR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('panel/css/main.css') }}">
    <script src="{{ asset('assets/dashboard/plugins/chart.js/Chart.min.js')}}"></script>
    <title>پنل کاربری</title>
  </head>
<body>

  <!-- Add your site or application content here -->
  <div class="container-fluid">
    <div class="row">

      <div class="col-md-9">
        <div class="panel-head">
          <div class="row">
            <div class="col-md-6">
              <div class="userpart">
                <div class="notifs" id="notifs" onmouseover="shownotifs()" onmouseout="hidenotifs()">
                    <img src="{{ asset('../images/ring.png') }}" alt="">
                    <div class="notifications" id="notifications" style="display: none;">
                      <p>اعلان جدید</p>
                      @foreach($notification->where('status','publish') as $item)
                      <a href="{{route('dashboard.'.Auth::user()->type.'.notification',['id'=>$item->id])}}">
                        <img src="{{ asset('../images/More-Circle.png') }}" alt="">
                        <div class="notifdets">
                          <h6>{{$item->title}}<br></h6>
                          <p><br>{{ Facades\Verta::instance($item->created_at)->format('Y/n/j')}}</p>
                        </div>
                      @endforeach
                      </a>
                      <hr>
                      <p>اعلان‌های بسته شده</p>
                      <a href="">
                        <img src="{{ asset('../images/More-Circle.png') }}" alt="">
                        @foreach($notification->where('status','pending') as $item)
                        <div class="notifdets">
                          <h6>{{$item->title}}<br></h6>
                          <p><br>{{ Facades\Verta::instance($item->created_at)->format('Y/n/j')}}</p>
                        </div>
                        @endforeach
                      </a>
                    </div>
                  </div>
                  <div class="userdet">
                    <div class="teacher">
                      <img src="{{ asset('pics/'.Auth::user()->profile.'/'.Auth::user()->profile ) }}" style="border-radius:50px;" alt="">
                      <div class="teachername">
                          @if(Auth::user()->type=='buyer' )
                              <p>کاربر عادی</p>
                          @endif
                          @if(Auth::user()->type=='seller' )
                          <p>خریدار عمده</p>
                          @endif
                        <h6><b>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b></h6>
                      </div>
                  </div>
                  </div>
                </div>
            </div>     
        @yield('panel')

    </div>
</div>
<script src="{{ asset('panel/js/vendor/modernizr-3.11.2.min.js') }}"></script>
<script src="{{ asset('panel/js/plugins.js') }}"></script>
<script src="{{ asset('panel/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
  window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
  ga('create', 'UA-XXXXX-Y', 'auto'); ga('set', 'anonymizeIp', true); ga('set', 'transport', 'beacon'); ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async></script>
</body>

</html>