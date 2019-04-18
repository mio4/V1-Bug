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
 *
 */
function redirect_to_user(uid){
    window.location.href = "info.html" + "?uid=" + uid;
}