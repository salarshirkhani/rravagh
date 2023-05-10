<div class="col-lg-4 col-md-12 col-sm-12 col-12 d-none d-sm-none d-md-none d-lg-block d-xl-block">
   
    <div class="job_filter_category_sidebar jb_cover">
        <div class="job_filter_sidebar_heading jb_cover">
            <h1>جستجو در شرکت</h1>
        </div>
    <div class="category_jobbox jb_cover">
        <div class="jp_blog_right_search_wrapper jb_cover">
            <form action="{{ route('searchcompany') }}">
                <input type="text" placeholder="جستجو" name="q">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</div>


    <div class="job_filter_category_sidebar jb_cover">
        <div class="job_filter_sidebar_heading jb_cover">
            <h1>دسته بندی ها</h1>
        </div>

        <div class="category_jobbox jb_cover" style="color: #222021;">
            @if($categorytype=='product')
            @foreach($category as $post)
            <p class="job_field">
            <a href="{{url('products/'.$post['id'])}}" style="color: #222021;" ><i class="fas fa-hand-point-left" style="padding-left: 5px;"></i>{{$post['name']}}</a>
            </p>
            @endforeach
            @else
            @foreach($category as $post)
            <p class="job_field">
            <a href="{{url('companies/'.$post['id'])}}" style="color: #222021;" ><i class="fas fa-hand-point-left" style="padding-left: 5px;"></i>{{$post['name']}}</a>
            </p>
            @endforeach
            @endif
        </div>

    </div>
    <div class="job_filter_category_sidebar jb_cover">
        <div class="job_filter_sidebar_heading jb_cover">
            <h1>تبلیغات</h1>
        </div>
        <div class="category_jobbox jb_cover">

        @foreach($ads as $post)

        <img src="{{Storage::url($post->image)}}" style="width: 100%;" alt="{{$post->name}}" />

        @endforeach
        </div>
    </div>
    <div class="job_filter_category_sidebar jb_cover">
        <div class="job_filter_sidebar_heading jb_cover">
            <h1>بازار ماهنامه صنایع چاپ و بسته بندی</h1>
        </div>
        <div class="category_jobbox jb_cover">
            <div class="newslatter">
        <i class="fab fa-telegram"></i>
        <h3>از بازار چاپ و بسته بندی برخوردار شوید</h3>
        <h5>برای دریافت نیازهای چاپ و بسته بندی خود ثبت نام کنید</h5>
        <form action="#">
            <input type="email" placeholder="ایمیل" required="">
            <button type="submit" class="bttn-mid btn-fill">اشتراک </button>
        </form>
        <p>ما اسپم برای شما ارسال نخواهیم کرد</p>
        </div>
    </div>
</div>

    <div class="jp_add_resume_wrapper jb_cover">
        <div class="jp_add_resume_img_overlay"></div>
        <div class="jp_add_resume_cont">
            <img src="{{asset('assets/images/footerlogo.png')}}" style="height:90px;" alt="logo" />
            <h4>شما را به بالاترین قله ها می رسانیم</h4>
            <div class="width_50">
                <input type="file" id="input-file-now-custom-233" class="dropify" data-height="90" /><span class="post_photo">مشاهده کنید</span>
            </div>
        </div>
    </div>
</div>
