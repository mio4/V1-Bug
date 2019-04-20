/**
 * 解析URL中的隐式参数
 *      如: "/html?id=3
 *      get_url_param('id')==3
 * @param name
 * @returns {*}
 */
function get_url_param(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg); //匹配目标参数
    if (r != null) {
        return unescape(r[2]);
    } else {
        return null;
    }
}

/**
 * 重定向至用户页面
 */
function redirect_to_user(uid){
    window.location.href = "user-info-page.html" + "?uid=" + uid;
}

function redirect_to_project(pid){
    window.location.href = "project-info-page.html" + "?pid=" + pid;
}

/**
 *
 * @return {number}
 */
function JSONLength(obj) {
    var size = 0;
    var key;
    for (key in obj) {   //obj中存在几个关键字
        if (obj.hasOwnProperty(key))
            size++;
    }
    return size;
};
