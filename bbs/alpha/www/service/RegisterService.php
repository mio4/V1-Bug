<?php
/**
 * Service层登陆逻辑
 * @author Cookize
 */

require_once '../config.php';
require_once ROOT_PATH.'/dao/UserDao.php';
require_once ROOT_PATH.'/exception/RegisterException.php';

class RegisterService
{
    /**
     * Service层注册处理：
     *      1.
     * @param $username
     * @param $password
     * @param $email
     * @param $type
     * @throws RegisterException
     */
    public static function register_service($username, $password, $email, $type){
        // TODO:密码MD5加密??

        //保存到数据库
        try
        {
            UserDao::register($username, $password, $email, $type);
        }
        catch (RegisterException $e)
        {
            throw $e;
        }
    }
}