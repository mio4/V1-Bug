// function sign_in(){
// 	var data = $("form").serializeArray();
// 	var xmlhttp = new XMLHttpRequest();
// 	xmlhttp.open("POST","../../www/controller/LoginController.php",true);
// 	xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
//     xmlhttp.onreadystatechange=function(){
//       if (xmlhttp.readyState===4){
//       	if(xmlhttp.getResponseHeader('content-type')==='application/json'){
//       		var result = JSON.parse(xmlhttp.responseText);
// 	  	  if(result.status===400){
//             alert('登录失败');
//             // TODO:登陆失败的操作。
// 	      }
// 	      else{
// 	      	alert("登录成功");
// 	      	// TODO：登陆成功后的操作。
// 	      }
//         }
//         else{
//         	console.log(xmlhttp.responseText);
//         }
//       }
//     };
// 	xmlhttp.send('loginInfo=' + JSON.stringify(data));
// }
$("#btn_sign_in").click(function(){
	var username_sign_in = $("#username_sign_in").val();
	var password_sign_in = $("#password_sign_in").val();
	$.ajax(
		{
			type:"POST",
			url:"../usr/sign-in",
			data:
				{
					user_name : username_sign_in,
					password : password_sign_in
				},
			dataType:"json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			error : function() {
				alert('smx失败 ');
			},
			success:function(data)
			{
				console.log(data);
				if(data.status===400){
					alert('登录失败');
					// TODO:登陆失败的操作。
				}
				else{
					alert("登录成功");
					window.location.replace="../" + data.redirect;
				}
			}
		});
});

$("#btn-sign-up").click(function(){

})
