@extends('layouts.frontt')
@section('content')
<link rel="stylesheet" href="{{asset('css/modal.css')}}">
<!--<style>
    @media only screen and (min-width:800px){  
       .carousel-cell a img{ 
         max-width:180px;
       }
    }
    
    @media only screen and (max-width:800px){  
       .carousel-cell a img{ 
         width: 322px;
       }
    }
</style>-->
<?php $image = NULL ?>
<section class="content">
    <div class="container">
        @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
        @endif    
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
        <div class="whereareyou">
            <a href="">صفحه اصلی</a> > <a href="{{route('products')}}">محصولات</a> > <a href="{{route('product',['id'=>$item->id])}}">{{$item->name}}</a>
        </div>
        <div class="briefprod">
            <div class="row">
                <div class="col-md-3">
                    <div class="prodpics">
                        <div class="carousel-main">
                            @foreach ($images as $pic)
                            <?php $idd++; ?>
                            <div class="carousel-cell">
                                <a href="#"><img src="{{ asset('pics/'.$pic['link'].'/'.$pic['link'] ) }}" alt="{{$item->name}}"></a>
                            </div>
                            @endforeach
                        </div>
                        <div class="carousel-nav">
                            @foreach ($images as $pic)
                            <?php $idd++; ?>
                            <div class="carousel-cell">
                                <a href="#"><img src="{{ asset('pics/'.$pic['link'].'/'.$pic['link'] ) }}" style="max-width:100%;"  alt="{{$item->name}}"></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="prodcap">
                      <h3>{{$item->name}}</h3>
                      <p>
                        {{$item->explain}}
                      </p>
                      <div class="pricebar">
                        @if ($item->discount != NULL)
                            <p class="orgprice"><?php echo number_format($item->price) ?> تومان</p>
                            <p class="finprice"><?php echo number_format($item->discount) ?> <span>تومان</span></p>
                        @else
                            <p class="finprice"><?php echo number_format($item->price) ?> <span>تومان</span></p>
                        @endif
                      </div>
                    </div>
                    <div class="prodline"></div>
                    <div class="prodpurch">
                     @if($item->inventory=='0')             
                        <p style="color:red; font-weight:800; font-size:16px; margin-top:45px; margin-right:25px;">نا موجود</p>
                     @else  
                      <a class = "ordersend" href="#" onclick="document.getElementById('addcart{{$item->id}}').submit();"><svg width="42" height="38" viewBox="0 0 42 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.25 13.5C5.25 11.6144 5.25 10.6716 5.83579 10.0858C6.42157 9.5 7.36438 9.5 9.25 9.5H32.75C34.6356 9.5 35.5784 9.5 36.1642 10.0858C36.75 10.6716 36.75 11.6144 36.75 13.5V24.5C36.75 26.3856 36.75 27.3284 36.1642 27.9142C35.5784 28.5 34.6356 28.5 32.75 28.5H9.25C7.36438 28.5 6.42157 28.5 5.83579 27.9142C5.25 27.3284 5.25 26.3856 5.25 24.5V13.5Z" fill="#222852" fill-opacity="0.25"/>
                        <ellipse cx="10.5" cy="23.75" rx="1.75" ry="1.58333" fill="white"/>
                        <rect x="5.25" y="14.25" width="31.5" height="3.16667" fill="white"/>
                        </svg>
                        سفارش و ارسال</a>
                        <a href="#" data-toggle="modal" data-target="#modal-success{{ $item->id }}" class="supportbtn">
                          <svg width="42" height="38" viewBox="0 0 42 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.25 13.5C5.25 11.6144 5.25 10.6716 5.83579 10.0858C6.42157 9.5 7.36438 9.5 9.25 9.5H32.75C34.6356 9.5 35.5784 9.5 36.1642 10.0858C36.75 10.6716 36.75 11.6144 36.75 13.5V24.5C36.75 26.3856 36.75 27.3284 36.1642 27.9142C35.5784 28.5 34.6356 28.5 32.75 28.5H9.25C7.36438 28.5 6.42157 28.5 5.83579 27.9142C5.25 27.3284 5.25 26.3856 5.25 24.5V13.5Z" fill="#222852" fill-opacity="0.25"/>
                            <ellipse cx="10.5" cy="23.75" rx="1.75" ry="1.58333" fill="white"/>
                            <rect x="5.25" y="14.25" width="31.5" height="3.16667" fill="white"/>
                          </svg>
                          حمایت از کتاب                            
                        </a>
                        @endif
                        <!-- SHOW SUCCESS modal -->
                                <div class="modal fade show" id="modal-success{{ $item->id }}" aria-modal="true" role="dialog">
                                    <div class="modal-dialog modal-danger">
                                      <div class="modal-content ">
                                        <div class="modal-header">
                                          <h4 class="modal-title">حمایت از  {{ $item->name }}</h4>
                                          <button type="button" class="close uncheckd" data-dismiss="modal" aria-label="Close">
                                            <span  aria-hidden="true">×</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                      شما می توانید برای حمایت از کتاب مورد نظر خود مبالغ زیر را انتخاب کرده و یا مبلغ مورد نظر خود را نوشته و پرداخت کنید
                                                      <br>
                                                      حداکثر مقدار قابل کمک برای این کتاب
                                                      @php 
                                                      if(isset($item->helpprice)){
                                                        $helpprice=$item->helpprice * $item->inventory;
                                                      }
                                                      else{
                                                        $helpprice=$item->price * $item->inventory;
                                                      }                                      
                                                      @endphp
                                                      <?php echo number_format($helpprice); ?> تومان
                                                      <form  action="{{route('help')}}" method="post" style="margin-top:15px">
                                                        @isset(Auth::user()->id)
                                                        <input type="hidden" name="product_id" value="{{ $item->id }}" >
                                                        <input type="hidden" name="maxvalue" value="{{$helpprice}}" >
                                                        @csrf
                                                        @isset( Auth::user()->id )
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                                                        @endisset
                                                        <input type="radio" id="10000000" name="price1" onchange="addValueToRadioBtn();" value="10000000">
                                                        <label for="10000000">یک میلیون تومان</label><br>
                                                        <input type="radio" id="15000000" name="price1" onchange="addValueToRadioBtn();" value="15000000">
                                                        <label for="15000000">یک میلیون و پانصد هزار تومان</label><br>
                                                        <input type="radio" id="20000000" name="price1" onchange="addValueToRadioBtn();" value="20000000">
                                                        <label for="20000000">دومیلیون تومان</label><br>
                                                        <input type="radio" style="margin-right: 5px;" id="amntother" name="price1" value="">
                                                        <label for="amntother">مبالغ دیگر</label>
                                                        <p>همچنین شما می توانید مبلغ مورد نظر خود را به ریال وارد کرده و پرداخت کنید</p>
                                                        <input type="number" class="form-control" id="otherAmount"  name="price" value="" placeholder="مبلغ مورد نظر خود را به ریال وارد کنید">
                                                        <script>  
                                                            function addValueToRadioBtn() {
                                                                if (document.getElementById("amntother").checked == true){
                                                                    document.getElementById("otherAmount").value = document.getElementById("amntother").value ;
                                                                }
                                                                if (document.getElementById("20000000").checked == true){
                                                                    document.getElementById("otherAmount").value = document.getElementById("20000000").value ;
                                                                }
                                                                if (document.getElementById("15000000").checked == true){
                                                                    document.getElementById("otherAmount").value = document.getElementById("15000000").value ;
                                                                }
                                                                if (document.getElementById("10000000").checked == true){
                                                                    document.getElementById("otherAmount").value = document.getElementById("10000000").value ;
                                                                }
                                                                //added an alert box just to test that the value has been updated
                                                                
                                                            }                                                 
                                                        </script>
                                                        @else
                                                            <p class="alert alert-warning">شما باید برای حمایت از کتاب در سایت ثبت نام کرده باشید</p>
                                                            <a href="{{route('register')}}" class="btn btn-primary">ثبت نام و ورود به سایت </a>
                                                        @endisset
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="prodpics">
                                                            <div class="carousel-main">
                                                                @foreach ($images as $pic)
                                                                <?php $idd++; ?>
                                                                <div class="carousel-cell">
                                                                    <a href="#"><img src="{{ asset('pics/'.$pic['link'].'/'.$pic['link'] ) }}" alt="{{$item->name}}"></a>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="carousel-nav">
                                                                @foreach ($images as $pic)
                                                                <?php $idd++; ?>
                                                                <div class="carousel-cell">
                                                                    <a href="#"><img src="{{ asset('pics/'.$pic['link'].'/'.$pic['link'] ) }}" style="max-width:100%;"  alt="{{$item->name}}"></a>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                  
                                        </div>
                                        @isset(Auth::user()->id)
                                        <div class="modal-footer justify-content-between">
                                              <button type="submit" class="btn btn-success btn-lg">حمایت از کتاب </button>
                                        </div>
                                        @endisset
                                      </form>

                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                      <div class="stocks">
                        <p>موجودی: {{$item->inventory}}عدد</p>
                        <div class="counter">
                          <span class="down" onclick="decreaseCount(event, this)">-</span>
                          <input type="text" value="1">
                          <span class="up" onclick="increaseCount(event, this)">+</span>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
			<div class="row">
				<div class="productdetshead">
					<div class="col-md-2 col-xs-4">
						<button class="prodtablinks active" onclick="openCity1(event, 'London')" id="defaultOpenn">توضیحات</button>
					</div>
					<div class="col-md-2 col-xs-4">
						<button class="prodtablinks" onclick="openCity1(event, 'Paris')">جدول مشخصات</button>						
					</div>
                    <div class="col-md-2 col-xs-4">
						<button class="prodtablinks" onclick="openCity1(event, 'Tokyo')">نظرات کاربران</button>				  
					</div>
				</div>
				<div class="productdestbody">
					<div id="London" class="prodtabcontent" style="display: block;">
						<!--<h3>توضیحات</h3>-->
                        <div style="text-align:justify">
                            {!!$item->content!!}
                        </div>
                    </div>
					  
					  <div id="Paris" class="prodtabcontent" style="display: none;">
						<h3>مشخصات</h3>
                        <table class="productspecs">
                            <tbody>
                                @foreach ($item->specifications as $spec)
                                <tr>
                                    <th>{{$spec->key}}</th>
                                    <td>{{$spec->value}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
					  </div>

                      <div id="Tokyo" class="prodtabcontent" style="display: none;">
                        <!--<h3>نظرات کاربران</h3>-->
                        @foreach ($comments as $comment)
                        <div class="commentpart">
                           <div class="col-md-10 col-xs-10">
                               <div class="comment">
                                   <p class="commentstats">{{ Facades\Verta::instance($item->created_at)->format('Y/n/j')}}</p>
                                   <h3><b>{{$comment->name}}</b> گفت:</h3>
                                   <p>{{$comment->description}}</p>
                               </div>
                           </div>
                           <div class="col-md-2 col-sm-2 col-xs-2">
                               <div class="userimg"><img src="{{asset('images/Profile.png')}}" alt=""></div>
                           </div>
                       </div>
                       @endforeach
                        <div class="addcomment">
                            <form action="{{route('comment')}}" method="POST">
                                @csrf 
                                <input type="hidden" name="product_id" value ="{{$item->id}}" >
                                @if(Auth::check())
                                  <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> 
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="namepl">
                                            <label for="mail">ایمیل</label>
                                            <input type="email" name="email" id="mail">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="namepl">
                                            <label for="firstname">نام و نام خانوادگی</label>
                                            <input type="text" name="name" id="firstname" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="commentpl">
                                        <label for="yourcomment">دیدگاه شما</label><br>
                                        <textarea id="yourcomment" name="content" rows="4" required></textarea>
                                    </div>
                                </div>
                                <!--  CAPTCHA   -->
                                <div class="col-md-3" style=" border-radius:10px; padding:7px;">
                                    <img src="{!!Captcha::src('default')!!}" style="width:60%; display:block; margin-left:auto; margin-right:auto; margin-bottom:5px;">
                                    <div class="wrap-input100 validate-input" data-validate="کپچا به درستی وارد نشده است">
                                        <input type="text" name="captcha" class=" input100" placeholder="کد کپچا" id="id_capctha" required>
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" value="فرستادن دیدگاه">
                                </div>
                            </form>
                        </div>
                      </div>
				</div>
			</div>
		</div>
  </section>
  <!-- jQuery -->
<script src="{{ asset('assets/dashboard/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap 4 -->
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dashboard/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('assets/dashboard/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="https://adminlte.io/themes/v3/dist/js/pages/dashboard.js"></script>
@endsection