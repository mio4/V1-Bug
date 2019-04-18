// 项目简要信息列表（当前为测试用模拟数据）
a1 = JSON.parse('{"pid":"id","name":"项目名1","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a2 = JSON.parse('{"pid":"id","name":"项目名2","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a3 = JSON.parse('{"pid":"id","name":"项目名3","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a4 = JSON.parse('{"pid":"id","name":"项目名4","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a5 = JSON.parse('{"pid":"id","name":"项目名5","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a6 = JSON.parse('{"pid":"id","name":"项目名6","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a7 = JSON.parse('{"pid":"id","name":"项目名7","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a8 = JSON.parse('{"pid":"id","name":"项目名8","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a9 = JSON.parse('{"pid":"id","name":"项目名9","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a10 = JSON.parse('{"pid":"id","name":"项目名10","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a11 = JSON.parse('{"pid":"id","name":"项目名11","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a12 = JSON.parse('{"pid":"id","name":"项目名12","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');
a13 = JSON.parse('{"pid":"id","name":"项目名13","reward":"悬赏","create_time":"发布时间","picture":"图片URL"}');

var projectInfoList = [a1, a2, a3, a4, a5, a6, a7, a8, a9, a10, a11, a12, a13];

/**
 * 全局变量
 */
num_per_page=12;
current_page=1;


/**
 * 获取并加载项目列表信息
 */
function load_project_list(){
    //
    $.ajax({
        type : "GET",
        url:"../project/info/basic",
        dataType:"json",
        success:function(data){
            if(data === 200){
                projectInfoList = data.info;
            }
            else{
                // TODO 加载信息失败
            }
        },
        error:function(){
            alert("网络繁忙请刷新。");
        }
    });
    // TODO 加载项目列表
    // 信息存在projectInfoList里
    // 格式 {{pid:id，name:项目名，reward:悬赏，create_time:发布时间，picture:图片URL},.......}
    
}


/**
 * 加载页面要显示的所有项目，并分页
 */
console.log("长度");
console.log(projectInfoList.length);
window.onload = function (){
    //load_project_list(); //使用模拟数据，没有真正从后端获取
    current_page = 1;
    total = projectInfoList.length;
    left = total % num_per_page;
    pages = (total - left) / num_per_page;
    if(left > 0){
        pages += 1;
    }
    document.getElementById("page-index").innerHTML="";
    document.getElementById("page-index").innerHTML += '<li><a class="fake-link" aria-label="Previous" onclick="click_previous()">&laquo;</a></li>';
    var string = "";
    for(var i=1;i <= pages;i++){
        string = string + '<li><a class="fake-link" id="page-';
        string = string + i.toString();
        string = string + '" onclick="click_page_index(';
        string = string + i.toString();
        string = string + ')">';
        string = string + i.toString();
        string = string + '</a></li>';
    }
    document.getElementById("page-index").innerHTML += string;
    document.getElementById("page-index").innerHTML += '<li><a class="fake-link" aria-label="Next" onclick="click_next()">&raquo;</a></li>';
    document.getElementById("page-1").setAttribute("class","fake-link current");

    //添加内容
    page_start = 1;
    if(1 < pages){
        page_end = num_per_page;
    }
    else{
        page_end = total;
    }
    document.getElementById("page-show").innerHTML = "";
    string = "";
    for(var i=page_start;i<=page_end;i++){
        string = string +
            '<div class="col-lg-3 col-sm-6"> \
                <div class="single-product-item"> \
                    <figure class="product-thumb"> \
                        <a> \
                            <img src="../img/product-1.jpg" alt="Product"> \
                        </a> \
                        <a class="btn btn-round btn-cart" title="Quick View"> \
                            <i class="fa fa-eye"></i> \
                        </a> \
                    </figure> \
                    <div class="product-details"> \
                        <h2 class="product-title"> \
                            <a>';
        string = string + projectInfoList[i-1].name;
        string = string +
                            '</a> \
                        </h2> \
                        <p class="pro-desc">创意介绍</p> \
                    </div> \
                </div> \
            </div>';
    }
    document.getElementById("page-show").innerHTML += string;
    return ;
}

/**
 * 点击页码触发函数
 */
function click_page_index(page_num){
    current_page = page_num;
    //更改页码显示状态
    for(var i=1;i <= pages;i++){
        var elename = "page-" + i.toString();
        if(i != page_num){
            document.getElementById(elename).setAttribute("class","fake-link");
        }
        else{
            document.getElementById(elename).setAttribute("class","fake-link current");
        }
    }

    //添加内容
    page_start = (page_num-1) * num_per_page + 1;
    if(page_num < pages){
        page_end = page_num * num_per_page;
    }
    else{
        page_end = total;
    }
    document.getElementById("page-show").innerHTML = "";
    string = "";
    for(var i=page_start;i<=page_end;i++){
        string = string +
            '<div class="col-lg-3 col-sm-6"> \
                <div class="single-product-item"> \
                    <figure class="product-thumb"> \
                        <a> \
                            <img src="../img/product-1.jpg" alt="Product"> \
                        </a> \
                        <a class="btn btn-round btn-cart" title="Quick View"> \
                            <i class="fa fa-eye"></i> \
                        </a> \
                    </figure> \
                    <div class="product-details"> \
                        <h2 class="product-title"> \
                            <a>';
        string = string + projectInfoList[i-1].name;
        string = string +
                            '</a> \
                        </h2> \
                        <p class="pro-desc">创意介绍</p> \
                    </div> \
                </div> \
            </div>';
    }
    document.getElementById("page-show").innerHTML += string;
    return ;
}

/**
 * 点击上一页触发函数
 */
function click_previous(){
    if(current_page == 1){
        return ;
    }
    click_page_index(current_page - 1);
    return ;
}

/**
 * 点击下一页触发函数
 */
function click_next(){
    if(current_page == pages){
        return ;
    }
    click_page_index(current_page + 1);
    return ;
}