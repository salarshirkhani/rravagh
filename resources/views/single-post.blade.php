@extends('layouts.frontt')
@section('content')
<style>
    .addcomment input{
    background: #f0f0f0 !important;
    }
    .addcomment textarea {
     background: #f0f0f0 !important;   
    }
    .addcomment input[type="submit"] {
    background: #ec2525 !important;

    }
    .sidehead {
    background-color: #121864;
    }
    @media only screen and (max-width: 700px) {
      img{width:100% !important;}
    }
    .blogtext {
    text-align: right;
    text-align-last: right;
    }

</style>
<section class="content2">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
            <div class="blogorg">
                <p class="authorname">نویسنده: {{$item->writer}}</p>
                <p class="blogdate" style="color: gray;">{{ Facades\Verta::instance($item->created_at)->format('Y/n/j')}}</p>
                <h3 style="font-weight: 900; clear:both">{{$item->title}}</h3>
                <img src="{{ asset('pics/'.$item['pic'].'/'.$item['pic'] ) }}" alt="{{$item->title}}">
                <div class="blogtext">
                  @isset($item->iframe)
                    {!!$item->iframe!!}
                  @endisset
                    {!!$item->content!!}
                </div>
                <span style="display: inline-flex;color: #fff; cursor:pointer">
                @foreach($tags as $tag)
                <form action="{{ route('posttags') }}" id="{{$tag->id}}" >
                    <input type="hidden" name="q" value="{{$tag->name}}">
                </form>
                <p style="background: #d3c468;padding: 5px;margin: 10px;border-radius: 10px;" class="signle-tag" onclick="document.getElementById('{{$tag->id}}').submit();">{{$tag->name}}</p>, 
                @endforeach
            </span>
            </div>
            <div class="prodtabcontent" style="display: block;">
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
                  <form action="{{route('postcomment')}}" method="POST">
                      @csrf 
                      <input type="hidden" name="post_id" value ="{{$item->id}}" >
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
                      <div class="col-md-4">
                        <div style="border: 1px solid rgb(160, 160, 255); border-radius:10px; padding:7px;">
                            <img src="{!!Captcha::src('default')!!}" style="width:60%; display:block; margin-left:auto; margin-right:auto; margin-bottom:5px;">
                            <div class="wrap-input100 validate-input" data-validate="کپچا به درستی وارد نشده است">
                                <input type="text" name="captcha" class=" input100" placeholder="کد کپچا" id="id_capctha" required>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                          <input type="submit" value="فرستادن دیدگاه">
                      </div>
                  </form>
              </div>
            </div>            
        </div>
        <div class="col-md-3">
          <!--
            <div class="side-1">
              <div class="sidehead">
                <h4>جست و جو در مجله</h4>
              </div>
              <div class="sidebody">
                <form action="{{route('search')}}">
                    <input type="search" name="q" placeholder="جستجو...">
                </form>
              </div>
            </div>
            <div class="side-2">
                <div class="sidehead">
                  <h4>آخرین مطالب</h4>
                </div>
                <div class="sidebody">
                  <ul>
                    @foreach($posts as $writer)
                      <li><a href="{{route('post',['id'=>$writer->id])}}">{{$writer->title}}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
               -->
            <div class="side-3" style="margin-top: 70px;">
                <div class="sidehead">
                  <h4>محتوای مرتبط</h4>
                </div>
                <div class="sidebody">
                  <ul>
                    @foreach ($banners->where('place','blog') as $item)    
                    <li><a href="{{$item->url}}"><img src="{{ asset('pics/'.$item['image'].'/'.$item['image'] ) }}" alt="{{$item->title}}" style="width:100%;"></a></li>  
                    @endforeach
                  </ul>
                </div>
              </div>
          </div>
    </div>
</div>
@endsection