<style>
  .teacher img {
    width: 70px;
}
</style>
<div class="col-md-3">
    <span class="humburger-menu" onclick="openNav()">☰</span>
    <div id="mySidenav" class="sidenav" style="display: none;">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
      <div class="logo"><img src="{{asset('img/logo1.png')}}"></div>
      @isset($subscribe)
      <p style="position: relative;top: 20px;text-align: center; background-color:green; color:white; padding:10px; border-radius:30px;">شما اشتراک {{$subscribe->subscribe->time}} ماهه دارید</p>
      @else
       <a href="{{route('subscription')}}" style="position: relative;display: block; width:100%;top: 20px;text-align: center; background-color:red; color:white; padding:10px; ">شما اشتراکی ندارید خریداری کنید</a>
      @endisset
      <div class="panelmenu">
        <ul>
          <li>
            <a href="{{route('dashboard.customer.index')}}" onmouseover="mousehover1()" onmouseout="mouseunhover1()">
              <svg class="hometabsvg" width="36" height="37" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path class="hometabpath1" fill-rule="evenodd" clip-rule="evenodd" d="M1 21.4978C1 11.6435 2.0745 12.3313 7.85825 6.9675C10.3888 4.9305 14.3263 1 17.7265 1C21.125 1 25.1413 4.91125 27.6945 6.9675C33.4783 12.3313 34.551 11.6435 34.551 21.4978C34.551 36 31.1228 36 17.7755 36C4.42825 36 1 36 1 21.4978Z" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
              <path class="hometabpath2" d="M12.6875 25.737H22.8637" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path></svg>داشبورد
            </a>
          </li>
          <li>   
            <a href="{{route('dashboard.customer.cart')}}" onmouseover="mousehover2()" onmouseout="mouseunhover2()">
            <svg class="shoplistsvg" width="34" height="37" viewBox="0 0 34 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="shoplistpath1" d="M21.1596 25.0268H10.9434" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="shoplistpath2" d="M17.2906 17.4379H10.9414" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="shoplistpath3" fill-rule="evenodd" clip-rule="evenodd" d="M32.2351 11.5L21.5081 1.28378C20.127 1.09459 18.5757 1 16.873 1C4.97297 1 1 5.38919 1 18.5C1 31.6297 4.97297 36 16.873 36C28.7919 36 32.7649 31.6297 32.7649 18.5C32.7649 15.8135 32.5946 13.4865 32.2351 11.5Z" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="shoplistpath4" d="M20.457 1.15648V6.1908C20.457 9.70594 23.3062 12.5532 26.8214 12.5532H32.4043" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>  
              لیست خرید
            </a>
          </li>
          <li>
            <a href="{{route('dashboard.customer.likes')}}">
              <svg class="futuresvg" width="34" height="37" viewBox="0 0 34 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="futurepath1" fill-rule="evenodd" clip-rule="evenodd" d="M32.2351 11.5L21.5081 1.28378C20.127 1.09459 18.5757 1 16.873 1C4.97297 1 1 5.38919 1 18.5C1 31.6297 4.97297 36 16.873 36C28.7919 36 32.7649 31.6297 32.7649 18.5C32.7649 15.8135 32.5946 13.4865 32.2351 11.5Z" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="futurepath2" d="M20.4551 1.15649V6.19082C20.4551 9.70595 23.3043 12.5533 26.8194 12.5533H32.4024" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="futurepath3" d="M16.1523 14.6712V26.1001" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="futurepath4" d="M20.5898 19.1276L16.1533 14.6721L11.7168 19.1276" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              لیست خرید آینده
            </a>
          </li>
          <li>
            <a href="{{route('dashboard.customer.profile')}}">
              <img class="bi x0 y0 w1 h1" style="width: 34px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADMAAAA5CAIAAAAUWIQbAAAACXBIWXMAABYlAAAWJQFJUiTwAAAFv0lEQVRo3s1ZMUj7WBz+2RwcRdCjZBBc/ojERUQdRJ9/OEVcPCOocKCCVBARBAddnI4byiGCcEiRDoJDUUEQjig6qBBBo4ipDqLESTSDQ1rOwWRJyA0/L8Y0TdO0+vdbQtvXX768vPd933uvzDRNKBqapmUyGQCIRCLhcBhKgZ+K/P/29vb8/LyiKNY3NE3Pzc2xLFtk5bLAfZbJZGZnZwVBoGm6tbW1o6MDAHiePzs7UxSFELK8vFxU/5mBoOs6y7IMw8zMzOi6bv9JVdWZmRmGYViWdfxUEAIySyaTDMPE4/FcDWKxGMMwyWTyU5mpqpq3S3RdJ4QwDKOqajBmoQAD4Pb2FgBmZ2cpisrVhqKoubk5q3EABGF2c3MDALW1td7NmpubrcafxOzw8BAAqqurvZtVVVVZjT+DmWEYgiAQQvK2pCiKECIIgmEYJVBaTdMODg4A4Pn5GQBaWloYhrE3SCQSADAwMOCneldXlyAIiURiamrK/v3d3d35+TkAVFZWVlRUtLS0ZCvfm9IahpFIJJaWlhwtaJoeHh5ua2sDgLW1tZ2dHULIysqKx/C3d/D4+LggCL29vSMjIwBwenq6vr5u9wzE9PT05OSkveYrM8Mw+vv7JUlCb8HB+/Lysr+/7yjU29u7sLDgh5aDnONRu7u7y8vLASCVSqG/OR8YtScajaJyukqULMscx/E8n06ng4lTOp3mOI7jOFmWXcUvHo8zDBONRi0CYJomx3HoM+YPBfYOz/NvzNABi/G4kgCtJRqNYi+HMpmMJEmjo6P+h84HIRwOo8pomgaghTRNA4CGhgb4AkAxwhAagq+KV6V9eHj4CmyQRjgcBoiUmabZ3t6uKMrV1VWACKpp2tbW1uXl5c7ODqpdU1PT4OBgsFKNjY00TZ+cnLzqGapGgJSHf0SwLItzHMFxXKHVMGxafwR7yvPIqNnASE0IEUXRUhxd13mex2oFCSQqLSHkndKiRhdEjud5h2Q7lMkhmz5p2T0G7BZheVReSSSEEEI8knQ6nXb0gTet7IcEh3/5eVZRFP2MJFzFiKIYrO9Djqy3uLgIAMfHx3nTNuYRD3R2duZN23ijxcXFbAdyKm0kEgGA3d1dj3KXl5f+0zY2zgW8Ed40DzNMxo4c68oebc0DmIpd72oBb+Qax0Ou3dvV1eVRDk328fHRm9n9/X1eR8YbuQ+e7KHtmL2uQdKPXOFk8i5lqVX2RAGHoOelZZdZjynsP41a5BzVwEPr8kqaq3bouo564S14ruTsUgrW22FZtqCYL0kSlmNZNplMiqIoimIymUT3JIRIklTQQgGrWQsFsF5NQYUcKwsHcq10vIGj/P8BoJapqtrY2FhXV8dxXLBQZRjG09NTKpVC+a2qqgoc3Pv6+iRJurm5oagnwFcZILR8BHDeyLJsmvLXTdshu15/kbSN3hZCd9vc3PwKzNbX12marq6uBqBCFEWNjo5KkoRD+Afi6OhIUZTh4eE3d8JJ4F9mPwKYNJ16ZndMjuPsUqSqKs/zVuSPxWKuWybekGU5FotZiwOe5+3eoOs6x3HZ7vm2f3Z0dDQxMYG7SK2trbhWtnaX6urqAECSJADY2NjIGxstpFKpoaEhRwUAIIRgQMKTDZeyDjd0aHo0GrU/oizL+HA+DUOSJOxsq6fxJWAMQRBC4vF4tsOCh/Pk2kvzv8TCJWSuPTNvBwty7tTe3g4AryvpErUsza57T0+Poih503Ymk1EUpaen5/POA0qYtkvMDGfQ/v6+d7O9vT0/i78SnyJiPPTQNpyVLMt+9imiZRuu5CxxCSDLxTKzNgcw21kMZFm2f1+MXwU/rcZDmrGxsewDEZqmV1dXvZfTH3iObkXt4+Pj6+vri4uLSCRSU1NTX1///fv34nfKi2X2YSh724X45d0PHTn+wL9e/8RPv3X889fVt59/B/j79frtD7y+x7+/vr/m+t72+391QD7fyX/WcAAAAABJRU5ErkJggg==">
             	ویرایش پروفایل
            </a>
          </li>
          <li class="gohome">
            <a href="{{route('/')}}" class="gohome">
              <svg class="hometabsvg" width="36" height="37" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path class="hometabpath1" fill-rule="evenodd" clip-rule="evenodd" d="M1 21.4978C1 11.6435 2.0745 12.3313 7.85825 6.9675C10.3888 4.9305 14.3263 1 17.7265 1C21.125 1 25.1413 4.91125 27.6945 6.9675C33.4783 12.3313 34.551 11.6435 34.551 21.4978C34.551 36 31.1228 36 17.7755 36C4.42825 36 1 36 1 21.4978Z" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
              <path class="hometabpath2" d="M12.6875 25.737H22.8637" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path></svg>
              صفحه اصلی
            </a>
          </li>
          <li>
              <svg class="gohomesvg" width="19" height="37" viewBox="0 0 19 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="gohomepath" d="M1 1C1 1 18.5 11.36 18.5 18.5C18.5 25.6375 1 36 1 36" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">خروج</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="panel-side">
      <div class="logo">
        <img src="{{asset('img/logo1.png')}}" alt="">
      </div>
      @isset($subscribe)
      <p style="position: relative;top: 20px;text-align: center; background-color:green; color:white; padding:10px; border-radius:0px;">شما اشتراک {{$subscribe->subscribe->time}} ماهه دارید</p>
      @else
       <a href="{{route('subscription')}}" style="position: relative; display: block; width:100%; top: 20px;text-align: center; background-color:red; color:white; padding:10px; ">شما اشتراکی ندارید خریداری کنید</a>
      @endisset
      <div class="panelmenu">
        <ul>
          <li>
            <a href="{{route('dashboard.customer.index')}}" onmouseover="mousehover1()" onmouseout="mouseunhover1()">
              <svg class="hometabsvg" width="36" height="37" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path class="hometabpath1" fill-rule="evenodd" clip-rule="evenodd" d="M1 21.4978C1 11.6435 2.0745 12.3313 7.85825 6.9675C10.3888 4.9305 14.3263 1 17.7265 1C21.125 1 25.1413 4.91125 27.6945 6.9675C33.4783 12.3313 34.551 11.6435 34.551 21.4978C34.551 36 31.1228 36 17.7755 36C4.42825 36 1 36 1 21.4978Z" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
              <path class="hometabpath2" d="M12.6875 25.737H22.8637" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path></svg>داشبورد
            </a>
          </li>
          <li>
            
            <a href="{{route('dashboard.customer.cart')}}" onmouseover="mousehover2()" onmouseout="mouseunhover2()">
            <svg class="shoplistsvg" width="34" height="37" viewBox="0 0 34 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="shoplistpath1" d="M21.1596 25.0268H10.9434" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="shoplistpath2" d="M17.2906 17.4379H10.9414" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="shoplistpath3" fill-rule="evenodd" clip-rule="evenodd" d="M32.2351 11.5L21.5081 1.28378C20.127 1.09459 18.5757 1 16.873 1C4.97297 1 1 5.38919 1 18.5C1 31.6297 4.97297 36 16.873 36C28.7919 36 32.7649 31.6297 32.7649 18.5C32.7649 15.8135 32.5946 13.4865 32.2351 11.5Z" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="shoplistpath4" d="M20.457 1.15648V6.1908C20.457 9.70594 23.3062 12.5532 26.8214 12.5532H32.4043" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>  
              لیست خرید
            </a>
          </li>
          <li>
            <a href="{{route('dashboard.customer.likes')}}">
              <svg class="futuresvg" width="34" height="37" viewBox="0 0 34 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="futurepath1" fill-rule="evenodd" clip-rule="evenodd" d="M32.2351 11.5L21.5081 1.28378C20.127 1.09459 18.5757 1 16.873 1C4.97297 1 1 5.38919 1 18.5C1 31.6297 4.97297 36 16.873 36C28.7919 36 32.7649 31.6297 32.7649 18.5C32.7649 15.8135 32.5946 13.4865 32.2351 11.5Z" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="futurepath2" d="M20.4551 1.15649V6.19082C20.4551 9.70595 23.3043 12.5533 26.8194 12.5533H32.4024" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="futurepath3" d="M16.1523 14.6712V26.1001" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
                <path class="futurepath4" d="M20.5898 19.1276L16.1533 14.6721L11.7168 19.1276" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              لیست خرید آینده
            </a>
          </li>
           <li>
            <a href="{{route('dashboard.customer.profile')}}">
              <img class="bi x0 y0 w1 h1" style="width: 34px;" alt="profile" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADMAAAA5CAIAAAAUWIQbAAAACXBIWXMAABYlAAAWJQFJUiTwAAAFv0lEQVRo3s1ZMUj7WBz+2RwcRdCjZBBc/ojERUQdRJ9/OEVcPCOocKCCVBARBAddnI4byiGCcEiRDoJDUUEQjig6qBBBo4ipDqLESTSDQ1rOwWRJyA0/L8Y0TdO0+vdbQtvXX768vPd933uvzDRNKBqapmUyGQCIRCLhcBhKgZ+K/P/29vb8/LyiKNY3NE3Pzc2xLFtk5bLAfZbJZGZnZwVBoGm6tbW1o6MDAHiePzs7UxSFELK8vFxU/5mBoOs6y7IMw8zMzOi6bv9JVdWZmRmGYViWdfxUEAIySyaTDMPE4/FcDWKxGMMwyWTyU5mpqpq3S3RdJ4QwDKOqajBmoQAD4Pb2FgBmZ2cpisrVhqKoubk5q3EABGF2c3MDALW1td7NmpubrcafxOzw8BAAqqurvZtVVVVZjT+DmWEYgiAQQvK2pCiKECIIgmEYJVBaTdMODg4A4Pn5GQBaWloYhrE3SCQSADAwMOCneldXlyAIiURiamrK/v3d3d35+TkAVFZWVlRUtLS0ZCvfm9IahpFIJJaWlhwtaJoeHh5ua2sDgLW1tZ2dHULIysqKx/C3d/D4+LggCL29vSMjIwBwenq6vr5u9wzE9PT05OSkveYrM8Mw+vv7JUlCb8HB+/Lysr+/7yjU29u7sLDgh5aDnONRu7u7y8vLASCVSqG/OR8YtScajaJyukqULMscx/E8n06ng4lTOp3mOI7jOFmWXcUvHo8zDBONRi0CYJomx3HoM+YPBfYOz/NvzNABi/G4kgCtJRqNYi+HMpmMJEmjo6P+h84HIRwOo8pomgaghTRNA4CGhgb4AkAxwhAagq+KV6V9eHj4CmyQRjgcBoiUmabZ3t6uKMrV1VWACKpp2tbW1uXl5c7ODqpdU1PT4OBgsFKNjY00TZ+cnLzqGapGgJSHf0SwLItzHMFxXKHVMGxafwR7yvPIqNnASE0IEUXRUhxd13mex2oFCSQqLSHkndKiRhdEjud5h2Q7lMkhmz5p2T0G7BZheVReSSSEEEI8knQ6nXb0gTet7IcEh3/5eVZRFP2MJFzFiKIYrO9Djqy3uLgIAMfHx3nTNuYRD3R2duZN23ijxcXFbAdyKm0kEgGA3d1dj3KXl5f+0zY2zgW8Ed40DzNMxo4c68oebc0DmIpd72oBb+Qax0Ou3dvV1eVRDk328fHRm9n9/X1eR8YbuQ+e7KHtmL2uQdKPXOFk8i5lqVX2RAGHoOelZZdZjynsP41a5BzVwEPr8kqaq3bouo564S14ruTsUgrW22FZtqCYL0kSlmNZNplMiqIoimIymUT3JIRIklTQQgGrWQsFsF5NQYUcKwsHcq10vIGj/P8BoJapqtrY2FhXV8dxXLBQZRjG09NTKpVC+a2qqgoc3Pv6+iRJurm5oagnwFcZILR8BHDeyLJsmvLXTdshu15/kbSN3hZCd9vc3PwKzNbX12marq6uBqBCFEWNjo5KkoRD+Afi6OhIUZTh4eE3d8JJ4F9mPwKYNJ16ZndMjuPsUqSqKs/zVuSPxWKuWybekGU5FotZiwOe5+3eoOs6x3HZ7vm2f3Z0dDQxMYG7SK2trbhWtnaX6urqAECSJADY2NjIGxstpFKpoaEhRwUAIIRgQMKTDZeyDjd0aHo0GrU/oizL+HA+DUOSJOxsq6fxJWAMQRBC4vF4tsOCh/Pk2kvzv8TCJWSuPTNvBwty7tTe3g4AryvpErUsza57T0+Poih503Ymk1EUpaen5/POA0qYtkvMDGfQ/v6+d7O9vT0/i78SnyJiPPTQNpyVLMt+9imiZRuu5CxxCSDLxTKzNgcw21kMZFm2f1+MXwU/rcZDmrGxsewDEZqmV1dXvZfTH3iObkXt4+Pj6+vri4uLSCRSU1NTX1///fv34nfKi2X2YSh724X45d0PHTn+wL9e/8RPv3X889fVt59/B/j79frtD7y+x7+/vr/m+t72+391QD7fyX/WcAAAAABJRU5ErkJggg==">
             	ویرایش پروفایل
            </a>
          </li>
          
          <li class="gohome">
            <a href="{{route('/')}}" class="gohome">
              <svg class="hometabsvg" width="36" height="37" viewBox="0 0 36 37" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path class="hometabpath1" fill-rule="evenodd" clip-rule="evenodd" d="M1 21.4978C1 11.6435 2.0745 12.3313 7.85825 6.9675C10.3888 4.9305 14.3263 1 17.7265 1C21.125 1 25.1413 4.91125 27.6945 6.9675C33.4783 12.3313 34.551 11.6435 34.551 21.4978C34.551 36 31.1228 36 17.7755 36C4.42825 36 1 36 1 21.4978Z" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
              <path class="hometabpath2" d="M12.6875 25.737H22.8637" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path></svg>
              صفحه اصلی
            </a>
          </li>
          <li>
              <svg class="gohomesvg" width="19" height="37" viewBox="0 0 19 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="gohomepath" d="M1 1C1 1 18.5 11.36 18.5 18.5C18.5 25.6375 1 36 1 36" stroke="#555555" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">خروج</a>
          </li>
        </ul>
      </div>
    </div>
  </div>