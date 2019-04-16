
function getUrlQueryString(urls)
{
    var paras = location.search;
    var result = paras.match(/[^\?&]*=[^&]*/g);
    paras = {};
    for(i in result) {
        var temp = result[i].split('=');
        paras[temp[0]] = temp[1];
    }
    return paras;
}


function getUrlParam(name) {
    //构造一个含有目标参数的正则表达式对象
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg); //匹配目标参数
    if (r != null) {
        return unescape(r[2]);
    } else {
        return null; //返回参数值
    }
}