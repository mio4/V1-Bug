<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 2019/4/7
 * Time: 23:44
 */

require_once "../dao/SignerDao.php";

class SignerService{
    public static function signUp($username,$password,$email,$type){
        //密码MD5加密

        //保存到数据库
        SignerDao::signUp($username,$password,$email,$type);
    }
}