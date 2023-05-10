@extends('layouts.panel')
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.teacher.index" />
@endsection
@section('panel')
<?php
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
        <div class="col-md-6">
          <h3 class="pagetitle">خانه</h3>
        </div>
      </div>
    </div>
    <h3 class="latesttitle">آخرین <b>خریدها</b></h3>
    <div class="container">
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
                <canvas id="bar-chartt" width="300" height="150"></canvas>  
              </div>
              
              <div id="Paris" class="tabcontent">
                <canvas id="bar-chartt2" width="300" height="150"></canvas>  
              </div>
              
              <div id="Tokyo" class="tabcontent">
                <canvas id="bar-chartt3" width="300" height="150"></canvas>
              </div>
            </div> 
            <script>
              document.getElementById("defaultOpen").click();
              Chart.defaults.global.defaultFontFamily ='kalameh',
              new Chart(document.getElementById("bar-chartt"), {
                  type: 'line',
                  data: {
                    fill:false,
                    labels: ["2020", "2021", "2022", "2023", "2024" , "2025" , "2026"],
                    datasets: [
                      {
                        label: "فروش سالانه",
                        backgroundColor: ["red", "blue","yellow","green","pink"],
                        data: [<?php echo $userAr[2020].','.$userAr[2021].','.$userAr[2022].','.$userAr[2023].','.$userAr[2024].','.$userAr[2025].','.$userAr[2026].','.$userAr[2027].','.$userAr[2028].','.$userAr[2029].','.$userAr[2030]; ?>]

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
            </script>
            <script>
              new Chart(document.getElementById("bar-chartt2"), {
                  type: 'line',
                  data: {
                    fill:false,
                    labels: ["فروردین","اردیبهشت","خرداد","تیر","مرداد","شهریور", "مهر", "آبان", "آذر", "دی" , "بهمن" , "اسفند"],
                    datasets: [
                      {
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
              </script><script>
              new Chart(document.getElementById("bar-chartt3"), {
                  type: 'line',
                  data: {
                    fill:false,
                    labels: [
                     <?php for($i=1 ; $i<=30 ; $i++){
                       echo $i.',' ;
                     } 
                     ?>
                     ],
                    datasets: [
                      {
                        label: "فروش روزانه",
                        backgroundColor: ["red", "blue","yellow","green","pink","red", "blue","yellow","green","pink","red", "blue","yellow","green","pink","red", "blue","yellow","green","pink","red", "blue","yellow","green","pink","red", "blue","yellow","green","pink"],
                        data: [<?php for($i=1 ; $i<=30 ; $i++){echo $userA[$i].',';  } ?>]
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

              </script>            
          </div>
    </div>
    <div class="latestfoot">
      <div class="footcol1">
            <h5>تعداد کل <b>خریدهای شما</b></h5>
            <h5><b>{{$orders->count()}}</b><br>عدد</h5>
          </div>
          @isset($discount) 
            <div class="footcol2">
              <h5><b> کد تخفیف</b> برای خرید بعدی</h5>
              <p>اعتبار تا تاریخ {{ Facades\Verta::instance($discount->finish_date)->format('Y/n/j')}}</p>
              <h5><b> {{$discount->code}}</b></h5>
              <p>%{{$discount->discount}} </p>
            </div> 
          @endisset 
      </div>
  </div>

    @include('dashboard.teacher.sidebar')

@endsection
