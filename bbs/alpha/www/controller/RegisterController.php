<?php
/**
 * Controller层“登陆”逻辑
 * @author Cookize
 */

require_once '../service/RegisterService.php';

class RegisterController
{
    public static function register()
    {
        //从POST体获取数据
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $type = $_POST["type"];

        // TODO:检查数据是否合法

        //调用Service层逻辑
        $isSuccess = RegisterService::register_service($username,$password,$email,$type);
        // TODO:返回合法JSON

    }
}

RegisterController::register();