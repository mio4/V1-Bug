var projectName = "";
var projectId = "";
var projectKind = "";
var projectOwnerName = "";
var projectOwnerId = "";
var projectReward = 0;
var projectMaxParticipant = 0;
var projectCreateTime = "";
var projectInfo = "";
var projectPicUrl = "";

function refreshInfo(){
    // 更新项目信息
    $("#project-name").text(projectName);
    $("#project-owner").text(projectOwnerName);
    $("#project-info").html("&emsp;&emsp;" + projectInfo);
    $("#project-reward").text(projectReward);
    $("#project-participant-max").text(projectMaxParticipant);
    $("#project-create-time").text(projectCreateTime);
    switch (projectKind) {
        case 0:{
            $("#project-kind").text("生活创意");
            break;
        }
        case 1:{
            $("#project-kind").text("科技创意");
            break;
        }
        case 2:{
            $("#project-kind").text("实验室项目");
            break;
        }
        default:{
            $("#project-kind").text("普通项目");
        }
    }
}

/**
 * 页面载入，获取项目详细信息
 */
window.onload = function(){

    // 获取项目ID
    projectId = get_url_param("pid");

    // 获取项目信息
    $.ajax(
        {
            type:"POST",
            url:"../project/info",
            data:
                {
                    pid : projectId,
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
                    // TODO:项目信息获取失败的操作。
                }
                else if(data.status === 200){
                    projectName = data.name;
                    console.log(projectName);
                    projectKind = data.kind;
                    projectOwnerName = data.user_name;
                    projectOwnerId = data.uid;
                    projectReward = data.reward;
                    projectMaxParticipant = data.participant_max;
                    projectCreateTime = data.create_time;
                    projectInfo = data.info;
                    // projectPicUrl = data.picture; TODO 获取图片
                    refreshInfo();
                }
                else{
                    // TODO 其他错误信息处理
                }
            }
        });

    // TODO 更新评论及回复
};



