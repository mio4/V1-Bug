<?php
/**
 * DAO层用户数据操作
 * @name    UserDao
 * @author  Cookize
 */

require_once '../config.php';
require_once ROOT_PATH.'/dao/DatabaseBasicFunc.php';
require_once ROOT_PATH.'/exception/InfoException.php';
require_once ROOT_PATH.'/exception/DatabaseException.php';


class InfoDao
{
    public static function updateMail($_uid, $newMail) {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO:
        }
        // 检查邮箱是否注册。
        $searchUser = array(
            'email'=>"'$newMail'"
        );
        $fieldParam = array(
            'uid'
        );
        $database->where($searchUser);
        $database->field($fieldParam);
        $retUid = $database->select('user');
        if(1 == count($retUid))
        {
            //TODO: throw new Exception;
        }

        $searchUser = array(
            'id'=>"'$_uid'"
        );
        $updateUser = array(
            'email'=>"'$newMail'"
        );
        $database->where($searchUser);
        $ret = $database->update("user", $updateUser);
        //TODO: check return
        $database->close();

        return $ret;
    }

    public static function updateName($_uid, $newName) {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO: throw new Exception;
        }

        // 检查用户名是否注册。
        $searchUser = array(
            'username'=>"'$newName'"
        );
        $fieldParam = array(
            'uid'
        );
        $database->where($searchUser);
        $database->field($fieldParam);
        $retUid = $database->select('user');
        if(1 == count($retUid))
        {
            //TODO: throw new Exception;
        }

        $searchUser = array(
            'id'=>"'$_uid'"
        );
        $updateUser = array(
            'username'=>"'$newName'"
        );
        $database->where($searchUser);
        $ret = $database->update("user", $updateUser);
        //TODO: check return
        $database->close();

        return $ret;
    }

    public static function updatePassword($_uid, $newPassword) {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO: throw new Exception;
        }

        $searchUser = array(
            'id'=>"'$_uid'"
        );
        $updateUser = array(
            'password'=>"'$newPassword'"
        );
        $database->where($searchUser);
        $ret = $database->update("user", $updateUser);
        //TODO: check return
        $database->close();

        return $ret;
    }
}
?>