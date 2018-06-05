
var ready_id, str, sess, val;
var slid = document.getElementById("display_adjustment");
// var rang = document.getElementById("myRange");

// rang.addEventListener('input',function(e){
//     slid.innerHTML= rang.value+"km";
// },false);
function getV(val){
  slid.innerHTML = val+"km";
}


function getElem(str){
  ////console.log(str)
}


function getWorkers(str){
  var url = 'fetchRequest?get=nil';
  var method = 'POST';
  var params = 'session='+ document.getElementById('session').value;
  params += '&skill_id='+ document.getElementById('skill_id').value;
  // var params = 'state=' + document.getElementById('stateid').value;
  showWorker(url,method,params);
  ////console.log(url);
}
function showWorker(url, method,params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
    document.getElementById('products').innerHTML = xhr.responseText;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  var sd = xhr.send(params);

}

function getSWorkers(str){


if(str == "distance"){
  var dis = "'distance'";
  document.getElementById("filter").value = 30;
  document.getElementById("display_adjustment").innerHTML = document.getElementById("filter").value +"km";
  document.getElementById("filter").innerHTML='<input oninput="getV(this.value)" onchange="getAWorkers(this.value,'+dis+')" type="range" min="1" max="100" value="1" class="slider" id="myRange">';
}else{
var dis = "'rating'";
document.getElementById("filter").value = 30;
document.getElementById("display_adjustment").innerHTML= document.getElementById("filter").value+ "km";
document.getElementById("filter").innerHTML='<input oninput="getV(this.value)"" onchange="getAWorkers(this.value,'+dis+')" type="range" min="1" max="100" value="1" class="slider" id="myRange">';
}

  var url = 'fetchRequest?get=nil';
  var method = 'POST';
  var params = 'session='+ document.getElementById('session').value;
  params += '&skill_id='+ document.getElementById('skill_id').value;
  params += '&'+str+'=true';

  // var params = 'state=' + document.getElementById('stateid').value;
  showWorker(url,method,params);
  console.log(str);
}

function getAWorkers(str,filter){
  var url = 'fetchRequest?get=nil';
  var method = 'POST';
  var params = 'session='+ document.getElementById('session').value;
  params += '&skill_id='+ document.getElementById('skill_id').value;
  params += '&range='+str;
  params += '&'+filter+'=true';
  // var params = 'state=' + document.getElementById('stateid').value;
  showWorker(url,method,params);
  // console.log(str);
  // console.log(filter);
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



function sendTask(ready_id,sess,val,uname,catid,tid){

  var owner = ready_id;
  var url = 'sendTask';
  var method = 'POST';
  var params = 'client_id=' + sess;
  params += '&task=' + val;
  params += '&taskCategory=' + catid;
  params += '&uname=' + uname;
  params += '&tworkers_id=' + ready_id;

if(val.length < 20){
  alert("Please give more detail of your task");
}else{
   sendTaskAjax(url, method, params);
}

}

function sendTaskAjax(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      //console.log(res);
      window.location = "dashboard";
      alert("Your Task is Pending Until the User Give Consent to Your Task. Kindly Wait for the Notification At Your Dashboard Or Go back to home");

    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}
