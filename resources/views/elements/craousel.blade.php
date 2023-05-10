<div class="col-md-12 col-sm-12">
    <h2 class="top-title">بگرد ، پیدا کن ، <b>لذت ببر</b></h2>
    <div class="slider-1">
        <div class="container">
            <div class="owl-carousel owl-theme owl-carousel4">
             @foreach ($products as $item)
                <div class="col-xs-12 col-sm-12"> 
                        <div class="slide">
                             <a href="{{route('product',['id'=>$item->id])}}" class="prod">
                                <img class="heart" src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->name}}">
                            </a>
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
                                <a href="{{route('product',['id'=>$item->id])}}"><h4 class="title" style="line-height: 25px;"> {!! \Illuminate\Support\Str::limit($item->name, 35, ' ...') !!} </h4></a>
								<h5 class="brandname">برند: {{$item->brands->name}}</h5>
                                @if ($item->discount != NULL)
                                    <h4 style="color:gray; font-size:15px;"> <strike> <?php echo number_format($item->price) ?> تومان </strike></h4> 
                                    
                                    <h4> <?php echo number_format($item->discount) ?> تومان <span class="offpercent"><?php echo round(100-(($item->discount*100)/$item->price)).'%'; ?></span></h4> 
                                    @else
                                    <h4> <?php echo number_format($item->price) ?> تومان </h4>
                                @endif
                            </div>
                        </div>
                </div>
             @endforeach
        </div>			  
        </div>
                    <script src="{{asset('owlcarousel/jquery.min.js')}}"></script>
                    <script src="{{asset('owlcarousel/owl.carousel.min.js')}}" ></script>
    
    <script>
         $(document).ready(function () {
    $('.owl-carousel4').owlCarousel({
        loop:true,
        nav:true,
        items:1,
		margin:60,
        rtl:false,
        autoplay:false,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
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
    })
});
       </script>
                     
</div>
</div>