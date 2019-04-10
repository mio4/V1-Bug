function sign_in(){
	url = "";
	var data = $("#form-sign-in").serializeArray();
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState===4){
      	if(xmlhttp.getResponseHeader('content-type')==='application/json'){
	      var result = JSON.parse(xmlhttp.responseText);	
	  	  if(result.status===400){
            alert('登录失败');
	      }
	      else{
	      	alert("登录成功");
	      }
        }
        else{
        	console.log(xmlhttp.responseText);
        }
      }
    }
	xmlhttp.send(JSON.stringify(data));
}