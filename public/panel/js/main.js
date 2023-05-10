document.getElementById("defaultOpen").click();
//menu hover effects
var image = document.getElementById("image");
  
  
  /*function mousehover1(){
    document.getElementById("image").src = "http://webitofa.ir/dubaishop/images/Homeyel.svg";
  }
  function mouseunhover1(){
    document.getElementById("image").src = "http://webitofa.ir/dubaishop/images/Home.svg";
    }
    function mousehover2(){
    document.getElementById("image2").src = "http://webitofa.ir/dubaishop/images/Paperyel.svg";
  }
  function mouseunhover2(){
    document.getElementById("image2").src = "http://webitofa.ir/dubaishop/images/Paper.svg";
    }
    function mousehover11(){
      document.getElementById("image11").src = "http://webitofa.ir/dubaishop/images/Homeyel.svg";
    }
    function mouseunhover11(){
      document.getElementById("image11").src = "http://webitofa.ir/dubaishop/images/Home.svg";
      }
      function mousehover22(){
      document.getElementById("image22").src = "http://webitofa.ir/dubaishop/images/Paperyel.svg";
    }
    function mouseunhover22(){
      document.getElementById("image22").src = "http://webitofa.ir/dubaishop/images/Paper.svg";
      }*/

//charts
Chart.defaults.global.defaultFontFamily ='kalamehbold',
        new Chart(document.getElementById("bar-chart"), {
            type: 'line',
            data: {
              fill: false,
              labels: ["ش", "ی", "د", "س", "چ" , "پ" , "ج"],
              datasets: [
                {
                  label: "Number of developers (millions)",
                  backgroundColor: ["red", "blue","yellow","green","pink"],
                  data: [7,4,6,9,3]
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
              fill: false,
              labels: ["ش", "ی", "د", "س", "چ" , "پ" , "ج"],
              datasets: [
                {
                  label: "Number of developers (millions)",
                  backgroundColor: ["red", "blue","yellow","green","pink"],
                  data: [0,25,30,50,75,80,100]
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
              fill: false,
              labels: ["ش", "ی", "د", "س", "چ" , "پ" , "ج"],
              datasets: [
                {
                  label: "Number of developers (millions)",
                  backgroundColor: ["red", "blue","yellow","green","pink"],
                  data: [7,4,6,9,3]
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
          //show notifications
          function shownotifs(){
            if(document.getElementById("notifications").style.display == "none"){  
                document.getElementById("notifications").style.display="block";
                document.getElementById("latestheading").style.opacity = "0.5";
            }
          }
          function hidenotifs(){
            if(document.getElementById("notifications").style.display == "block"){  
                document.getElementById("notifications").style.display = "none";
                document.getElementById("latestheading").style.opacity = "1";
            }
        }
        function openNav() {
          document.getElementById("mySidenav").style.width = "80%";
          document.getElementById("mySidenav").style.display= "block"; 
        }
        
        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
          document.getElementById("mySidenav").style.display= "none";
      
        }