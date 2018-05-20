var messages = document.getElementById('mess');
setInterval(function(){
getMessage();
getMessageRow();
}, 3000);

// setInterval(function(){
//
//
// }, 3000);
setInterval(function(){
getMessageNofication();
getMessageNoficationCount();
}, 7000);

setTimeout(function(e){
messages.scrollTop = messages.scrollHeight;
},2000);
setInterval(function(){
  getNoficationCount();
  getNofication();
}, 5000);



function active(send, rec){

  var url = 'Tactive';
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




// function getContact(){
//   var url = 'getTContactForMessage';
//   var method = 'POST';
//   var params = 'session='+ document.getElementById('session').value;
//   // var params = 'state=' + document.getElementById('stateid').value;
//   showContact(url,method,params);
//   //console.log(url);
// }
//
// function showContact(url, method,params){
//   var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function(){
//     if(xhr.readyState == 4){
//        var res = xhr.responseText;
//        document.getElementById('contact').innerHTML = res;
//
//     }
//   }
//   xhr.open(method, url, true);
//   xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//   var sd = xhr.send(params);
// }
function getNofication(){
  var url = 't_notification';
  var method = 'POST';
  var params = 'session='+ document.getElementById('session').value;
  // var params = 'state=' + document.getElementById('stateid').value;
  showNofication(url,method,params);
  //////console.log(url);
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

var text = document.getElementById('text');
var textButton = document.getElementById('textButton');
var receiver = document.getElementById('r');
var receiver_alias = document.getElementById('rAl');
var sender_alias = document.getElementById('sAl');
var sender = document.getElementById('s');
textButton.addEventListener('click', function(e){
  if(text.value.length > 0){
    sendMessage();
    document.getElementById('msgForm').reset();
  }else{
    alert("You can't send empty message");
  }

e.preventDefault();
}, false);

function sendMessage(){
  var url = 'sendMessage';
  var method = 'POST';
  var params = 'sender='+ sender.value;
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



    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}

function getMessage(){


  var url = 'getTMessage';
  var method = 'POST';
  var params = 'sender='+ sender.value;
  params += '&receiver='+ receiver.value;
  params += '&session='+ document.getElementById('session').value;
  //console.log(url);



  showMessage(url, method, params);
}
function showMessage(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      document.getElementById('mess').innerHTML = res;
      // if("oldCount" in sessionStorage){
      //   if(sessionStorage.getItem("oldCount") < sessionStorage.getItem("messageCount")){
      //     messages.scrollTop = messages.scrollHeight;
      //     sessionStorage.setItem("oldCount",sessionStorage.getItem("messageCount"));
      //   }
      // }
      // sessionStorage.setItem("oldCount",0);
      if(sessionStorage.getItem("TmessageCount") > sessionStorage.getItem("ToldCount")  ){
        messages.scrollTop = messages.scrollHeight;
        sessionStorage.setItem("ToldCount",sessionStorage.getItem("TmessageCount"));
      }

    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}
function getMessageRow(){


  var url = 'getTMessageRow';
  var method = 'POST';
  var params = 'sender='+ sender.value;
  params += '&receiver='+ receiver.value;
  params += '&session='+ document.getElementById('session').value;
  //console.log(url);



  showMessageRow(url, method, params);
}
function showMessageRow(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
sessionStorage.setItem("TmessageCount",res);

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
