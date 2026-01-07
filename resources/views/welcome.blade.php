@extends('layouts.frontt')
@section('content')
<style>
    .flickity-prev-next-button.previous {
        right: 10px;
        transform: rotate(180deg)
    }
    .flickity-prev-next-button.next {
        left: 10px !important;
        right: auto;
        transform: rotate(180deg)
    }
    .modal-content input {
       width:100%; 
    }
</style>
<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="main-carousel" style="width:100%;" data-flickity='{ "wrapAround": false, "freScroll":true, "autoPlay": 3000, "pauseAutoPlayOnHover": true  }'>
          @foreach ($banners->where('place','slider') as $item)
          <div class="carousel-cell">           
            <a href="{{$item->url}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}" style="width:100%;"></a>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-md-4">
        <div class="mainsides">
          @foreach ($banners->where('place','side') as $item)
            <a href="{{$item->url}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}" style="max-width: 410px; width:100%; margin-bottom:10px;"></a>
          @endforeach
        </div>
      </div>
    </div>
    @foreach ($categories->slice(0,2) as $category)
    <div class="phoneset">
      <div class="carouseltitle">
        <h2>{{$category->name}}</h2>
        <a href="{{route('category',['slug'=>$category->slug])}}" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M20.2135 8.075L12.4531 15.95L20.2135 23.825" stroke="white" stroke-width="2"/>
          </svg>
          </a>
      </div>  
      <div class="firstcarousel" >
        @foreach ($products->where('category',$category->id) as $item)
        <div class="carousel-cell carousels">
          <div class="carouseldn">
            <a href="{{route('product',['id'=>$item->id])}}"><img src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->name}}"></a>
            <div class="productdesc">
              <a href="{{route('product',['id'=>$item->id])}}">{!! \Illuminate\Support\Str::limit($item->name, 19, ' ...') !!}</a>
              <p>{!! \Illuminate\Support\Str::limit($item->explain, 40, ' ...') !!}</p>
              <div class="pricepl">
                @isset ($item->helpprice)
                  <p class="finalprice"><?php echo number_format($item->helpprice) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->price) ?> تومان</p>
                @else
                @if ($item->discount != NULL)
                  <p class="finalprice"><?php echo number_format($item->discount) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->price) ?> تومان</p>
                @else
                  <p class="finalprice"><?php echo number_format($item->price) ?> <span>تومان</span></p>
                @endif
                @endisset
              </div>
              <a href="{{route('product',['id'=>$item->id])}}" class="viewprd">مشاهده محصول</a>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    @endforeach
    @foreach ($categories->slice(0,2) as $category)
    <div class="firstset">
      <div class="carouseltitle">
        <h2>{{$category->name}}</h2>
        <a href="{{route('category',['slug'=>$category->slug])}}" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M20.2135 8.075L12.4531 15.95L20.2135 23.825" stroke="white" stroke-width="2"/>
          </svg>
          </a>
      </div>  
      <div class="firstcarousel" >
        @foreach ($products->where('category',$category->id) as $item)
        <div class="carousel-cell carousels">
          <div class="carouseldn">
            <a href="{{route('product',['id'=>$item->id])}}"><img src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->name}}"></a>
            <div class="productdesc">
              <a href="{{route('product',['id'=>$item->id])}}">{!! \Illuminate\Support\Str::limit($item->name, 19, ' ...') !!}</a>
              <p>{!! \Illuminate\Support\Str::limit($item->explain, 40, ' ...') !!}</p>
              <div class="pricepl">
                @isset ($item->helpprice)
                  <p class="finalprice"><?php echo number_format($item->helpprice) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->price) ?> تومان</p>
                @else
                @if ($item->discount != NULL)
                  <p class="finalprice"><?php echo number_format($item->discount) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->price) ?> تومان</p>
                @else
                  <p class="finalprice"><?php echo number_format($item->price) ?> <span>تومان</span></p>
                @endif
                @endisset
              </div>
              <a href="{{route('product',['id'=>$item->id])}}" class="viewprd">مشاهده محصول</a>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    @endforeach
  </div>
</section>

