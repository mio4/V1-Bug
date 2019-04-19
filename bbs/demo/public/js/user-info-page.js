// 用户基本信息
var userId = "";
var userName = "1";
var userEmail = "2";
var userKind = "3";
var userRegTime = "4";
var userReward = "0"; // TODO 增加该项
var userKindList = ["", "普通用户", "实验室官方"];

//模拟数据
a1 = JSON.parse('{"uid":"1", "name":"用户名1", "picture":"头像的URL"}');
a2 = JSON.parse('{"uid":"2", "name":"用户名2", "picture":"头像的URL"}');
a3 = JSON.parse('{"uid":"3", "name":"用户名3", "picture":"头像的URL"}');
a4 = JSON.parse('{"uid":"4", "name":"用户名4", "picture":"头像的URL"}');

b1 = JSON.parse('{"pid":"1", "name":"收藏项目名1", "create_time":"创建时间"}');
b2 = JSON.parse('{"pid":"2", "name":"收藏项目名2", "create_time":"创建时间"}');
b3 = JSON.parse('{"pid":"3", "name":"收藏项目名3", "create_time":"创建时间"}');
b4 = JSON.parse('{"pid":"4", "name":"收藏项目名4", "create_time":"创建时间"}');

c1 = JSON.parse('{"pid":"5", "name":"发布项目名1", "create_time":"创建时间"}');
c2 = JSON.parse('{"pid":"6", "name":"发布项目名2", "create_time":"创建时间"}');
c3 = JSON.parse('{"pid":"7", "name":"发布项目名3", "create_time":"创建时间"}');
c4 = JSON.parse('{"pid":"8", "name":"发布项目名4", "create_time":"创建时间"}');

d1 = JSON.parse('{"pid":"9", "name":"参与项目名1", "create_time":"创建时间"}');
d2 = JSON.parse('{"pid":"10", "name":"参与项目名2", "create_time":"创建时间"}');
d3 = JSON.parse('{"pid":"11", "name":"参与项目名3", "create_time":"创建时间"}');
d4 = JSON.parse('{"pid":"12", "name":"参与项目名4", "create_time":"创建时间"}');
d5 = JSON.parse('{"pid":"13", "name":"参与项目名5", "create_time":"创建时间"}');
d6 = JSON.parse('{"pid":"14", "name":"参与项目名6", "create_time":"创建时间"}');
d7 = JSON.parse('{"pid":"15", "name":"参与项目名7", "create_time":"创建时间"}');
d8 = JSON.parse('{"pid":"16", "name":"参与项目名8", "create_time":"创建时间"}');

// 用户详细信息
let userStarUserInfo = [a1, a2, a3, a4];
let userStarProjectInfo = [b1, b2, b3, b4];
let userOwnProjectInfo = [c1, c2, c3 ,c4];
let userParticipateProjectInfo = [d1, d2, d3, d4, d5, d6, d7, d8];
var num_per_page=3; // 每页显示数量
var current_page=1; // 当前页码
var current_tab="SPI"; // 当前tab页面
let SUI_total;
let SUI_left;
let SUI_pages;
let SPI_total;
let SPI_left;
let SPI_pages;
let OPI_total;
let OPI_left;
let OPI_pages;
let PPI_total;
let PPI_left;
let PPI_pages;
let data;
/**
*表示方法介绍
*userStarUserInfo => SUI;
*userStarProjectInfo => SPI;
*userOwnProjectInfo => OPI;
*userParticipateProjectInfo => PPI;
*/

// 验证修改信息合法性
var nickname_legal = false;
var password_legal = false;
var password_con_legal = false;

/**
 * 更新用户基础信息
 */
function refresh_user_info(){
	$("#user-name").text(userName);
	$("#user-email").text(userEmail);
	$("#user-kind").text(userKind);
	$("#user-regTime").text(userRegTime);
}


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
        		if(data === 200){
        			refresh_user_info();
				}
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
 * 获取并加载个人关注用户列表信息
 */
function load_user_star_list(){
	$.ajax({
		type : "POST",
		url:"../user/star/get",
		data:
			{
				uid : userId,
			},
		dataType:"json",
		success:function(data){
			if(data === 200){
				userStarUserInfo = data.info;
				// TODO 加载个人关注用户列表
				// 信息存在userStarUserInfo里
				// 格式 {{uid:id，name:用户名，picture:头像的URL},.......}
			}
			else{
				// TODO 加载信息失败
			}
		},
		error:function(){
			alert("网络繁忙请刷新。");
		}
	});
}

/**
 * 获取并加载个人收藏项目列表信息
 */
