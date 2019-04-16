/**
 * 页面载入，获取项目详细信息
 */
window.onload = function(){
    // TODO 获取项目ID

    // TODO 根据后端修改
    $.ajax(
        {
            type:"POST",
            url:"../project/info",
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

    // TODO 更新页面
};

