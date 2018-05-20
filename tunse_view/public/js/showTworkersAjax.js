
var ready_id, str, sess, val;



function getElem(str){
  ////console.log(str)
}


function getWorkers(str){
  var url = 'fetchRequest?get='+ str;
  var method = 'GET';
  // var params = 'state=' + document.getElementById('stateid').value;
  showWorker(url,method);
  ////console.log(url);
}
function showWorker(url, method){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
    document.getElementById('products').innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send();

}

function getWorkersModal(str){
  var url = 'fetchModal';
  var method = 'POST';
  var params = 'session='+ document.getElementById('session').value;
  params += '&skill_id='+ document.getElementById('skill_id').value;
  // var params = 'state=' + document.getElementById('stateid').value;
  showModal(url,method,params);
  console.log(params);
  //console.log(url);
}
function showModal(url, method,params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      document.getElementById('ModalHandle').innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send(params);
}



function sendTask(ready_id,sess,val,uname,catid){

  var owner = ready_id;
  var url = 'sendTask';
  var method = 'POST';
  var params = 'client_id=' + sess;
  params += '&task=' + val;
  params += '&taskCategory=' + catid;
  params += '&uname=' + uname;
  params += '&tworkers_id=' + ready_id;
  ////console.log(url);
  // //////console.log(user_id);
  // //console.log(val);
  //console.log(owner);
  //console.log(params);

   sendTaskAjax(url, method, params);

}

function sendTaskAjax(url, method, params){
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