function load_project_star_list(){
	$.ajax({
		type : "POST",
		url:"../project/star/get",
		data:
			{
				uid : userId,
			},
		dataType:"json",
		success:function(data){
			if(data === 200){
				userStarProjectInfo = data.info;
				// TODO 加载个人收藏项目列表
				// 信息存在userStarProjectInfo里
				// 格式 {{pid:id，name:项目名，create_time:创建时间},.......}
			}
			else{
				// TODO 加载信息失败
			}
		},
		error:function(){
			alert("网络繁忙请刷新。");
		}
	});
}

/**
 * 获取并加载个人创建项目列表信息
 */
function load_project_own_list(){
	//
	$.ajax({
		type : "POST",
		url:"../project/info/basic/own",
		data:
			{
				uid : userId,
			},
		dataType:"json",
		success:function(data){
			if(data === 200){
				userOwnProjectInfo = data.info;
				// TODO 加载个人创建项目列表
				// 信息存在userOwnProjectInfo里
				// 格式 {{pid:pid，name:项目名，create_time:创建时间},.......}
			}
			else{
				// TODO 加载信息失败
			}
		},
		error:function(){
			alert("网络繁忙请刷新。");
		}
	});

}

/**
 * 获取并加载个人参加项目列表信息
 */
function load_project_participate_list(){
	//
	$.ajax({
		type : "POST",
		url:"../project/info/basic/participate",
		data:
			{
				uid : userId,
			},
		dataType:"json",
		success:function(data){
			if(data === 200){
				userParticipateProjectInfo = data.info;
				// TODO 加载个人参加项目列表
				// 信息存在userParticipateProjectInfo里
				// 格式 {{pid:id，name:项目名，create_time:创建时间},.......}
			}
			else{
				// TODO 加载信息失败
			}
		},
		error:function(){
			alert("网络繁忙请刷新。");
		}
	});
}

/**
 * 加载个人信息页面数据
 */
window.onload = function(){

	// 从url获取页面用户ID
	userId = get_url_param('uid');
	console.log("IN");
	if(userId === null){
		console.log("1");
		$.ajax({
			type : "GET",
			url:"../user/info",
			dataType:"json",
			success:function(data){
				if(data === 200){
					userName = data.name;
					userId = data.uid;
					userEmail = data.email;
					userKind = userKindList[data.kind];
					userRegTime = data.regTime;
					refresh_user_info();
				}
				else{
					// TODO 加载信息失败
				}
			},
			error:function(){
				alert("网络繁忙请刷新。");
			}
		});
	}
	else{
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
		$("#btn-change-name").hide();
		$("#btn-change-password").hide();
	}

	// 更新个人信息



	load_user_star_list();

	load_project_star_list();

	load_project_own_list();

	load_project_participate_list();

	refresh_detail_info();

};

/**
 * 显示加载个人关注用户列表，并分页
 */
function refresh_detail_info(){
	current_page = 1;
	current_tab = "SPI";
	data = [userStarUserInfo, userStarProjectInfo, userOwnProjectInfo, userParticipateProjectInfo];
	
	//加载每个tab表的基本信息
	SUI_total = userStarUserInfo.length;
	SUI_left = SUI_total % num_per_page;
	SUI_pages = (SUI_total - SUI_left) / num_per_page;
	if(SUI_left > 0){
		SUI_pages += 1;
	}
	SPI_total = userStarProjectInfo.length;
	SPI_left = SPI_total % num_per_page;
	SPI_pages = (SPI_total - SPI_left) / num_per_page;
	if(SPI_left > 0){
		SPI_pages += 1;
	}
	OPI_total = userOwnProjectInfo.length;
	OPI_left = OPI_total % num_per_page;
	OPI_pages = (OPI_total - OPI_left) / num_per_page;
	if(OPI_left > 0){
		OPI_pages += 1;
	}
	PPI_total = userParticipateProjectInfo.length;
	PPI_left = PPI_total % num_per_page;
	PPI_pages = (PPI_total - PPI_left) / num_per_page;
	if(PPI_left > 0){
		PPI_pages += 1;
	}
	
	//用收藏项目列表初始化页面显示内容
	click_tab(current_tab);
	/*
	document.getElementById("SUI-page-index").innerHTML="";
	document.getElementById("SUI-page-index").innerHTML += '<li><a class="fake-link" aria-label="Previous" onclick="click_previous()">&laquo;</a></li>';
	var string="";
	for(var i=1;i <= SUI_pages;i++){
		string = string + '<li><a class="fake-link" id="SUI-page-';
		string = string + i.toString();
		string = string + '" onclick="click_page_index(';
		string = string + i.toString();
		string = string + ', "SUI")">';
		string = string + i.toString();
		string = string + '</a></li>';
	}
	document.getElementById("SUI-page-index").innerHTML += string;
	document.getElementById("SUI-page-index").innerHTML += '<li><a class="fake-link" aria-label="Next" onclick="click_next()>&raquo;</a></li>';
	*/
}

