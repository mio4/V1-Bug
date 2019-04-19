$("#btn-logout").click(function(){
    $.ajax(
        {
            type:"GET",
            url:"../user/logout",
            dataType:"json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            error : function() {
                alert('网络繁忙');
                window.location.replace("sign-page.html"); // TODO 测试用
            },
            success:function()
            {
                window.location.replace("sign-page.html");
            }
        });
});

$("#btn-user-info").click(function(){
    window.location.href = 'user-info-page.html';
});