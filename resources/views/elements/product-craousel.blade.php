<h2>محصولات <b>جدید</b></h2>
        <div class="col-md-6 col-sm-12">
            <div class="btn">
                <button class="tablinks" onclick="openCity(event, 'buy-list')" onload="openfirst()" id="defaultOpen"><img src="{{asset('images/fire.svg') }}" class="btnemoji"> پرطرفدار</button>
                <button class="tablinks" onclick="openCity(event, 'cheap')"><img src="{{asset('images/moneyface.svg') }}" class="btnemoji">به صرفه</button> 
                <button class="tablinks" onclick="openCity(event, 'lovely')" ><img src="{{asset('images/hearteyes.svg') }}" class="btnemoji"> محبوب</button>						  
            </div>
            <div id="buy-list" class="tabcontent">
                    <div class="slider-1">
                        <div class="container">
                            <div class="owl-carousel owl-theme owl1">

                                @foreach ($products as $item)
                                <div class="col-xs-12 col-sm-12"> 
                                    <a href="{{route('product',['id'=>$item->id])}}" class="prod">
                                        <div class="slide">
                                            
                                            <img class="heart" src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->name}}">
                                            <form id="like{{$item->id}}" action="{{route('like')}}" method="post" >
                                                @csrf 
                                                <input type="hidden" name="product" value="{{$item->id}}" >                                    
                                            </form>
                                            @if(Auth::check()) 
                                            <a href="#" class="toastrDefaultInfo" onclick="document.getElementById('like{{$item->id}}').submit();"><img class="like" src="{{asset('images/Heart.svg') }}"></a>
                                            @else 
                                            <a href="#" class="toastrDefaultWarning" ><img class="like" src="{{asset('images/Heart.svg') }}"></a>
                                            @endif                                            
                                            <a href="{{route('product',['id'=>$item->id])}}"><img class="previewproductbtn" src="{{asset('images/Show.svg') }}"></a>
                                            
                                            <div class="addtocartbtn">
                                                <form id="addcart{{$item->id}}" action="{{route('cart.store')}}" method="post" style="display: inline-flex;">
                                                        <input type="hidden" name="number" value="1">
                                                        @csrf 
                                                        <input type="hidden" name="id" value="{{$item->id}}" > 
                                                        <input type="hidden" name="name" value="{{$item->name}}" >
                                                        @if ($item->discount != NULL)
                                                            <input type="hidden" name="price" value="{{$item->discount}}" > 
                                                        @else
                                                            <input type="hidden" name="price" value="{{$item->price}}" > 
                                                        @endif
                                                                                                 
                                                 </form>
                                                 <a href="#" class="toastrDefaultInfo" onclick="document.getElementById('addcart{{$item->id}}').submit();">
                                                    <img src="{{asset('images/Bag.svg') }}">
                                                    خرید
                                                </a>  
                                        </div>
											<div class="t-slide" style="direction: rtl;">
                                                <h4 class="title" style="line-height: 25px;"><a href="{{route('product',['id'=>$item->id])}}"> {!! \Illuminate\Support\Str::limit($item->name, 35, ' ...') !!} </a></h4>
                                                <h5 class="brandname">برند: {{$item->brands->name}}</h5>
                                                @if ($item->discount != NULL)
                                                    <h4 style="color:gray; font-size:15px;"> <strike> <?php echo number_format($item->price) ?> تومان </strike></h4> 
                                                    
                                                    <h4> <?php echo number_format($item->discount) ?> تومان<span class="offpercent"><?php echo round(100-(($item->discount*100)/$item->price)).'%'; ?></span></h4>
                                                    @else
                                                    <h4> <?php echo number_format($item->price) ?> تومان</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </a>							
                                </div>
                             @endforeach
                            
                        </div>			  
                        </div>
                        <script src="jquery-3.5.1.min.js"></script>
                        <script src="index.js"></script>							
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" ></script>
                                            
                    <script>
                        $(document).ready(function () {
                        $(".owl1").owlCarousel({
                           autoplay:true,
                           items:1,
                           loop:true,
                           autoplayHoverPause:true,
                           margin:60,
                           nav:false,
                           rtl:false,
                           navText : ["<img alt='' class='str-22' src='{{asset('images/Arrow---Right-Circle.svg')}}'>","<img alt='' class='str-22' src='{{asset('images/Arrow---Right-Circle.svg')}}'>"],
                           responsiveClass:true,
                           responsive: {
                                0:{
                                    items:1,
                                    margin:0,
                                },
                                600:{
                                    items:2,
                                },
                                768:{
                                    items:3,
                                },
                                1400:{
                                    items:5,
                                }
                            }
                           }
                        )});
                       </script>
                                     
                    <div class="slider-2"></div>
                </div>  
                  </div>
                  
                  <div id="cheap" class="tabcontent">
                    <div class="slider-1">
                        <div class="container">
                            <div class="owl-carousel owl-theme owl2">
                                @foreach ($products->where('cheap','yes') as $item)
                                <div class="col-xs-12 col-md-3 col-sm-12"> 
                                    <a href="{{route('product',['id'=>$item->id])}}" class="prod">
                                        <div class="slide">
                                            
                                            <img class="heart" src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->name}}">
                                            <form id="like{{$item->id}}" action="{{route('like')}}" method="post" >
                                                @csrf 
                                                <input type="hidden" name="product" value="{{$item->id}}" >                                    
                                            </form>
                                            @if(Auth::check()) 
                                            <a href="#" class="toastrDefaultInfo" onclick="document.getElementById('like{{$item->id}}').submit();"><img class="like" src="{{asset('images/Heart.svg') }}"></a>
                                            @else 
                                            <a href="#" class="toastrDefaultWarning" ><img class="like" src="{{asset('images/Heart.svg') }}"></a>
                                            @endif                                            
                                            <a href="{{route('product',['id'=>$item->id])}}"><img class="previewproductbtn" src="{{asset('images/Show.svg') }}"></a>
                                            
                                            <div class="addtocartbtn">
                                                <form id="addcart{{$item->id}}" action="{{route('cart.store')}}" method="post" style="display: inline-flex;">
                                                        <input type="hidden" name="number" value="1">
                                                        @csrf 
                                                        <input type="hidden" name="id" value="{{$item->id}}" > 
                                                        <input type="hidden" name="name" value="{{$item->name}}" >
                                                        @if ($item->discount != NULL)
                                                            <input type="hidden" name="price" value="{{$item->discount}}" > 
                                                        @else
                                                            <input type="hidden" name="price" value="{{$item->price}}" > 
                                                        @endif
                                                                                                 
                                                 </form>
                                                 <a href="#" class="toastrDefaultInfo" onclick="document.getElementById('addcart{{$item->id}}').submit();">
                                                    <img src="{{asset('images/Bag.svg') }}">
                                                    خرید
                                                </a>  
                                        </div>
                                            <div class="t-slide" style="direction: rtl;">
                                                <h4 class="title" style="line-height: 25px;"><a href="{{route('product',['id'=>$item->id])}}"> {!! \Illuminate\Support\Str::limit($item->name, 35, ' ...') !!} </a></h4>
                                                <h5 class="brandname">برند: {{$item->brands->name}}</h5>
                                                @if ($item->discount != NULL)
                                                    <h4 style="color:gray; font-size:15px;"> <strike> <?php echo number_format($item->price) ?> تومان </strike></h4> 
                                                    
                                                    <h4> <?php echo number_format($item->discount) ?> تومان<span class="offpercent"><?php echo round(100-(($item->discount*100)/$item->price)).'%'; ?></span></h4>
                                                    @else
                                                    <h4> <?php echo number_format($item->price) ?> تومان</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </a>							
                                </div>
                             @endforeach

                        </div>			  
                        </div>
                        <script>
                         $(document).ready(function () {
                        $(".owl2").owlCarousel({
                           autoplay:true,
                           items:1,
                           loop:true,
                           autoplayHoverPause:true,
                           margin:60,
                           nav:false,
                           rtl:true,
                           navText : ["<img alt='' class='str-22' src='{{asset('images/Arrow---Right-Circle.svg')}}'>","<img alt='' class='str-22' src='{{asset('images/Arrow---Right-Circle.svg')}}'>"],
                           responsiveClass:true,
                           responsive: {
                                0:{
                                    items:1,
                                    margin:0,
                                },
                                600:{
                                    items:2,
                                },
                                768:{
                                    items:3,
                                },
                                1400:{
                                    items:5,
                                }
                            }
                           }
                        )});
                       </script>
                                     
                    <div class="slider-2"></div>
                </div>
                  </div>
                  
                  <div id="lovely" class="tabcontent">
                    <div class="slider-1">
                        <div class="container">
                            <div class="owl-carousel owl-theme owl3">

                                @foreach ($products->where('lovely','yes') as $item)
                                <div class="col-xs-12 col-md-3 col-sm-12"> 
                                    <a href="{{route('product',['id'=>$item->id])}}" class="prod">
                                        <div class="slide">
                                            
                                            <img class="heart" src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->name}}">
                                            <form id="like{{$item->id}}" action="{{route('like')}}" method="post" >
                                                @csrf 
                                                <input type="hidden" name="product" value="{{$item->id}}" >                                    
                                            </form>
                                            @if(Auth::check()) 
                                            <a href="#" class="toastrDefaultInfo" onclick="document.getElementById('like{{$item->id}}').submit();"><img class="like" src="{{asset('images/Heart.svg') }}"></a>
                                            @else 
                                            <a href="#" class="toastrDefaultWarning" ><img class="like" src="{{asset('images/Heart.svg') }}"></a>
                                            @endif                                            
                                            <a href="{{route('product',['id'=>$item->id])}}"><img class="previewproductbtn" src="{{asset('images/Show.svg') }}"></a>
                                            
                                            <div class="addtocartbtn">
                                                <form id="addcart{{$item->id}}" action="{{route('cart.store')}}" method="post" style="display: inline-flex;">
                                                        <input type="hidden" name="number" value="1">
                                                        @csrf 
                                                        <input type="hidden" name="id" value="{{$item->id}}" > 
                                                        <input type="hidden" name="name" value="{{$item->name}}" >
                                                        @if ($item->discount != NULL)
                                                            <input type="hidden" name="price" value="{{$item->discount}}" > 
                                                        @else
                                                            <input type="hidden" name="price" value="{{$item->price}}" > 
                                                        @endif
                                                                                                 
                                                 </form>
                                                 <a href="#" class="toastrDefaultInfo" onclick="document.getElementById('addcart{{$item->id}}').submit();">
                                                    <img src="{{asset('images/Bag.svg') }}">
                                                    خرید
                                                </a>  
                                        </div>
                                            <div class="t-slide" style="direction: rtl;">
                                                <h4 class="title" style="line-height: 25px;"><a href="{{route('product',['id'=>$item->id])}}"> {!! \Illuminate\Support\Str::limit($item->name, 35, ' ...') !!} </a></h4>
                                                <h5 class="brandname">برند: {{$item->brands->name}}</h5>
                                                @if ($item->discount != NULL)
                                                    <h4 style="color:gray; font-size:15px;"> <strike> <?php echo number_format($item->price) ?> تومان </strike></h4> 
                                                    
                                                    <h4> <?php echo number_format($item->discount) ?> تومان<span class="offpercent"><?php echo round(100-(($item->discount*100)/$item->price)).'%'; ?></span></h4> 
                                                    @else
                                                    <h4> <?php echo number_format($item->price) ?> تومان</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </a>							
                                </div>
                             @endforeach

                        </div>			  
                        </div>
                               
                    <script>
                         $(document).ready(function () {
                        $(".owl3").owlCarousel({
                           autoplay:true,
                           items:1,
                           loop:true,
                           autoplayHoverPause:true,
                           margin:60,
                           nav:false,
                           rtl:true,
                           navText : ["<img alt='' class='str-22' src='{{asset('images/Arrow---Right-Circle.svg')}}'>","<img alt='' class='str-22' src='{{asset('images/Arrow---Right-Circle.svg')}}'>"],
                           responsiveClass:true,
                           responsive: {
                                0:{
                                    items:1,
                                    margin:0,
                                },
                                600:{
                                    items:2,
                                },
                                768:{
                                    items:3,
                                },
                                1400:{
                                    items:5,
                                }
                            }
                           }
                        )});
                       </script>
                                     
                    <div class="slider-2"></div>
                </div>
                  </div>
        </div>
            
