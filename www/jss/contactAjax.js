
setInterval(function(){
getMessageNofication();
getMessageNoficationCount();
}, 7000);
setInterval(function(){
  getNoficationCount();
  getNofication();
}, 5000);





function getMessageNoficationCount(){
  var url = 'getTworkersMessageNotificationCount';
  var method = 'POST';
  var params = 'session='+ document.getElementById('session').value;
  // var params = 'state=' + document.getElementById('stateid').value;
  showMessageNoficationCount(url,method,params);
  ////console.log(url);
}

function showMessageNoficationCount(url, method,params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
    document.getElementById('msgNotCnt').innerHTML = xhr.responseText;
    ////console.log(document.getElementById('notCnt').innerHTML);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send(params);
}

function getMessageNofication(){
  var url = 'getTworkersMessageNotification';
  var method = 'POST';
  var params = 'session='+ document.getElementById('session').value;
  // var params = 'state=' + document.getElementById('stateid').value;
  showMessageNofication(url,method,params);
  ////console.log(url);
}

function showMessageNofication(url, method,params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
       var res = xhr.responseText;
       ////console.log(res);
    document.getElementById('msgNot').innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send(params);
}


function getContact(){
  var url = 'getTContact';
  var method = 'POST';
  var params = 'session='+ document.getElementById('session').value;
  // var params = 'state=' + document.getElementById('stateid').value;
  showContact(url,method,params);
  //console.log(url);
}

function showContact(url, method,params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
       var res = xhr.responseText;
       document.getElementById('contact').innerHTML = res;

    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send(params);
}

function getNofication(){
  var url = 't_notification';
  var method = 'POST';
  var params = 'session='+ document.getElementById('session').value;
  // var params = 'state=' + document.getElementById('stateid').value;
  showNofication(url,method,params);
  ////console.log(url);
}

function showNofication(url, method,params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
       var res = xhr.responseText;
       ////console.log(res);
    document.getElementById('not').innerHTML = xhr.responseText;


    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send(params);
}








function redirect(page){
  window.location = page;
}


  function getNoficationCount(){
    var url = 't_notificationCount';
    var method = 'POST';
    var params = 'session='+ document.getElementById('session').value;
    // var params = 'state=' + document.getElementById('stateid').value;
    showNoficationCount(url,method,params);
    ////console.log(url);
  }

  function showNoficationCount(url, method,params){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4){
      document.getElementById('notCnt').innerHTML = xhr.responseText;
      ////console.log(document.getElementById('notCnt').innerHTML);
      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var sd = xhr.send(params);
  }








  function updateLocation(){
    var lat = sessionStorage.getItem("TworkersCurrentLat");
    var long = sessionStorage.getItem("TworkersCurrentLong");
    var url = 't_home?updLoc=upt';
    var method = 'POST';
    var params = 'my_long='+ long;
    params += '&my_lat='+lat;

    ajax(url, method, params);
  }

  function ajax(url, method, params){
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4){
        var res = xhr.responseText;

      }
    }
    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    var sd = xhr.send(params);

  }

  window.addEventListener("load", function(e){

    function showPosition(position) {
      var lat = position.coords.latitude;
      var long= position.coords.longitude;
      sessionStorage.setItem("TworkersCurrentLat", lat);
      sessionStorage.setItem("TworkersCurrentLong", long);
    }

    function showError(error) {
      switch(error.code) {
        case error.PERMISSION_DENIED:
        //alert("User denied the request for Geolocation.");
        break;
        case error.POSITION_UNAVAILABLE:
        //alert("Location information is unavailable.");
        break;
        case error.TIMEOUT:
        //alert("The request to get user location timed out.");
        break;
        case error.UNKNOWN_ERROR:
        //alert("An unknown error occurred.");
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
      //alert('Geolocation is not supported in your browser');
    }

  }, false);
