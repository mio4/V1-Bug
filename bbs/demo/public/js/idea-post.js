var projectNameValidate = false;
var projectRewardValidate = false;
var projectParticipantMaxValidate = false;
var projectInfoValidateValidate = false;

$("#project-name").blur(function(){
    var projectName = $("#project-name").val();
    projectNameValidate = false;
    if(projectName.length === 0){
        console.log("OK");
        $("#project-name-alert").html("<bold>*请输入创意名称</bold>");
    }
    else if(projectName.length > 30){
        $("#project-name-alert").html("<bold>*名称应在30字以内</bold>");
    }
    else{
        projectNameValidate = true;
    }
});

$("#project-reward").blur(function(){
    var projectReward = $("#project-reward").val();
    projectRewardValidate = false;
    if(projectReward.length === 0){
        $("#project-reward-alert").html("<bold>*请输入悬赏</bold>");
    }
    else if(parseInt(projectReward) < 0 || parseInt(projectReward) > 10000){
        $("#project-reward-alert").html("<bold>*悬赏应在0至10000之间</bold>");
    }
    else{
        projectRewardValidate = true;
    }
});

$("#project-participant-max").blur(function(){
    var projectParticipantMax = $("#project-participant-max").val();
    projectParticipantMaxValidate = false;
    if(projectParticipantMax.length === 0){
        $("#project-participant-max-alert").html("<bold>*请输入开发者人数限制</bold>");
    }
    else if(parseInt(projectParticipantMax) < 0 || parseInt(projectParticipantMax) > 10){
        $("#project-participant-max-alert").html("<bold>*开发者人数应在0至10之间</bold>");
    }
    else{
        projectParticipantMaxValidate = true;
    }
});

$("#project-info").blur(function(){
    var projectInfoValidate = $("#project-info").val();
    projectInfoValidateValidate = false;
    if(projectInfoValidate.length === 0){
        $("#project-info-alert").html("<bold>*请输入创意介绍</bold>");
    }
    else if(projectInfoValidate.length < 10 || projectInfoValidate.length > 300){
        $("#project-info-alert").html("<bold>*创意介绍应在10至300字之间</bold>");
    }
    else{
        projectInfoValidateValidate = true;
    }
});

$("#create-project").click(function(){
    if(!projectNameValidate
        || !projectRewardValidate
        || !projectParticipantMaxValidate
        || !projectInfoValidateValidate)
    {
        return;
    }

    var projectName = $("#project-name").val();
    var projectReward = $("#project-reward").val();
    var projectParticipant = $("#project-participant-max").val();
    var projectInfo = $("#project-info-alert").val();
    var projectKind = $("input[name='project-kind']:checked").val();
    var projectPicture = null;

    if(password_legal && password_con_legal){
        $.ajax({
            type : "POST",
            url:"../project/crate",
            data:
                {
                    name : projectName,
                    kind : projectKind,
                    reward : projectReward,
                    participant_max : projectParticipant,
                    info : projectInfo,
                },
            dataType:"json",
            success:function(data){
                if(data === 200){
                    // TODO
                    window.location.href = "project-info-page.html" + "?pid=" + data.pid;
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