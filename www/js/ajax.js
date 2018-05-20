var str;
var txt;


function getlga(str){
  var url = 'lga?get='+ str;
  var method = 'GET';
  // var params = 'state=' + document.getElementById('stateid').value;
  ajax(url,method,str);
  console.log(url);
}

function vis(cls,text){
  var btn = document.getElementById(cls);
  btn.className = text;
  console.log(btn);
}

function getWorkers(str){
  var url = 'fetchRequest?get='+ str;
  var method = 'GET';
  // var params = 'state=' + document.getElementById('stateid').value;
  showWorker(url,method,str);
  console.log(url);
}

function ajax(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      document.getElementById('lga').innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send();
  console.log(sd);
}

function showWorker(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      document.getElementById('showWkr').innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send();

}


window.addEventListener("load", function(e){
  updateLocation();

  function showPosition(position) {
    var lat =  position.coords.latitude;
    var long= position.coords.longitude;
    sessionStorage.setItem("UserCurrentLat", lat);
    sessionStorage.setItem("UserCurrentLong", long);
  }

  function showError(error) {
    switch(error.code) {
      case error.PERMISSION_DENIED:
      //alert("User denied the request for Geolocation.");
      break;
      case error.POSITION_UNAVAILABLE:
      // alert("Location information is unavailable.");
      break;
      case error.TIMEOUT:
      // alert("The request to get user location timed out.");
      break;
      case error.UNKNOWN_ERROR:
      // alert("An unknown error occurred.");
      break;
    }
  }

  if (navigator.geolocation) {
    var optn = {
      enableHighAccuracy : true,
      timeout : Infinity,
      maximumAge : 0
    };
    navigator.geolocation.getCurrentPosition(showPosition, showError, optn);
  } else {
    alert('Geolocation is not supported in your browser');
  }

}, false);

function updateLocation(){
  var lat = sessionStorage.getItem("UserCurrentLat");
  var long = sessionStorage.getItem("UserCurrentLong");
  var url = 'u_locate';
  var method = 'POST';
  var params = 'my_long='+ long;
  params += '&my_lat='+lat;
params += '&session=' + document.getElementById('session').value; 
  console.log(url);

  locateAjax(url, method, params);
}

function locateAjax(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      console.log(res);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);

}
