<?php
/**
 * Service层登陆逻辑
 * @author Cookize
 */

require_once '../dao/RegisterDao.php';

class RegisterService
{
    public static function register_service($username,$password,$email,$type){
        //密码MD5加密

        //保存到数据库
        return RegisterDao::register($username,$password,$email,$type);
    }
}