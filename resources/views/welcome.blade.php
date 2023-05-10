@extends('layouts.frontt')
@section('content')
<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="main-carousel" data-flickity='{ "wrapAround": false, "freScroll":true, "autoPlay": 3000, "pauseAutoPlayOnHover": true  }'>
          @foreach ($banners->where('place','slider') as $item)
          <div class="carousel-cell">           
            <a href="{{$item->url}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}"></a>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-md-4">
        <div class="mainsides">
          @foreach ($banners->where('place','side') as $item)
            <a href="{{$item->url}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}" style="max-width: 410px;"></a>
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
              <a href="{{route('product',['id'=>$item->id])}}">{{$item->name}}</a>
              <p>{!! \Illuminate\Support\Str::limit($item->explain, 55, ' ...') !!}</p>
              <div class="pricepl">
                @if ($item->discount != NULL)
                  <p class="finalprice"><?php echo number_format($item->price) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->discount) ?> تومان</p>
                @else
                  <p class="finalprice"><?php echo number_format($item->price) ?> <span>تومان</span></p>
                @endif
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
              <a href="{{route('product',['id'=>$item->id])}}">{{$item->name}}</a>
              <p>{!! \Illuminate\Support\Str::limit($item->explain, 55, ' ...') !!}</p>
              <div class="pricepl">
                @if ($item->discount != NULL)
                  <p class="finalprice"><?php echo number_format($item->price) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->discount) ?> تومان</p>
                @else
                  <p class="finalprice"><?php echo number_format($item->price) ?> <span>تومان</span></p>
                @endif
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
        <a href="" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
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
              <a href="{{route('product',['id'=>$item->id])}}">{{$item->name}}</a>
              <p>{!! \Illuminate\Support\Str::limit($item->explain, 55, ' ...') !!}</p>
              <div class="pricepl">
                @if ($item->discount != NULL)
                  <p class="finalprice"><?php echo number_format($item->price) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->discount) ?> تومان</p>
                @else
                  <p class="finalprice"><?php echo number_format($item->price) ?> <span>تومان</span></p>
                @endif
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
        <h2>محصولات<br> شگفت‌انگیز</h2>
      </div>
      <div class="col-md-8">
        <div class="inccarousel">
          @foreach ($products->where('cheap','!=',NULL) as $item)
          <div class="carousel-cell carousels">
            <div class="carouseldn">
              <a href="{{route('product',['id'=>$item->id])}}"><img src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->name}}"></a>
              <div class="productdesc">
                <a href="{{route('product',['id'=>$item->id])}}">{{$item->name}}</a>
                <p>{!! \Illuminate\Support\Str::limit($item->explain, 55, ' ...') !!}</p>
                <div class="pricepl">
                  @if ($item->discount != NULL)
                    <p class="finalprice"><?php echo number_format($item->price) ?> تومان</p>
                    <p class="originalprice"><?php echo number_format($item->discount) ?> تومان</p>
                  @else
                    <p class="finalprice"><?php echo number_format($item->price) ?> <span>تومان</span></p>
                  @endif
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
              <a href="{{route('product',['id'=>$item->id])}}">{{$item->name}}</a>
              <p>{!! \Illuminate\Support\Str::limit($item->explain, 55, ' ...') !!}</p>
              <div class="pricepl">
                @if ($item->discount != NULL)
                  <p class="finalprice"><?php echo number_format($item->price) ?> تومان</p>
                  <p class="originalprice"><?php echo number_format($item->discount) ?> تومان</p>
                @else
                  <p class="finalprice"><?php echo number_format($item->price) ?> <span>تومان</span></p>
                @endif
              </div>
              <a href="{{route('product',['id'=>$item->id])}}" class="viewprd">مشاهده محصول</a>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    @endforeach
    <div class="midlebanners">
      <div class="row">
        @foreach ($banners->where('place','center') as $item)
        <div class="col-md-6">
          <a class="middlebanner" href="{{$item->url}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}"></a>
        </div>
        @endforeach
      </div>
    </div>

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
    <div class="deskvisd">
      <div class="firstset">
        <div class="carouseltitle">
          <h2>آخرین محصولات</h2>
          <p>آخرین محصولات رواق را در اینجا مشاهده کنید.</p>
          <a href="" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.2135 8.075L12.4531 15.95L20.2135 23.825" stroke="white" stroke-width="2"/>
            </svg>
            </a>
        </div>
        <div class="lastvids">
          <div class="row">
            <div class="col-md-8">
              <div class="bigvid">
                <a href="#">
                    <img src="https://img.icons8.com/sf-black/64/undefined/play.png">
                </a>
                <img src="img/bigvid.png">
              </div>
            </div>
            <div class="col-md-4">
              <div class="lilvids">
                <a href="#">
                    <img src="https://img.icons8.com/sf-black/64/undefined/play.png">
                </a>
                <img src="img/lilvid1.png" alt="">
              </div>
              <div class="lilvids">
                <a href="#">
                    <img src="https://img.icons8.com/sf-black/64/undefined/play.png">
                </a>
                <img src="img/lilvid2.png" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="phonevid">
      <div class="phoneset">
        <div class="carouseltitle">
          <h2>فیلم‌های رواق</h2>
          <a href="" class="morebtn">مشاهده همه<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.2135 8.075L12.4531 15.95L20.2135 23.825" stroke="white" stroke-width="2"/>
            </svg>
            </a>
        </div>  
        <div class="firstcarousel" >
          <div class="carousel-cell carousels">
           <a class="parenta">
            <img src="img/bigvid.png" alt="">
            <a href="#" class="childa">
                <img src="https://img.icons8.com/sf-black/64/undefined/play.png">
            </a>
            </a>
          </div>
          <div class="carousel-cell carousels">
            <a class="parenta">
            <img src="img/bigvid.png" alt="">
            <a href="#" class="childa">
                <img src="https://img.icons8.com/sf-black/64/undefined/play.png">
            </a>
            </a>
          </div>
          <div class="carousel-cell carousels">
            <a class="parenta">
            <img src="img/bigvid.png" alt="">
            <a href="#" class="childa">
                <img src="https://img.icons8.com/sf-black/64/undefined/play.png">
            </a>
            </a>
          </div>
          <div class="carousel-cell carousels">
            <a class="parenta">
            <img src="img/bigvid.png" alt="">
            <a href="#" class="childa">
                <img src="https://img.icons8.com/sf-black/64/undefined/play.png">
            </a>
            </a>
          </div>
          <div class="carousel-cell carousels">
            <a class="parenta">
            <img src="img/bigvid.png" alt="">
            <a href="#" class="childa">
                <img src="https://img.icons8.com/sf-black/64/undefined/play.png">
            </a>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
