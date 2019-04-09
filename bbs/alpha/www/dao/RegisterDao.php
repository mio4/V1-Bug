<?php
/**
 * DAO层注册数据库操作
 * @name    RegisterDao
 * @author  Cookize
 */

require_once '../config.php';
require_once ROOT_PATH.'/exception/DatabaseException.php';
require_once ROOT_PATH.'/exception/RegisterException.php';
require_once ROOT_PATH.'/dao/DatabaseBasicFunc.php';


/**
 * Class RegisterDao
 */
class RegisterDao{

    /**
     * DAO层注册操作
     * @param $_username    string      用户名
     * @param $_password    string      密码
     * @param $_email       string      邮箱
     * @param $_type        string      用户类型 TODO：内容未定
     * @return void
     * @throws RegisterException
     *      ErrorCode:1---------------用户名重复
     *      ErrorCode:2---------------邮箱重复
     *      ErrorCode:3---------------数据库错误
     *      ErrorCode:4---------------注册失败
     */
    public static function register($_username, $_password, $_email, $_type)
    {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            throw new RegisterException('Exception:DATABASE FAILURE',3);
        }

        $data = array(
            'username'=>$_username,
            'password'=>$_password,
            'email'=>$_email,
            'type'=>$_type
        );
        $searchName = array(
            'username'=>"'$_username'"
        );
        $searchEmail = array(
            'email'=>"'$_email'"
        );
        // 检查用户名和邮箱的唯一性。
        $database->where($searchName);
        $result = $database->select('User');
        if(0 != count($result))
        {
            throw new RegisterException('Exception:DUPLICATE NAME', 1);
        }
        $database->where($searchEmail);
        $result = $database->select('User');
        if(0 != count($result))
        {
            throw new RegisterException('Exception:DUPLICATE EMAIL', 2);
        }

        // 保存注册信息。
        $retVar = false;
        try{
            $database->startTrans();
            $retVar = $database->insert('User',$data) > 0;
            $database->commit();
        }
        catch(Exception $exception)
        {
            $database->rollback();
            throw new RegisterException('Exception:DATABASE FAILURE',3);
        }
        $database->close();
        if(false == $retVar)
        {
            throw new RegisterException('Exception:REGISTER FAILURE',4);
        }
        return;
    }
}