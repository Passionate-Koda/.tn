

function addContact(cowner,cid,cname,cphone,chash,type){

  var url = 'addContact';
  var method = 'POST';
  var params = 'contactOwner='+ cowner;
  params += '&contactId='+cid;
  params += '&contactName='+cname;
  params += '&contactPhone='+cphone;
  params += '&contactHash='+chash;
  params += '&contactType='+type;
  //console.log(params);

  contactAjax(url, method, params);
}

function contactAjax(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      window.location = 'tworkersMessage';
      //console.log(res);
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}

function sendNotif(msg, clnt, sess, tid, type){
  var url = 't_sendNot';
  var method = 'POST';
  var params = 'msg='+ msg;
      params += '&client='+clnt;
      params += '&sess='+sess;
      params += '&type_id='+tid;
      params += '&type='+type;
      ////console.log(url);
      NotAjax(url, method, params);
}

function NotAjax(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      if (res){
        window.location='myDashboard';
      }

    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}




function updateNotif(id){
  var url = 'upNot';
  var method = 'POST';
  var params = 'notId='+ id;

  ////console.log(url);
  upNotAjax(url, method, params);
}

function upNotAjax(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      //////console.loges);

    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}

function updateTask(tid, ccode){


  var url = 'updateTask';
  var method = 'POST';
  var params = 'thid='+tid;
      params += '&consentCode='+ccode;

  ////console.log(url);
  ////console.log(params)
  updAjax(url, method, params);
}

function updAjax(url, method, params){
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


// function getNoficationCount(str){
//   var url = 't_notificationCount?get='+ str;
//   var method = 'GET';
//   // var params = 'state=' + document.getElementById('stateid').value;
//   showNoficationCount(url,method);
//   ////console.log(url);
// }
//
// function showNoficationCount(url, method){
//   var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function(){
//     if(xhr.readyState == 4){
//       var res = xhr.responseText;
//       console.log(xhr.responseText);
//     document.getElementById('notCnt').innerHTML = xhr.responseText;
//     }
//   }
//   xhr.open(method, url, true);
//   xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
//   var sd = xhr.send();
// }