/**
 * 点击tab标签
 */
 function click_tab(tab_kind){
	 current_tab = tab_kind;
	 var pages = 1;
	 var eleid = tab_kind + "-page-index";
	 var first_page = tab_kind + "-page-1";
	 var elestring1 = '<li><a class="fake-link" id="' + tab_kind + '-page-';
	 if(tab_kind === "SUI"){
		 pages = SUI_pages;
	 }
	 else if(tab_kind === "SPI"){
		 pages = SPI_pages;
	 }
	 else if(tab_kind === "OPI"){
		 pages = OPI_pages;
	 }
	 else if(tab_kind === "PPI"){
		 pages = PPI_pages;
	 }
	 var page_index = document.getElementById(eleid);
	 page_index.innerHTML = "";
	 page_index.innerHTML += '<li><a class="fake-link" aria-label="Previous" onclick="click_previous()">&laquo;</a></li>';
	 var string = "";
	 for(var i=1;i <= pages;i++){
		string = string + elestring1;
		string = string + i.toString();
		string = string + '" onclick="click_page_index(';
		string = string + i.toString();
		string = string + ')">';
		string = string + i.toString();
		string = string + '</a></li>'; 
	 }
	 page_index.innerHTML += string;
	 page_index.innerHTML += '<li><a class="fake-link" aria-label="Next" onclick="click_next()">&raquo;</a></li>';
	 click_page_index(1);
 }
 
 /**
 * 点击页码触发函数
 */
 function click_page_index(page_num) {
	 current_page = page_num;
	 var pages;
	 var page_start;
	 var page_end;
	 var total;
	 var eleid = current_tab + "-page-show";
	 var tab_num;
	 if (current_tab === "SUI") {
		 pages = SUI_pages;
		 total = SUI_total;
		 tab_num = 1;
	 } else if (current_tab === "SPI") {
		 pages = SPI_pages;
		 total = SPI_total;
		 tab_num = 2;
	 } else if (current_tab === "OPI") {
		 pages = OPI_pages;
		 total = OPI_total;
		 tab_num = 3;
	 } else if (current_tab === "PPI") {
		 pages = PPI_pages;
		 total = PPI_total;
		 tab_num = 4;
	 }

	 //更改页码显示状态
	 for (var i=1; i <= pages; i++) {
		 var elename = current_tab + "-page-" + i.toString();
		 if (i !== page_num) {
			 document.getElementById(elename).setAttribute("class", "fake-link");
		 } else {
			 document.getElementById(elename).setAttribute("class", "fake-link current");
		 }
	 }

	 //添加内容
	 page_start = (page_num - 1) * num_per_page + 1;
	 if (page_num < pages) {
		 page_end = page_num * num_per_page;
	 } else {
		 page_end = total;
	 }
	 var page_show = document.getElementById(eleid);
	 page_show.innerHTML = "";
	 var string = "";
	 for (var i = page_start; i <= page_end; i++) {
		 string = string +
			 '<div class="media border p-3 mb-5 h-100"> \
                    <img src="../img/bulb.jpg" alt="创意图片" class="mr-3 mt-3 rounded-circle big-icon"> \
                    <div class="media-body"> \
                      <h3>';
		 string = string + data[tab_num - 1][i - 1].name;
		 string = string + '</h3> <p>';
		 string = string + data[tab_num - 1][i - 1].create_time;
		 string = string + '</p> </div> </div>';
	 }
	 page_show.innerHTML += string;
 }

/**
 * 点击上一页触发函数
 */
function click_previous(){
	if(current_page === 1){
		return ;
	}
	click_page_index(current_page - 1);
}

/**
 * 点击下一页触发函数
 */
function click_next(){
	var pages;
	if (current_tab === "SUI") {
		pages = SUI_pages;
	} else if (current_tab === "SPI") {
		pages = SPI_pages;
	} else if (current_tab === "OPI") {
		pages = OPI_pages;
	} else if (current_tab === "PPI") {
		pages = PPI_pages;
	}
	if(current_page === pages){
		return ;
	}
	click_page_index(current_page + 1);
}
	 
	 
		 
		 
 
/**
*表示方法介绍
*userStarUserInfo => SUI;
*userStarProjectInfo => SPI;
*userOwnProjectInfo => OPI;
*userParticipateProjectInfo => PPI;
*/

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
/*a = JSON.parse(a);
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
}*/