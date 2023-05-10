<!DOCTYPE html>
<html lang="fa_IR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
<!-- jQuery -->
<script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
    <!-- Styles -->
    <link href="https://cdn.fontcdn.ir/Font/Persian/Shabnam/Shabnam.css" rel="stylesheet">
    <link href="{{ asset('assets/auth/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/auth/css/main.rtl.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/persianDatepicker.css') }}" 
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/daterangepicker/daterangepicker.css') }}">

</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            @yield('content')
        </div>
    </div>
</div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="{{ asset("assets/auth/js/tilt.jquery.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("assets/auth/js/main.js") }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/js/persianDatepicker.js') }}"></script>
<script src="{{ asset('js/toastr/toastr.min.js')}}"></script>
<script type="text/javascript">
    $(function() {
        $("#date, #date1").persianDatepicker({
        });   
    });
    
  </script>
  <script type="text/javascript">
      $(function() {
          $("#date, #date1").persianDatepicker();
          $('.todo-list').sortable({
          placeholder: 'sort-highlight',
          handle: '.handle',
          forcePlaceholderSize: true,
          zIndex: 999999
           });
      });

  </script>
    <script type="text/javascript">
      var verifyCallback = function(response) {
       
      };
      var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6LfOX1YhAAAAALbrLeOGqemecG9PE6pmrx_tAYXJ',
          'callback' : verifyCallback,
          'theme' : 'light',
        });
      };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
</body>
</html>
