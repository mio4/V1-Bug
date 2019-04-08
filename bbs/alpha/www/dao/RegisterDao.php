<?php
/**
 * DAO层“登陆”数据库操作
 * @author Cookize
 */

require_once 'DatabaseBasicFunc.php';


class RegisterDao{

    /**
     * DAO层注册操作
     * @param $_username    用户名
     * @param $_password    密码
     * @param $_email       邮箱
     * @param $_type        用户类型 TODO：内容未定
     * @return bool         注册结果
     * TODO：异常设计
     */
    public static function register($_username, $_password, $_email, $_type)
    {
        $database = new DatabaseBasicFunc();
        $data = array(
            'username'=>$_username,
            'password'=>$_password,
            'email'=>$_email,
            'type'=>$_type
        );
        // TODO:检查用户名和邮箱的唯一性，抛出异常。
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