<?php
/**
 * Controller层登陆控制操作
 * @name        LoginController
 * @author      Cookize
 */

require_once '../config.php';
require_once ROOT_PATH.'/service/LoginService.php';
require_once ROOT_PATH.'/exception/LoginException.php';

/**
 * Class LoginController
 * 封装Controller层登陆控制操作
 */
class LoginController
{
    public static function login()
    {
        //从POST体获取数据
        $username = $_POST["username"];
        $password = $_POST["password"];
        $userInfo = null;
        // TODO:检查数据是否合法，并分类登陆方式

        //调用Service层逻辑
        try
        {
            $userInfo = LoginService::login_service($username,$password);
        }
        catch (LoginException $e)
        {
            $errorCode = $e->getCode();
            switch ($errorCode)
            {
                case 1:
                    {
                        // TODO：登陆失败，用户名未注册。
                    }
                case 2:
                    {
                        // TODO：登陆失败，密码错误。
                    }
                case 3:
                    {
                        // TODO：登陆失败，邮箱未注册。
                    }
                default:
                    {
                        // TODO：登陆失败，未知错误。
                    }
            }
        }
        // TODO:登陆成功，返回用户信息（JSON）
    }
}

