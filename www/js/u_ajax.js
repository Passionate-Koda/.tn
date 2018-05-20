var str;
var txt;





function getlga(str){
  var url = 'lga?get='+ str;
  var method = 'GET';
  // var params = 'state=' + document.getElementById('stateid').value;
  ajax(url,method,str);
  //console.log(url);
}





function getNofication(str){
  var url = 'u_notification?get='+ str;
  var method = 'GET';
  // var params = 'state=' + document.getElementById('stateid').value;
  showNofication(url,method);
  ////console.log(url);
}

function showNofication(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
       var res = xhr.responseText;
       //////console.log(res);
    //document.getElementById('showNot').innerHTML = xhr.responseText;

    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send();
}

function getPage(str){
  var url = 'reply?id='+str;
  var method = 'GET';
  // var params = 'state=' + document.getElementById('stateid').value;
  showPage(url,method);
  ////console.log(url);
}

function showPage(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
       var res = xhr.responseText;
       ////console.log(res);
    //document.getElementById('page').innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send();
}
//////console.log
function getNoficationCount(str){
  var url = 'u_notificationCount?get='+ str;
  var method = 'GET';
  // var params = 'state=' + document.getElementById('stateid').value;
  showNoficationCount(url,method);
  ////console.log(url);
}

function showNoficationCount(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      ////console.log(xhr.responseText);
    //document.getElementById('notCnt').innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send();
}

function showWorkerPage(page){
  window.location = page;

}

function getWorkers(str){
  var url = 'fetchRequest?get='+ str;
  var method = 'GET';
  // var params = 'state=' + document.getElementById('stateid').value;
  showWorker(url,method,str);
  ////console.log(url);
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
  ////console.log(sd);
}

function showWorker(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      //document.getElementById('showWkr').innerHTML = xhr.responseText;
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

function updateLocation(){
  var lat = sessionStorage.getItem("UserCurrentLat");
  var long = sessionStorage.getItem("UserCurrentLong");
  var url = 'u_locate';
  var method = 'POST';
  var params = 'my_long='+ long;
  params += '&my_lat='+lat;
  params += '&session=' + document.getElementById('session').value;
  ////console.log(url);

  locateAjax(url, method, params);
}

function locateAjax(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      ////console.log(res);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}

function getPendingTaskCount(){
  var url = 'u_PendingTaskCount';
  var method = 'GET';
  // var params = 'state=' + document.getElementById('stateid').value;
  showPendingTaskCount(url,method);
  ////console.log(url);
}

function showPendingTaskCount(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      //document.getElementById('ptaskNot').innerHTML = res
      //console.log(xhr.responseText);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send();
}


function getTaskCount(){
  var url = 'u_TaskCount';
  var method = 'GET';
  // var params = 'state=' + document.getElementById('stateid').value;
  showTaskCount(url,method);
  //console.log(url);
}

function showTaskCount(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      //document.getElementById('taskNot').innerHTML = res
      //console.log(xhr.responseText);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send();
}
