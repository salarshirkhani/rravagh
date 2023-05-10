<?php use Hekmatinasser\Verta\Verta; 
$now = now()->startOfDay();
use Carbon\Carbon;
?>
@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('title', __('داشبورد'))
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
@endsection
@section('content')
<?php
$products=0;
$users=0;
foreach ($Product as $key) {
    $products++;
}
foreach ($user as $key) {
    $users++;
}
?>
<?php
 $previous_week = strtotime("-1 week +1 day");
 $start_week = strtotime("last sunday midnight",$previous_week);
 $end_week = strtotime("next saturday",$start_week);

$chart[]=0;
$i=0;
foreach($user as $item){
  $chart[$i]=$item->id;
  $i++;
}  
$usermcount = [];
$userycount = [];
$userdcount = [];
$userArr = [];
$userAr = [];
$userA = [];
foreach ($transa as $key => $value) {
      $userdcount[(int)$key] = count($value);
 }
foreach ($transac as $key => $value) {
      $userycount[(int)$key] = count($value);
 }
foreach ($transactionm as $key => $value) {
      $usermcount[(int)$key] = count($value);
 }
for($i = 1; $i <= 12; $i++){
  if(!empty($usermcount[$i])){
    $userArr[$i] = $usermcount[$i];    
    
  }else{
   $userArr[$i] = 0;    
  }
}
for($i = 2020; $i <= 2030; $i++){
  if(!empty($userycount[$i])){
    $userAr[$i] = $userycount[$i];    
    
  }else{
   $userAr[$i] = 0;    
  }
}
for($i = 1; $i <= 30; $i++){
  if(!empty($userdcount[$i])){
    $userA[$i] = $userdcount[$i];    
    
  }else{
   $userA[$i] = 0;    
  }
}
?>
    <div class="container">
        <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>

              <p>سفارش</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>250000<sup style="font-size: 20px">هزارتومان</sup></h3>

              <p>درامد این ماه</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $users ; ?></h3>

              <p>کاربران </p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('dashboard.admin.users.index')}}" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger" style="background: #358e82 !important">
            <div class="inner">
              <h3><?php echo $products ; ?></h3>

              <p>عدد محصول </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('dashboard.admin.product.manage')}}" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="card bg-gradient-info">
        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">
        <i class="fas fa-th mr-1"></i>
        نمودار فروش
        </h3>
        <div class="card-tools">
        <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
        <i class="fas fa-times"></i>
        </button>
        </div>
        </div>
        <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
        <div class="latestlist">
          <div class="chartbar">
              <div class="chartshead">
                <div class="tab">
                  <button class="tablinks" onclick="openCity(event, 'London')">سالانه</button>
                  <button class="tablinks" onclick="openCity(event, 'Paris')">ماهانه</button>
                  <button class="tablinks" onclick="openCity(event, 'Tokyo')" onload="openfirst()" id="defaultOpen">روزانه</button>
                </div>
               </div>
            
            <div id="London" class="tabcontent">
              <canvas id="bar-chart" width="300" height="150"></canvas>  
            </div>
            
            <div id="Paris" class="tabcontent">
              <canvas id="bar-chart2" width="300" height="150"></canvas>  
            </div>
            
            <div id="Tokyo" class="tabcontent">
              <canvas id="bar-chart3" width="300" height="150"></canvas>
            </div>
          </div> 
          <script>
        document.getElementById("defaultOpen").click();
        Chart.defaults.global.defaultFontFamily ='kalameh',
        new Chart(document.getElementById("bar-chart"), {
            type: 'line',
            data: {
              labels: ["2020", "2021", "2022", "2023", "2024" , "2025" , "2026"],
              datasets: [
                {
                    fill:false,
                  label: "فروش سالانه",
                  backgroundColor: ["red", "blue","yellow","green","pink"],
                  data: [<?php echo $userAr[2020].','.$userAr[2021].','.$userAr[2022].','.$userAr[2023].','.$userAr[2024].','.$userAr[2025].','.$userAr[2026].','.$userAr[2027].','.$userAr[2028].','.$userAr[2029].','.$userAr[2030]; ?>],
                }
              ]
            },
            options: {
              legend: { display: false },
              title: {
                display: true,
              },
         
              scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
         
            }
         
         
        });
        new Chart(document.getElementById("bar-chart2"), {
            type: 'line',
            data: {
              labels: ["فروردین","اردیبهشت","خرداد","تیر","مرداد","شهریور", "مهر", "آبان", "آذر", "دی" , "بهمن" , "اسفند"],
              datasets: [
                {
                    fill:false,
                  label: "فروش ماهانه",
                  backgroundColor: ["red", "blue","yellow","green","pink","red","blue","yellow","green","pink","red", "blue","yellow","green","pink"],
                  data:[<?php echo $userArr[4].','.$userArr[5].','.$userArr[6].','.$userArr[7].','.$userArr[8].','.$userArr[9].','.$userArr[10].','.$userArr[11].','.$userArr[12].','.$userArr[1].','.$userArr[2].','.$userArr[3]; ?>],
                }
              ]
            },
            options: {
              legend: { display: false },
              title: {
                display: true,
              },
         
              scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
         
            }
         
         
        }); 
        new Chart(document.getElementById("bar-chart3"), {
            type: 'line',
            data: {
              labels: [
               <?php for($i=1 ; $i<=30 ; $i++){
                 echo $i.',' ;
               } 
               ?>
               ],
              datasets: [
                {
                    fill:false,
                  label: "فروش روزانه",
                  backgroundColor: ["red", "blue","yellow","green","pink","red", "blue","yellow","green","pink","red", "blue","yellow","green","pink","red", "blue","yellow","green","pink","red", "blue","yellow","green","pink","red", "blue","yellow","green","pink"],
                  data: [
                    <?php for($i=1 ; $i<=30 ; $i++){
                     echo $userA[$i].','; 
                    } ?>
                    ],
                }
              ]
            },
            options: {
              legend: { display: false },
              title: {
                display: true,
              },
         
              scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
         
            }
         
         
        });     
        //chart tabs   
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;
          
            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
          
            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
          
            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
          } 
        </script>             
        </div>
        </div>
        
        </div>
      
      <x-card type="info">
        <x-card-header> نظر ها</x-card-header>
            <x-card-body>
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>توسط</th>
                            <th>متن</th>
                            <th>پست</th>
                            <th>حذف</th>                               
                            <th>نمایش</th>
                        </tr>
                        </thead>
                            <tbody>
                         @foreach($comments as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{!! $item->description !!}</td>
                                   @isset($item->product_id)
                                    <td>{{ $item->product->name }}</td>
                                    @endisset
                                    
                                    
                                    @isset($item->post_id)
                                    <td>{{ $item->post->title }}</td>
                                    @endisset
                                    
                                    @isset($item->movie_id)
                                    <td>{{ $item->movie->title }}</td>
                                    @endisset                                <td>
                                <a href="{{route('dashboard.admin.comment.deletecomment',['id'=>$item->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>                 
                                </td>
                                <td>
                                <a href="{{route('dashboard.admin.comment.updatecomment',['id'=>$item->id])}}" class="edit_post" target="_blank"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                         @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>توسط</th>
                            <th>متن</th>
                            <th>پست</th>
                                <th>حذف</th>                               
                                <th>نمایش</th>
                            </tr>
                            </tfoot>
                    </table>
                </div>
                </x-card-body>
            <x-card-footer>
                
            </x-card-footer>      
    </x-card>
    <x-card type="info">
      <x-card-header>تولد های نزدیک</x-card-header>
          <x-card-body>
              <div class="box-body">
                  <table id="example1" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                          <th>نام و نام خانوادگی</th>
                          <th>شماره موبایل</th>
                          <th>ایمیل</th>
                          <th>تاریخ تولد</th>
                          
                      </tr>
                      </thead>
                          <tbody>
                       @foreach($birth as $item)
                          <tr>
                            <td>{{ $item->first_name }} {{$item->last_name}}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ Facades\Verta::instance($item->birthdate)->format('Y/n/j')}}</td>  
                          </tr>
                       @endforeach
                          </tbody>
                          <tfoot>
                          <tr>
                            <th>نام و نام خانوادگی</th>
                            <th>شماره موبایل</th>
                            <th>ایمیل</th>
                            <th>تاریخ تولد</th>
                          </tr>
                          </tfoot>
                  </table>
              </div>
              </x-card-body>
          <x-card-footer>
              
          </x-card-footer>      
  </x-card>
    </div>

@endsection

