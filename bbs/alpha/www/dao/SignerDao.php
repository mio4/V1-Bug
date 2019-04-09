<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 2019/4/7
 * Time: 23:52
 */

require_once 'DatabaseBasicFunc.php';


class SignerDao{

    /**
     * DAO层注册操作
     * @param $_username    用户名
     * @param $_password    密码
     * @param $_email       邮箱
     * @param $_type        用户类型 TODO：内容未定
     * @return bool         注册结果
     */
    public static function sign_up($_username, $_password, $_email, $_type)
    {
        $database = new DatabaseBasicFunc();
        $data = array(
            'username'=>$_username,
            'password'=>$_password,
            'email'=>$_email,
            'type'=>$_type
        );
        $retVar = false;
        try{
            $database->startTrans();
            $retVar = $database->insert('User',$data) > 0;
            $database->commit();
        }
        catch(Exception $exception)
        {
            $database->rollback();
        }
        $database->close();
        return $retVar;
    }
}