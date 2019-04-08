<?php
/**
 * Created by PhpStorm.
 * User: Cookize
 * Date: 2019/4/8
 * Time: 22:33
 */

require_once '../dao/LoginDao.php';

class LoginService
{
    public static function login_service($_username,$_password){
        //密码MD5加密

        //保存到数据库
        try {
            return LoginDao::login_by_name($_username, $_password);
        } catch (Exception $e) {
            // TODO:处理各种异常
        }
    }
}