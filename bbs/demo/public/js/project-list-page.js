// 项目简要信息列表
var projectInfoList = {};

/**
 * 获取并加载个人创建项目列表信息
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
    // 格式 {{name:项目名，reward:悬赏，create_time:发布时间，picture:图片URL},.......}
    
}


/**
 * 加载页面要显示的所有项目，并分页
 */
window.onload(function(){

    load_project_list();

});