<section class="incredible">
  <div class="phoneinc">
    <div class="phoneset">
      <div class="carouseltitle">
        <h2>شگفت‌انگیزها</h2>
        <a href="#" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M20.2135 8.075L12.4531 15.95L20.2135 23.825" stroke="white" stroke-width="2"/>
          </svg>
          </a>
      </div>  
      <div class="firstcarousel" >
        @foreach ($products->where('cheap','!=',NULL) as $item)
        <div class="carousel-cell carousels">
          <div class="carouseldn">
            <a href="{{route('product',['id'=>$item->id])}}"><img src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->name}}"></a>
            <div class="productdesc">
              <a href="{{route('product',['id'=>$item->id])}}">{!! \Illuminate\Support\Str::limit($item->name, 19, ' ...') !!}</a>
              <p>{!! \Illuminate\Support\Str::limit($item->explain, 40, ' ...') !!}</p>
              <div class="pricepl">
                @isset ($item->helpprice)
                  <p class="finalprice"><?php echo number_format($item->helpprice) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->price) ?> تومان</p>
                @else
                @if ($item->discount != NULL)
                  <p class="finalprice"><?php echo number_format($item->discount) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->price) ?> تومان</p>
                @else
                  <p class="finalprice"><?php echo number_format($item->price) ?> <span>تومان</span></p>
                @endif
                @endisset
              </div>
              <a href="{{route('product',['id'=>$item->id])}}" class="viewprd">مشاهده محصول</a>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
  </div>
  <div class="deskinc">
    <div class="container">
      <div class="row">
      <div class="col-md-4">
        <h2>کتاب‌های خاص</h2>
      </div>
      <div class="col-md-8">
        <div class="inccarousel">
          @foreach ($products->where('cheap','!=',NULL) as $item)
          <div class="carousel-cell carousels">
            <div class="carouseldn">
              <a href="{{route('product',['id'=>$item->id])}}"><img src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->name}}"></a>
              <div class="productdesc">
              <a href="{{route('product',['id'=>$item->id])}}">{!! \Illuminate\Support\Str::limit($item->name, 19, ' ...') !!}</a>
                <p>{!! \Illuminate\Support\Str::limit($item->explain, 40, ' ...') !!}</p>
                <div class="pricepl">
                @isset ($item->helpprice)
                  <p class="finalprice"><?php echo number_format($item->helpprice) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->price) ?> تومان</p>
                @else
                @if ($item->discount != NULL)
                  <p class="finalprice"><?php echo number_format($item->discount) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->price) ?> تومان</p>
                @else
                  <p class="finalprice"><?php echo number_format($item->price) ?> <span>تومان</span></p>
                @endif
                @endisset
                </div>
                <a href="{{route('product',['id'=>$item->id])}}" class="viewprd">مشاهده محصول</a>
              </div>
            </div>
          </div>
        @endforeach
        </div>
        </div>
      </div>
      </div>
  </div>
</section>

<section class="content">
  <div class="container">
    @foreach ($categories->slice(2,113) as $category)
    <div class="firstset">
      <div class="carouseltitle">
        <h2>{{$category->name}}</h2>
        <a href="{{route('category',['slug'=>$category->slug])}}" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M20.2135 8.075L12.4531 15.95L20.2135 23.825" stroke="white" stroke-width="2"/>
          </svg>
          </a>
      </div>  
      <div class="firstcarousel" >
        @foreach ($products->where('category',$category->id) as $item)
        <div class="carousel-cell carousels">
          <div class="carouseldn">
            <a href="{{route('product',['id'=>$item->id])}}"><img src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->name}}"></a>
            <div class="productdesc">
              <a href="{{route('product',['id'=>$item->id])}}">{!! \Illuminate\Support\Str::limit($item->name, 19, ' ...') !!}</a>
              <p>{!! \Illuminate\Support\Str::limit($item->explain, 40, ' ...') !!}</p>
              <div class="pricepl">
                @isset ($item->helpprice)
                  <p class="finalprice"><?php echo number_format($item->helpprice) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->price) ?> تومان</p>
                @else
                @if ($item->discount != NULL)
                  <p class="finalprice"><?php echo number_format($item->discount) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->price) ?> تومان</p>
                @else
                  <p class="finalprice"><?php echo number_format($item->price) ?> <span>تومان</span></p>
                @endif
                @endisset
              </div>
              <a href="{{route('product',['id'=>$item->id])}}" class="viewprd">مشاهده محصول</a>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    @endforeach
    <div class="midlebanners" style="">
      <div class="row">
        @foreach ($banners->where('place','center')->take(4) as $item)
        <div class="col-md-6">
          <a class="middlebanner" href="{{$item->url}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" style="width:95%; border-radius:10px;margin-top:20px" alt="{{$item->title}}"></a>
        </div>
        @endforeach
      </div>
    </div>
