/*  $(function () {
            var tabLen = document.getElementById("tableID");
            var jsonT = "[";
            for (var i = 1; i < tabLen.rows.length; i++) {
                    jsonT += '{"ID":' + tabLen.rows[i].cells[0].innerHTML + ',"Name":"' + tabLen.rows[i].cells[1].innerHTML + '","Age":' + tabLen.rows[i].cells[2].innerHTML + ',"Gender":"' + tabLen.rows[i].cells[3].innerHTML + '"},'
            }
            jsonT= jsonT.substr(0, jsonT.length - 1);
            jsonT += "]";
            $.ajax({
                type: 'post',
                url: '/Home/GetJson',
                data:{students:jsonT},
                success: function (data) {
                    alert(1);
                }
            });      
        });
*/

var read_clicked;
window.onload=function(){
    read_clicked = false;
}
function read_con(){
	read_clicked = true;
}
function sign_up(){
	if(!sign_up_check()){
		return;
	}
	var data = toJSON();
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST","usr/sign_up",false);
	xmlhttp.send(data);
}
function sign_up_check(){
	var tmp = document.getElementById("usr").value;
	//alert(tmp);
	var p = /^[0-9a-zA-Z]+$/; 
	if(!p.test(tmp)){
		alert("用户名只能包含数字和字母")
		return false;
	}
	if(tmp.length > 16 || tmp.length < 8){
		alert("用户名长度必须在8至16位之间");
		return false;
	}
	
	tmp = document.getElementById("pwd").value;
	if(!p.test(tmp)){
		alert("密码只能包含数字和字母")
		return false;
	}
	if(tmp.length > 16 || tmp.length < 8){
		alert("密码长度必须在8至16位之间");
		return false;
	}
	var tmp2 = document.getElementById("pwd-con").value;
	if(tmp!=tmp2){
		alert("两次输入密码不一致");
		return false;
	}
	if(read_clicked == false){
		alert("请确认服务协议");
		return false;
	}
	return true;
}
function toJSON(){
	x=$("form").serializeArray();
	//console.log(JSON.stringify(x));
	return x;
}
