div = document.getElementsByName('conti');
setInterval(function(){
  getMessageNofication();
  getMessageNoficationCount();
getNoficationCount();
getNofication();
getMessage();


div.scrollTop = '1500';
}, 1500);

function active(send, rec){

  var url = 'Uactive';
  var method = 'POST';
  var params = 'sender='+ send;
  params += '&receiver='+ rec;

  ////console.log(url);

  activeAjax(url, method, params);
}

function activeAjax(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      //console.log(res);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}

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
  showNofication(url,method, params);
  //console.log(url);
}

function showNofication(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
       var res = xhr.responseText;
       //console.log(res);
    document.getElementById('showNot').innerHTML = xhr.responseText;

    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send(params);
}

function getContact(){
  var url = 'getContactForMessage';
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


function getPage(str){
  var url = 'reply?id='+str;
  var method = 'GET';
  // var params = 'state=' + document.getElementById('stateid').value;
  showPage(url,method);
  //console.log(url);
}

function showPage(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
       var res = xhr.responseText;
       //console.log(res);
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
  //console.log(url);
}

function showNoficationCount(url, method,params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      //console.log(xhr.responseText);
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
  //console.log(url);

  contactAjax(url, method, params);
}

function contactAjax(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      //console.log(res);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}



var text = document.getElementById('text');
var textButton = document.getElementById('textButton');
var receiver = document.getElementById('r');
var receiver_alias = document.getElementById('rAl');
var sender_alias = document.getElementById('sAl');
var sender = document.getElementById('s');
textButton.addEventListener('click', function(e){
  if(text.value.length > 0){
    sendMessage();
  }else{
    alert("You cant send empty message");
  }

e.preventDefault();
}, false);

function sendMessage(){
  var url = 'sendMessage';
  var method = 'POST';

  var params = 'sender='+ sender.value;
  params += '&session='+ document.getElementById('session').value;
   params += '&sender_alias='+ sender_alias.value;
   params += '&receiver_alias='+ receiver_alias.value;
  params += '&receiver='+ receiver.value;
  params += '&text='+ text.value;
  //console.log(params);


  sendMessageNotification();
  msgAjax(url, method, params);
}
function msgAjax(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      if(res){
        document.getElementById('msgForm').reset();
      }
      //console.log(res);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}

function getMessage(){
  var url = 'getMessage';
  var method = 'POST';
  var params = 'sender='+ sender.value;
  params += '&session='+ document.getElementById('session').value;
  params += '&receiver='+ receiver.value;
  //console.log(url);
  //console.log(params);
  showMessage(url, method, params);
}
function showMessage(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      document.getElementById('mess').innerHTML = res;

    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}

function sendMessageNotification(){
  var url = 'sendMessageNotification';
  var method = 'POST';
  var params = 'sender='+ sender.value;
  params += '&receiver='+ receiver.value;
  params += '&sender_alias='+ sender_alias.value;
  params += '&receiver_alias='+ receiver_alias.value;
  //console.log(url);

  showMessageNotificationAjax(url, method, params);
}
function showMessageNotificationAjax(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      //console.log(res);
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
  //console.log(url);
}
function showWorker(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      document.getElementById('showWkr').innerHTML = xhr.responseText;
    }a////console.log
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send();

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
  //console.log(sd);
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
      alert("User denied the request for Geolocation.");
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
  //console.log(url);

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