<!--
    <div class="firstset">
      <div class="carouseltitle">
        <h2>نویسندگان</h2>
        <p>بهترین نویسندگان در سایت رواق</p>
        <a href="" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M20.2135 8.075L12.4531 15.95L20.2135 23.825" stroke="white" stroke-width="2"/>
          </svg>
          </a>
      </div>
      <div class="writersection">
        <div class="firstcarousel">
          <div class="carousel-cell">
            <div class="writer">
              <a href=""><img src="img/13680 1.png" alt=""></a>
              <p><a href="">حسین لطیفی</a></p>
            </div>
          </div>
          <div class="carousel-cell">
            <div class="writer">
              <a href=""><img src="img/13680 1.png" alt=""></a>
              <p><a href="">حسین لطیفی</a></p>
            </div>
          </div>
          <div class="carousel-cell">
            <div class="writer">
              <a href=""><img src="img/13680 1.png" alt=""></a>
              <p><a href="">حسین لطیفی</a></p>
            </div>
          </div>
          <div class="carousel-cell">
            <div class="writer">
              <a href=""><img src="img/13680 1.png" alt=""></a>
              <p><a href="">حسین لطیفی</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
-->
    <div class="deskvisd">
      <div class="firstset">
        <div class="carouseltitle">
          <h2>ببینید</h2>
          <p>بازتاب حرف های شما</p>
          <a href="{{route('media.videos')}}" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.2135 8.075L12.4531 15.95L20.2135 23.825" stroke="white" stroke-width="2"/>
            </svg>
            </a>
        </div>
        <div class="lastvids">
          <div class="row">
            <div class="col-md-8">
              @foreach($movies->slice(0,1) as $item)
                <style>
                    .bigvid::before{
                        position: absolute;
                        content: "";
                        top: 0px;
                        right: 0px;
                        border-radius: 15px;
                        width: 100%;
                        height: 100%;
                        background: -webkit-gradient(linear, right top, right bottom, from(rgb(52 75 110 / 65%)), to(rgba(5,44,112,0.65)));
                        z-index: -1;
                    }
                    .bigvid{
                        background-image: url({{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}); background-position: center; width: 100%; max-height: 440px; border-radius: 15px;    z-index: 0;
                    }
                    .bigvid a{
                        padding: 11px;
                        background: #ffffff78;
                        border-radius: 50px;
                        justify-content: center;
                        right: 46.5%;
                    }
                    .bigvid a:hover{
                        background: linear-gradient(180deg, #2892A8 0%, #2892A8 100%);
                    }
                    .lilvids{
                        min-height: 130px;
                    }
                </style>
              <div class="bigvid" >
                <a href="{{route('media.movie',['id'=>$item->id])}}">
                    <img src="https://img.icons8.com/sf-black/64/undefined/play.png">
                </a>
              </div> 
            </div>
            @endforeach
            <div class="col-md-4">
                <style>
                    .lilvids::before{
                        position: absolute;
                        content: "";
                        top: 0px;
                        right: 0px;
                        border-radius: 15px;
                        width: 100%;
                        height: 100%;
                        background: -webkit-gradient(linear, right top, right bottom, from(rgb(52 75 110 / 65%)), to(rgba(5,44,112,0.65)));
                        z-index: -1;
                    }
                    .lilvids{
                         background-position: center; width: 100%; max-height: 440px; border-radius: 15px; background-size: cover;  z-index: 0;
                    }
                    .lilvids a{
                        padding: 11px;
                        background: #ffffff78;
                        border-radius: 50px;
                        justify-content: center;
                        right: 42.5%;
                    }
                    .lilvids{
                        margin: 0px 0px 13px 5px;
                        min-height: 215px;

                    }
                    .lilvids img {
                        margin: 5px 0px;
                        width: 50px;
                    }
                    .lilvids a:hover{
                        background: linear-gradient(180deg, #2892A8 0%, #2892A8 100%);
                    }
                </style>
              @foreach($movies->slice(1,3)->take(2) as $item) 
                  <div class="lilvids" style="background-image: url({{ asset('pics/'.$item['image'].'/'.$item['image'] ) }});">
                    <a href="{{route('media.movie',['id'=>$item->id])}}">
                        <img src="https://img.icons8.com/sf-black/64/undefined/play.png">
                    </a>
                  </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="phonevid">
      <div class="phoneset">
        <div class="carouseltitle">
          <h2>ببینید</h2>
          <a href="{{route('media.videos')}}" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.2135 8.075L12.4531 15.95L20.2135 23.825" stroke="white" stroke-width="2"/>
            </svg>
            </a>
        </div>  
        <div class="firstcarousel" >
        @foreach($movies as $item)
          <div class="carousel-cell carousels">
           <a class="parenta">
            <img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" style="height:180px">
            <a href="{{route('media.movie',['id'=>$item->id])}}" class="childa">
                <img src="https://img.icons8.com/sf-black/64/undefined/play.png">
            </a>
            </a>
          </div>
        @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
