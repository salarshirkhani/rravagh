// $('.firstcarousel').flickity({
//     freeScroll: true,
//     contain: true,
//     // disable previous & next buttons and dots
//     prevNextButtons: false,
//     pageDots: false,
//     autoPlay: true
//   });
function increaseCount(a, b) {
    var input = b.previousElementSibling;
    var value = parseInt(input.value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    input.value = value;
  }
  
  function decreaseCount(a, b) {
    var input = b.nextElementSibling;
    var value = parseInt(input.value, 10);
    if (value > 1) {
      value = isNaN(value) ? 0 : value;
      value--;
      input.value = value;
    }
  }
  function openCity1(evt, cityName) {
    var i, prodtabcontent, prodtablinks;
    prodtabcontent = document.getElementsByClassName("prodtabcontent");
    for (i = 0; i < prodtabcontent.length; i++) {
      prodtabcontent[i].style.display = "none";
    }
    prodtablinks = document.getElementsByClassName("prodtablinks");
    for (i = 0; i < prodtablinks.length; i++) {
      prodtablinks[i].className = prodtablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  function phoneormail(){
    if(document.getElementById('email').checked){
    document.getElementById('urmail').style.display="block";
    document.getElementById('urphone').style.display="none";
  document.getElementById('urmaillabel').style.display="block";
  document.getElementById('urphonelabel').style.display="none";
  }
  else if(document.getElementById('phonenum').checked){
    document.getElementById('urmail').style.display="none";
    document.getElementById('urphone').style.display="block";
  document.getElementById('urmaillabel').style.display="none";
  document.getElementById('urphonelabel').style.display="block";
  }
  else if(document.getElementById('urgent').checked){
    document.getElementById('urmail').style.display="none";
    document.getElementById('urphone').style.display="block";
  document.getElementById('urmaillabel').style.display="none";
  document.getElementById('urphonelabel').style.display="block";
  }
  }
  function openshop(){
	  document.getElementById("shopbag").style.display = "block";
  }
  function closeshop(){
	  document.getElementById("shopbag").style.display = "none";
}
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
// Get the modal
var modal2 = document.getElementById("myModal2");

// Get the button that opens the modal
var btn2 = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal 
btn2.onclick = function() {
  modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal2.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal2) {
    modal2.style.display = "none";
  }
}