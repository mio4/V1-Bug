<?php
/**
 * @name        LoginService
 * @function    登录操作Service层：
 *                  1.分发登陆方式
 *                  2.获取登陆结果，抛出异常
 *                  3.登陆成功时整理反馈的信息
 * @author      Cookize
 */

require_once '../dao/LoginDao.php';
require_once '../exception/LoginException.php';

class LoginService
{
    /**
     * Service层登陆处理：分发至“用户名登陆”或“邮箱登陆”
     * 登陆成功整理并返回用户信息，登陆失败抛出异常
     * @param $_username
     * @param $_password
     * @param $_loginType
     * @throws LoginException
     */
    public static function login_service($_key, $_password){
        // 密码MD5加密

        // 验证用户身份
        $retUid = '';
        $_isByName = true;
        // TODO:区别邮箱与用户名，选择不同种登陆服务

        try
        {
            if(true == $_isByName)
            {
                $retUid = LoginDao::login_by_name($_key, $_password);
            }
            else
            {
                $retUid = LoginDao::login_by_email($_key, $_password);
            }
        }
        catch (LoginException $e)
        {
            throw $e;                   // 传递异常至上层。
        }

        // TODO:获取用户信息


        // TODO:整理用户信息，上传至Controller层。
        return '';

    }
}