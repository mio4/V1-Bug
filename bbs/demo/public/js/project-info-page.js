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
                    pid : pid,
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
                    projectKind = data.kind;
                    projectOwnerName = data.user_name;
                    projectOwnerId = data.uid;
                    projectReward = data.reward;
                    projectMaxParticipant = data.participant_max;
                    projectCreateTime = data.create_time;
                    projectInfo = data.info;
                    // projectPicUrl = data.picture; TODO 获取图片
                }
                else{
                    // TODO 其他错误信息处理
                }
            }
        });

    // 更新项目信息
    $("#project-name").innerText = projectName;
    $("#project-owner").innerText = projectOwnerName;
    $("#project-info").innerText ="&emsp;&emsp;" + projectInfo;
    $("#project-reward").innerText = projectReward;
    $("#project-participant-max").innerText = projectMaxParticipant;
    $("#project-create-time").innerText = projectCreateTime;
    switch (projectKind) {
        case 0:{
            $("#project-kind").innerText = "生活创意";
            break;
        }
        case 1:{
            $("#project-kind").innerText = "科技创意";
            break;
        }
        case 2:{
            $("#project-kind").innerText = "实验室项目";
            break;
        }
        default:{
            $("#project-kind").innerText = "普通项目";
        }
    }

    // TODO 更新评论及回复
};



