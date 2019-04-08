<?php
/**
 * Created by PhpStorm.
 * User: Cookize
 * Date: 2019/4/8
 * Time: 22:33
 */

require_once '../service/LoginService.php';

class LoginController
{
    public static function login()
    {
        //从POST体获取数据
        $username = $_POST["username"];
        $password = $_POST["password"];
        $isByName = true;
        // TODO:检查数据是否合法，并分类登陆方式

        //调用Service层逻辑
        // TODO:选择不同中登陆服务
        $isSuccess = RegisterService::register_service($username,$password,$email,$type);
        // TODO:返回合法JSON
    }
}

