<?php
/**
 * Created by PhpStorm.
 * User: Cookize
 * Date: 2019/4/8
 * Time: 22:33
 */

require_once 'DatabaseBasicFunc.php';

class LoginDao
{
    /**
     * “使用用户名登陆”数据库操作
     * @param $_username
     * @param $_password
     * @return string
     * @throws Exception    TODO：异常设计
     */
    public static function login_by_name($_username, $_password)
    {
        $database = new DatabaseBasicFunc();
        $whereParam = array(
            'username'=>$_username,
            'password'=>$_password
        );
        $fieldParam = array(
            'uid'
        );
        $database->where($whereParam);
        $database->field($fieldParam);
        $retUid = $database->select('User');
        if(1 != count($retUid))
        {
            throw new Exception();
        }
        return $retUid[1];
    }


    /**
     * “使用邮箱登陆”数据库操作
     * @param $_email
     * @param $_password
     * @return string
     * @throws Exception    TODO：异常设计
     */
    public static function login_by_email($_email, $_password)
    {
        $database = new DatabaseBasicFunc();
        $whereParam = array(
            'email'=>$_email,
            'password'=>$_password
        );
        $fieldParam = array(
            'uid'
        );
        $database->where($whereParam);
        $database->field($fieldParam);
        $retUid = $database->select('User');
        if(1 != count($retUid))
        {
            throw new Exception();
        }
        return $retUid[1];

    }
}