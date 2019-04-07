<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 2019/4/7
 * Time: 23:40
 */

require_once "../service/SignerService.php";

class SignerController
{
    public static function signUp()
    {
        //从POST体获取数据
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $type = $_POST["type"];

        //检查数据是否合法

        //调用Service层逻辑
        SignerService::signUp($username,$password,$email,$type);
        //返回合法JSON

    }
}

SignerController::signUp();

