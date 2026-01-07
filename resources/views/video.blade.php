@extends('layouts.frontt')
@section('content')
<div class="container">
        <div class="producttitle">
            <h2>کتاب جدال زندگی</h2>
            <div class="archivehead">
              <p><a href="">صفحه اصلی</a>&gt;<a href="">عنوان دسته‌بندی</a>&gt; <a href="">عنوان دسته‌بندی</a></p>
            </div>
        </div>
        <div class="medialine"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="mediademo">
                    <img src="img/vidd 1.png" alt="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mediaprice">
                    <p class="originalprice">85000 تومان</p>
                    <p class="finalprice">85000 تومان</p>
                    <div class="addtocartbtn">
                        <a href="#">
                            <svg width="40" height="41" viewBox="0 0 40 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.1284 13.5667L13.1284 11.6516C13.1284 8.02635 16.0673 5.0875 19.6925 5.0875V5.0875C23.3178 5.0875 26.2566 8.02635 26.2566 11.6516L26.2566 13.5667" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.50864 12.4566C4.92285 13.0424 4.92285 13.9852 4.92285 15.8708V29.3083C4.92285 33.0796 4.92285 34.9652 6.09442 36.1368C7.266 37.3083 9.15162 37.3083 12.9229 37.3083H26.4613C30.2326 37.3083 32.1182 37.3083 33.2897 36.1368C34.4613 34.9652 34.4613 33.0796 34.4613 29.3083V15.8708C34.4613 13.9852 34.4613 13.0424 33.8755 12.4566C33.2897 11.8708 32.3469 11.8708 30.4613 11.8708H8.92285C7.03723 11.8708 6.09442 11.8708 5.50864 12.4566ZM15.769 20.35C15.769 19.7977 15.3213 19.35 14.769 19.35C14.2167 19.35 13.769 19.7977 13.769 20.35V23.7417C13.769 24.294 14.2167 24.7417 14.769 24.7417C15.3213 24.7417 15.769 24.294 15.769 23.7417V20.35ZM25.6152 20.35C25.6152 19.7977 25.1674 19.35 24.6152 19.35C24.0629 19.35 23.6152 19.7977 23.6152 20.35V23.7417C23.6152 24.294 24.0629 24.7417 24.6152 24.7417C25.1674 24.7417 25.6152 24.294 25.6152 23.7417V20.35Z" fill="white"></path>
                            </svg>
                        خرید و مشاهده</a>
                    </div>
                    <span class="offpercent">35%</span>
                </div>
                <div class="mediadets">
                    <table class="productspecs">
                        <tbody>
                            <tr>
                                <th>نوع فیلم</th>
                                <td>آموزشی</td>
                            </tr>
                            <tr>
                                <th>مدت زمان</th>
                                <td>22 ساعت</td>
                            </tr>
                            <tr>
                                <th>حجم</th>
                                <td>12گیگابایت</td>
                            </tr>
                            <tr>
                                <th>نوع فیلم</th>
                                <td>آموزشی</td>
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
                    <h3>توضیحات</h3>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                  </div>
                  
                  <div id="Paris" class="prodtabcontent" style="display: none;">
                    <h3>مشخصات</h3>
                    <table class="productspecs">
                        <tbody><tr>
                            <th>رنگ</th>
                            <td>قرمز</td>
                        </tr>
                        <tr>
                            <th>رنگ</th>
                            <td>قرمز</td>
                        </tr>
                        <tr>
                            <th>رنگ</th>
                            <td>قرمز</td>
                        </tr>
                        <tr>
                            <th>رنگ</th>
                            <td>قرمز</td>
                        </tr>
                    </tbody></table>
                  </div>
                  
                  <div id="Tokyo" class="prodtabcontent" style="display: none;">
                    <h3>نظرات کاربران</h3>
                    <div class="commentpart">
                        <div class="col-md-10 col-xs-10">
                            <div class="comment">
                                <p class="commentstats">23/9/1400</p>
                                <h3><b>محمدرضا</b> گفت:</h3>
                                <p>خیلی عالی واقعا ممنون از مطالب زیباتون</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="userimg"><img src="images/Profile.png" alt=""></div>
                        </div>
                    </div>
                    <div class="commentpart">
                        <div class="col-md-10 col-xs-10">
                            <div class="comment">
                                <p class="commentstats">23/9/1400</p>
                                <h3><b>محمدرضا</b> گفت:</h3>
                                <p>خیلی عالی واقعا ممنون از مطالب زیباتون</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="userimg"><img src="images/Profile.png" alt=""></div>
                        </div>
                    </div>
                    <div class="commentpart">
                        <div class="col-md-10 col-xs-10">
                            <div class="comment">
                                <p class="commentstats">23/9/1400</p>
                                <h3><b>محمدرضا</b> گفت:</h3>
                                <p>خیلی عالی واقعا ممنون از مطالب زیباتون</p>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2">
                            <div class="userimg"><img src="images/Profile.png" alt=""></div>
                        </div>
                    </div>
                    <div class="addcomment">
                        <form action="">
                          <div class="row">
                            <div class="col-md-6">
                                <div class="namepl">
                                    <label for="firstname">نام و نام خانوادگی</label>
                                    <input type="text" id="firstname">
                                </div>
                            </div>
                          <div class="col-md-6">
                                <div class="namepl">
                                    <label for="mail">ایمیل</label>
                                    <input type="email" id="mail">
                                </div>
                            </div>
                          </div>
                            <div class="col-md-12">
                                <div class="commentpl">
                                    <label for="yourcomment">دیدگاه شما</label><br>
                                    <textarea id="yourcomment" rows="4"></textarea>
                                </div>
                            </div>
                            <input type="submit" value="فرستادن دیدگاه">
                        </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection