@extends('layouts.frontt')
@section('content')
<div class="container" oncontextmenu="return false;">
    <div class="producttitle">
        <h2>{{$item->title}}</h2>
        <div class="archivehead">
          <p><a href="{{route('media.index')}}">صفحه اصلی</a>&gt;<a href="">{{$category->name}}</a>&gt; <a href="">{{$item->title}}</a></p>
        </div>
    </div>
    <style>
        .mediaprice .finalprice {
            font-size: 22px;
        }
    </style>
    <script>
document.addEventListener('DOMContentLoaded', function(){
    var v = document.getElementById('v');
    var canvas = document.getElementById('c');
    var context = canvas.getContext('2d');

    var cw = Math.floor(canvas.clientWidth / 100);
    var ch = Math.floor(canvas.clientHeight / 100);
    canvas.width = cw;
    canvas.height = ch;

    v.addEventListener('play', function(){
        draw(this,context,cw,ch);
    },false);

},false);

function draw(v,c,w,h) {
    if(v.paused || v.ended) return false;
    c.drawImage(v,0,0,w,h);
    setTimeout(draw,20,v,c,w,h);
}
   var v = document.getElementById('v');
    var canvas = document.getElementById('c');
    var context = canvas.getContext('2d');

    var cw = Math.floor(canvas.clientWidth / 100);
    var ch = Math.floor(canvas.clientHeight / 100);
    canvas.width = cw;
    canvas.height = ch;
</script>
    <div class="medialine"></div>
    <div class="row">
        <div class="col-md-9">
            <div class="mediademo">
            <script>
            $(document).ready(function(){
               $('#videoElementID').bind('contextmenu',function() { return false; });
            });
            </script>
            @isset($subscribe)
            <canvas id=c></canvas>
                <video  id=v height="500" style="width:100%;" controls>
                    <source src="{{ asset('pics/'.$item['link'].'/'.$item['link'] ) }}" type="video/mp4">
                </video>
            @else
                @isset($item->trailer)
                    {!!$item->trailer!!}
                 @else
                    <img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="">
                @endisset
            @endisset

            </div>
        </div>
        <div class="col-md-3">
            
            <div class="mediaprice">
                @isset($subscribe)

                @else
                    <p class="finalprice">برای مشاهده فیلم باید اشتراک دیجی ریحان را خریداری کنید</p>
                    <div class="addtocartbtn">
                        <a href="{{route('subscription')}}">
                            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.1284 13.5667L13.1284 11.6516C13.1284 8.02635 16.0673 5.0875 19.6925 5.0875V5.0875C23.3178 5.0875 26.2566 8.02635 26.2566 11.6516L26.2566 13.5667" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.50864 12.4566C4.92285 13.0424 4.92285 13.9852 4.92285 15.8708V29.3083C4.92285 33.0796 4.92285 34.9652 6.09442 36.1368C7.266 37.3083 9.15162 37.3083 12.9229 37.3083H26.4613C30.2326 37.3083 32.1182 37.3083 33.2897 36.1368C34.4613 34.9652 34.4613 33.0796 34.4613 29.3083V15.8708C34.4613 13.9852 34.4613 13.0424 33.8755 12.4566C33.2897 11.8708 32.3469 11.8708 30.4613 11.8708H8.92285C7.03723 11.8708 6.09442 11.8708 5.50864 12.4566ZM15.769 20.35C15.769 19.7977 15.3213 19.35 14.769 19.35C14.2167 19.35 13.769 19.7977 13.769 20.35V23.7417C13.769 24.294 14.2167 24.7417 14.769 24.7417C15.3213 24.7417 15.769 24.294 15.769 23.7417V20.35ZM25.6152 20.35C25.6152 19.7977 25.1674 19.35 24.6152 19.35C24.0629 19.35 23.6152 19.7977 23.6152 20.35V23.7417C23.6152 24.294 24.0629 24.7417 24.6152 24.7417C25.1674 24.7417 25.6152 24.294 25.6152 23.7417V20.35Z" fill="white"></path>
                            </svg>
                        خرید اشتراک</a>
                    </div>
                @endisset
                
            </div>
        
            <div class="mediadets">
                <table class="productspecs">
                    <tbody>
                        <tr>
                            <th>نوع فیلم</th>
                            <td>{{$category->name}}</td>
                        </tr>
                        <tr>
                            <th>مدت زمان</th>
                            <td>{{$item->duaration}}</td>
                        </tr>
                        <tr>
                            <th>سال تولید</th>
                            <td>{{$item->year}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="productdetshead">
            <div class="col-md-3 col-xs-6">
                <button class="prodtablinks active" onclick="openCity1(event, 'London')" id="defaultOpenn">توضیحات</button>
            </div>
            <div class="col-md-3 col-xs-6">
                <button class="prodtablinks" onclick="openCity1(event, 'Tokyo')">نظرات کاربران</button>				  
            </div>
        </div>
        <div class="productdestbody">
            <div id="London" class="prodtabcontent" style="display: block;">
                <h3>توضیحات</h3>
                {!! $item->description !!}
              </div>
              
              
              
              <div id="Tokyo" class="prodtabcontent" style="display: none;">
                <h3>نظرات کاربران</h3>
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
                        <input type="hidden" name="movie_id" value ="{{$item->id}}" >
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
                       <div class="g-recaptcha" data-sitekey="6LfOX1YhAAAAALbrLeOGqemecG9PE6pmrx_tAYXJ"></div>
                        <div class="col-md-12">
                            <input type="submit" value="فرستادن دیدگاه">
                        </div>
                    </form>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection