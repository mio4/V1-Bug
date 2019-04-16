
var read_clicked;			// 是否阅读用户协议
window.onload=function(){
	read_clicked = false;
};
function read_con(){
	read_clicked = !read_clicked;
}

/**
 * 检查注册合法性
 * @returns {boolean}
 */
function sign_up_check(){
	var tmp = document.getElementById("username_sign_up").value;
	//alert(tmp);
	var p = /^[0-9a-zA-Z]+$/;
	if(!p.test(tmp)){
		alert("用户名只能包含数字和字母");
		return false;
	}
	if(tmp.length > 16 || tmp.length < 8){
		alert("用户名长度必须在8至16位之间");
		return false;
	}

	tmp = document.getElementById("password_sign_up").value;
	if(!p.test(tmp)){
		alert("密码只能包含数字和字母");
		return false;
	}
	if(tmp.length > 16 || tmp.length < 8){
		alert("密码长度必须在8至16位之间");
		return false;
	}
	var tmp2 = document.getElementById("password_con_sign_up").value;
	if(tmp!==tmp2){
		alert("两次输入密码不一致");
		return false;
	}
	if(read_clicked === false){
		alert("请确认服务协议");
		return false;
	}
	return true;
}

/**
 * 登陆Ajax请求
 */
$("#btn_sign_in").click(function(){
	var username = $("#username_sign_in").val();
	var password = $("#password_sign_in").val();
	$.ajax(
		{
			type:"POST",
			url:"../usr/sign-in",
			data:
				{
					user_name : username,
					password : password,
				},
			dataType:"json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			error : function() {
				alert('网络繁忙');
			},
			success:function(data)
			{
				if(data.status===400){
					alert('登录失败');
					// TODO:登陆失败的操作。
				}
				else{
					alert("登录成功");
					window.location.replace("../" + data.redirect);
				}
			}
		});
});

/**
 * 注册Ajax请求
 */
$("#btn_sign_up").click(function(){
	if(!sign_up_check())
	{
		return;
	}
	var username = $("#username_sign_up").val();
	var password = $("#password_sign_up").val();
	var email = $("#email_sign_up").val();
	var password_confirmation = $("#password_con_sign_up").val();
	var isOfficial = $("#I_am_official").val() ? 'O' : 'G';
	$.ajax(
		{
			type:"POST",
			url:"../usr/sign-up",
			data:
				{
					user_name : username,
					password : password,
					password_confirmation : password_confirmation,
					user_email : email,
					user_kind : isOfficial,
				},
			dataType:"json",
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			},
			error : function() {
				alert('网络繁忙');
			},
			success:function(data)
			{
				if(data.status===400){
					alert('注册失败' + data.message);
					// TODO:登陆失败的操作。
				}
				else{
					alert("注册成功");
					window.location.replace("../" + data.redirect);
				}
			}
		});
});