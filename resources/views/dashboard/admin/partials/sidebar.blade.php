<div class="emp_dashboard_sidebar jb_cover">
    <img src="{{ asset('assets/images/unknown.jpg') }}" class="img-responsive" alt="post_img" />
    <div class="emp_web_profile candidate_web_profile jb_cover">

        <h4>{{ Auth::user()->name }}</h4>
        <p>{{ Auth::user()->username }}</p>
    </div>
    <div class="emp_follow_link jb_cover">
        <ul class="feedlist">
            @include('partials.sidebar-element', [
                    'label' => 'مدیریت اطلاعات شخصی',
                    'route' => 'dashboard.index',
                    'icon' => 'tachometer-alt'
                ])
            @include('partials.sidebar-element', [
                'label' => 'ویرایش پروفایل',
                'route' => 'dashboard.profile',
                'icon' => 'edit'
            ])
            @if(!Auth::user()->company()->exists())
                @include('partials.sidebar-element', [
                    'label' => 'ثبت شرکت',
                    'route' => 'dashboard.companies.create',
                    'icon' => 'envelope'
                ])
            @else
                @include('partials.sidebar-element', [
                    'label' => 'مشاهده پروفایل شرکت',
                    'route' => 'dashboard.companies.show',
                    'icon' => 'suitcase',
                    'options' => [
                        'company' => Auth::user()->company
                    ]
                ])
                @if(Auth::user()->company->level == 'base')
                    @include('partials.sidebar-element', [
                        'label' => 'ورود به گذرگاه طلایی',
                        'route' => 'dashboard.companies.golden.start',
                        'icon' => 'medal',
                        'options' => [
                            'company' => Auth::user()->company
                        ]
                    ])
                @endif
                @if(Auth::user()->level == 'base')
                    @include('partials.sidebar-element', [
                            'label' => 'می خواهم شوالیه شوم',
                            'route' => 'dashboard.profile.knight.start',
                            'icon' => 'chess-knight'
                        ])
                    @endif
                @include('partials.sidebar-element', [
                    'label' => 'ثبت‌نام در بازار',
                    'route' => 'dashboard.companies.newsletter.subscribe',
                    'icon' => 'rss',
                    'options' => [
                        'company' => Auth::user()->company
                    ]
                ])
                @if(Auth::user()->company->type == 'productive')
                    @include('partials.sidebar-element', [
                        'label' => 'لیست محصولات',
                        'route' => 'dashboard.products.index',
                        'icon' => 'stream'
                    ])
                    @include('partials.sidebar-element', [
                        'label' => 'ثبت محصول',
                        'route' => 'dashboard.products.create',
                        'icon' => 'edit'
                    ])
                @else
                    @include('partials.sidebar-element', [
                        'label' => 'لیست خدمات',
                        'route' => 'dashboard.services.index',
                        'icon' => 'stream'
                    ])
                    @include('partials.sidebar-element', [
                        'label' => 'ثبت خدمات',
                        'route' => 'dashboard.services.create',
                        'icon' => 'edit'
                    ])
                @endif
                @if(!Auth::user()->package()->exists())
                    @include('partials.sidebar-element', [
                        'label' => 'پکیج‌های فروش',
                        'route' => 'dashboard.packages.start',
                        'icon' => 'dollar-sign'
                    ])
                @endif
            @endif
        </ul>
        <ul class="feedlist logout_link jb_cover">
            <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-power-off"></i>  خروج از حساب
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>

{{--<div class="modal fade delete_popup" id="myModal" role="dialog">--}}
{{--    <div class="modal-dialog">--}}
{{--        <div class="modal-content">--}}
{{--            <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12 col-md-12 col-sm-12 col-12">--}}

{{--                    <div class="delett_cntn jb_cover">--}}
{{--                        <h1><i class="fas fa-trash-alt"></i> حذف حساب</h1>--}}
{{--                        <p>شما مطمئن هستید! شما میخواهید پروفایل خود را حذف کنید.--}}
{{--                            <br> نمی تواند برگردانده شود!</p>--}}

{{--                        <div class="delete_jb_form">--}}

{{--                            <input type="password" name="password" placeholder="رمز عبور را وارد کنید">--}}
{{--                        </div>--}}
{{--                        <div class="header_btn search_btn applt_pop_btn">--}}

{{--                            <a href="#">ذخیره به روزرسانی</a>--}}

{{--                        </div>--}}
{{--                        <div class="cancel_wrapper">--}}
{{--                            <a href="#" class="" data-dismiss="modal">لغو</a>--}}
{{--                        </div>--}}
{{--                        <div class="login_remember_box jb_cover">--}}
{{--                            <label class="control control--checkbox">شما شرایط و ضوابط <a href="#">و حریم خصوصی </a> ما را <a href="#">میپذیرید</a>--}}
{{--                                <input type="checkbox">--}}
{{--                                <span class="control__indicator"></span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
