<?php
/**
 * DAO层用户数据操作
 * @name    UserDao
 * @author  Cookize
 */

require_once '../config.php';
require_once ROOT_PATH.'/dao/DatabaseBasicFunc.php';
require_once ROOT_PATH.'/exception/LoginException.php';
require_once ROOT_PATH.'/exception/DatabaseException.php';

class UserDao
{
    /**
     * “使用用户名登陆”数据库操作，登陆成功后返回用户ID，失败抛出异常。
     * @param $_username
     * @param $_password
     * @return string
     * @throws LoginException   登陆失败异常
     *      ErrorCode:1----------用户名未注册
     *      ErrorCode:2----------密码错误
     *      ErrorCode:4----------数据库故障
     */
    public static function login_by_name($_username, $_password)
    {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            throw new LoginException('Exception:DATABASE FAILURE', 4);
        }

        // 检查用户名是否存在。
        $searchUser = array(
            'user_name'=>"'$_username'"
        );
        $fieldParam = array(
            'uid'
        );
        $database->where($searchUser);
        $database->field($fieldParam);
        $retUid = $database->select('User');
        if(1 != count($retUid))
        {
            throw new LoginException('Exception:USER NOT FOUND', 1);
        }

        // 检验密码是否正确。
        $checkPassword = array(
            'uid'=>$retUid[0]['uid'],
            'password'=>"'$_password'"
        );
        $database->where($checkPassword);
        if(1 != count($database->select('User')))
        {
            throw new LoginException('Exception:WRONG PASSWORD', 2);
        }
        $database->close();
        // 返回用户ID。
        return $retUid[0];
    }

    /**
     * “使用邮箱登陆”数据库操作，登陆成功后返回用户ID，失败抛出异常。
     * @param $_email
     * @param $_password
     * @return string
     * @throws LoginException   登陆失败异常
     *      ErrorCode:3----------邮箱未注册
     *      ErrorCode:2----------密码错误
     *      ErrorCode:4----------数据库错误
     */
    public static function login_by_email($_email, $_password)
    {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            throw new LoginException('Exception:DATABASE FAILURE', 4);
        }

        // 检查邮箱是否注册。
        $searchUser = array(
            'user_email'=>"'$_email'"
        );
        $fieldParam = array(
            'uid'
        );
        $database->where($searchUser);
        $database->field($fieldParam);
        $retUid = $database->select('User');
        if(1 != count($retUid))
        {
            throw new LoginException('Exception:EMAIL NOT FOUND', 3);
        }

        // 检验密码是否正确。
        $checkPassword = array(
            'uid'=>$retUid[0],
            'password'=>"'$_password'"
        );
        $database->where($checkPassword);
        if(1 != count($database->select('User')))
        {
            throw new LoginException('Exception:WRONG PASSWORD', 2);
        }
        $database->close();
        // 返回用户ID。
        return $retUid[0];

    }

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
            'user_name'=>$_username,
            'password'=>$_password,
            'user_email'=>$_email,
            'user_kind'=>$_type
        );
        $searchName = array(
            'user_name'=>"'$_username'"
        );
        $searchEmail = array(
            'user_email'=>"'$_email'"
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