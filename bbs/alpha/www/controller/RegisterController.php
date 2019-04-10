<?php
/**
 * Controller层注册操作
 * @author Cookize
 */

require_once '../config.php';
require_once ROOT_PATH.'/service/RegisterService.php';
require_once ROOT_PATH.'/exception/RegisterException.php';

/**
 * Class RegisterController
 * 封装Controller层注册控制操作
 */
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
        try {
            RegisterService::register_service($username, $password, $email, $type);
        } catch (RegisterException $e) {
            $errorCode = $e->getCode();
            switch($errorCode)
            {
                case 1:         // TODO:返回注册失败信息
                case 2:
                case 3:
                case 4:
                default:
            }
        }
        // TODO:返回注册成功信息

    }
}

RegisterController::register();