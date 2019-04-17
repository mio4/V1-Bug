// 用户基本信息
var userId = "";
var userName = "1";
var userEmail = "2";
var userKind = "3";
var userRegTime = "4";
var userReward = "0"; // TODO 增加该项
var userKindList = ["", "普通用户", "实验室官方"];

// 验证修改信息合法性
var nickname_legal = false;
var password_legal = false;
var password_con_legal = false;

/**
 * 动态监视昵称修改正确性。
 */
$("#new-name").blur(function(){
	var nick = $(this).val();
	nickname_legal = false;
	if(nick.length === 0){
		$("#new-name-alert").text("*请输入新昵称");
	}
	else if(nick.length < 8){
		$("#new-name-alert").text("*昵称长度不能超过16位");
	}
	else if(nick.length > 16){
		$("#new-name-alert").text("*昵称长度不能超过16位");
 	}
	else{
		nickname_legal = true;
	}
});

/**
 * 发送修改昵称请求
 */
$("#change-name").click(function(){
	var newName = $("#new-name").val();
		
	if(nickname_legal){
        $.ajax({
        	type : "POST",
        	url:"../user/info/change/name",
        	data:
        	{
        		name:newName,
        	},
        	dataType:"json",
        	success:function(data){
        		if(data === 200){}
        		else{
        			//todo:显示修改失败
        		}
        	},
        	error:function(XML,test){
				alert("网络繁忙请重试。");
			},
        });
	}
});

/**
 * 动态监视邮箱修改合法性
 * 放弃
 */
// $("#mail-input").blur(function(){
// 	var mail = $(this).val();
// 	var test_mail = /^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/;
// 	if(mail.length === 0){
// 		alert("邮箱不能为空");
// 		mail_legal = false;
// 	}
//
// 	if(!test_mail.test(mail)){
//     	alert("非法的邮箱格式");
//     	mail_legal = false;
//  	}
//  	mail_legal = true;
// });
// $("#mail-ok").click(function(){
// 	var mail = $("#mail-input").val();
//
// 	if(mail_legal){
//         $.ajax({
//         	type : "POST",
//         	url:"/usr/info/mail",
//         	data:
//         	{
//         		mail:mail
//         	},
//         	contentType:"application/json",
//         	dataType:"json",
//         	success:function(data){
//         		if(data == 200){
//         			//todo:显示修改成功
//         		}
//         		else{
//         			//todo:显示修改失败
//         		}
//         	}
//         });
// 	}
// 	else{
// 		//todo:增加错误提示
// 	}
// });
///////////////////////////////////////////////////////////////

/**
 * 动态监视密码修改合法性
 */
$("#new-password").blur(function(){
	var password = $(this).val();
	password_legal = false;
	if(password.length === 0){
		$("#new-password-alert").html("<bold>*请输入密码</bold>");
	}
	else if(password.length > 16 || password.length < 8){
		$("#new-password-alert").html("<bold>*密码长度必须在8到16之间</bold>");
 	}
	else{
		password_legal = true;
	}
});

/**
 * 动态监视密码修改确认合法性
 */
$("#new-password-con").blur(function(){
	var password = $("#new-password").val();
	var password_con = $("#new-password-con").val();
	password_con_legal = false;
	if(password_con !== password){
		$("#new-password-con-alert").html("<bold>*密码不一致</bold>");
	}
	else{
		password_con_legal = true;
	}
});

/**
 * 发送修改密码请求
 */
$("#change-password").click(function(){
	var password = $("#new-password").val();

	if(password_legal && password_con_legal){
        $.ajax({
        	type : "POST",
        	url:"../user/info/change/name",
        	data:
        	{
        		password:password
        	},
        	dataType:"json",
        	success:function(data){
        		if(data === 200){

				}
        		else{
        			//todo:显示修改失败
        		}
        	},
			error:function(){
				alert("网络繁忙请重试。");
			}
        });
	}
});

/**
 * 加载个人信息页面数据
 */
window.onload = function(){

	// 从url获取页面用户ID
	userId = get_url_param('uid');

	// 个人信息
	$.ajax({
		type : "POST",
		url:"../user/info",
		data:
			{
				uid:userId,
			},
		dataType:"json",
		success:function(data){
			if(data === 200){
				userName = data.name;
				userEmail = data.email;
				userKind = userKindList[data.kind];
				userRegTime = data.regTime;
			}
			else{
				// TODO 加载信息失败
			}
		},
		error:function(){
			alert("网络繁忙请刷新。");
		}
	});

	// TODO 个人详细信息
};

var a = '{\
    "status": 1,\
    "total": 7,\
    "project": [{\
        "photo_url": "www.werwe.com",\
        "project_name": "江苏苏州1",\
        "project_intro": "中国"\
    },\
    {\
        "photo_url": "www.werwe.com",\
        "project_name": "江苏苏州2",\
        "project_intro": "中国"\
    },\
    {\
        "photo_url": "www.werwe.com",\
        "project_name": "江苏苏州3",\
        "project_intro": "中国"\
    },\
    {\
        "photo_url": "www.werwe.com",\
        "project_name": "江苏苏州4",\
        "project_intro": "中国"\
    },\
    {\
        "photo_url": "www.werwe.com",\
        "project_name": "江苏苏州5",\
        "project_intro": "中国"\
    },\
    {\
        "photo_url": "www.werwe.com",\
        "project_name": "江苏苏州6",\
        "project_intro": "中国"\
    },\
    {\
        "photo_url": "www.werwe.com",\
        "project_name": "江苏苏州7",\
        "project_intro": "中国"\
    }\
    ]\
}';


// TODO 获取收藏等信息，并进行显示
a = JSON.parse(a);
num_per_page=2;
//JSON.stringify(a);
var status = a.status;
console.log(status);
var total = a.total;
console.log(total);
var left = total%num_per_page;
console.log(left);
var pages = (total-left)/num_per_page;
console.log(pages);
var project = a.project;
//console.log(project);
if(left > 0){
	pages += 1;
}
document.getElementById("my-collection-pages").innerHTML = "";
document.getElementById("my-collection-pages").innerHTML += '<li><a href="#" aria-label="Previous">&laquo;</a></li>';
var string = "";
for(var i=1;i<=pages;i++){
	string = string + '<li><a class="current" href="#" id="collection-page-';
	string = string + i.toString();
	string = string + '" onclick="click_page_collection(';
	string = string + i.toString();
	string = string + ')">';
	string = string + i.toString();
	string = string + '</a></li>';
}
document.getElementById("my-collection-pages").innerHTML += string;
document.getElementById("my-collection-pages").innerHTML += '<li><a href="#" aria-label="Next">&raquo;</a></li>';

function click_page_collection(page_num){
	page_start = (page_num-1) * num_per_page + 1;
	if(page_num < pages){
		page_end = page_num * num_per_page;
	}
	else{
		page_end = total;
	}
	document.getElementById("my-collection-show").innerHTML = "";
	string = "";
	for(var i=page_start;i<=page_end;i++){
		string = string +  
		 '<div class="media border p-3 mb-5" style="height:100px"> \
                <img src="../img/bulb.jpg" alt="创意图片" class="mr-3 mt-3 rounded-circle big-icon"> \
                <div class="media-body"> \
                  <h3>';
        string = string + project[i-1].project_name;
        string = string + '</h3> <p>';
        string = string + project[i-1].project_intro;
        string = string + '</p> </div> </div>';
	}
	document.getElementById("my-collection-show").innerHTML += string;
}