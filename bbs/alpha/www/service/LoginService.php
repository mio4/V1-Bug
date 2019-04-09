<?php
/**
 * Created by PhpStorm.
 * User: Cookize
 * Date: 2019/4/8
 * Time: 22:33
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
     */
    public static function login_service($_username, $_password, $_loginType){
        // 密码MD5加密

        // 验证用户身份
        $retUid = '';
        try {
            $retUid = LoginDao::login_by_name($_username, $_password);
        } catch (LoginException $e) {
            // TODO:处理各种异常
            $errorID = $e->getCode();
            switch($errorID)
            {
                case 1: // TODO:整合DAO层的异常，上传至Controller层。
                case 2:
                case 3:
            }
        }

        // TODO:获取用户信息


        // TODO:整理用户信息，上传至Controller层。
        return '';

    }
}