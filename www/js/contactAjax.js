setInterval(function(){
  getMessageNofication();
  getMessageNoficationCount();
},7000 );

setInterval(function(){
getNoficationCount();
getNofication();
}, 5000);



function getMessageNoficationCount(){
  var url = 'getUsersMessageNotificationCount';
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
  var url = 'getUsersMessageNotification';
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



function redirect(page){
  window.location = page;
}

function getNofication(){
  var url = 'u_notification';
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
    document.getElementById('showNot').innerHTML = xhr.responseText;


    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send(params);
}

function getContact(){
  var url = 'getContact';
  var method = 'POST';
  var params = 'session='+ document.getElementById('session').value;
  // var params = 'state=' + document.getElementById('stateid').value;
  showContact(url,method,params);
  ////console.log(url);
}

function showContact(url, method, params){
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
    document.getElementById('page').innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send();
}

function getNoficationCount(){
  var url = 'u_notificationCount';
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
      var res = xhr.responseText;
      ////console.log(xhr.responseText);
    document.getElementById('notCnt').innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send(params);
}



function addContact(cowner,cid,cname,cphone,chash,type){

  var url = 'addContact';
  var method = 'POST';
  var params = 'contactOwner='+ cowner;
  params += '&contactId='+cid;
  params += '&contactName='+cname;
  params += '&contactPhone='+cphone;
  params += '&contactHash='+chash;
  params += '&contactType='+type;
  ////console.log(url);

  contactAjax(url, method, params);
}

function contactAjax(url, method, params){
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
      document.getElementById('showWkr').innerHTML = xhr.responseText;
    }a
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send();

}


window.addEventListener("load", function(e){
  function showPosition(position) {
    var lat =  position.coords.latitude;
    var long= position.coords.longitude;
    sessionStorage.setItem("UserCurrentLat", lat);
    sessionStorage.setItem("UserCurrentLong", long);
  }

  function showError(error) {
    switch(error.code) {
      case error.PERMISSION_DENIED:
     // alert("User denied the request for Geolocation.");
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
