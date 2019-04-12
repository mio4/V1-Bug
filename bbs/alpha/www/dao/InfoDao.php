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

$gNumPerPage = 20;
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
        if (1 == count($retUid))
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

    public static function getFavoriteSum($_uid) {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO: throw new Exception;
        }
        $searchFavorite = array(
            'userid'=>"'$_uid'"
        );
        $fieldParam = array(
            'count(*)'
        );
        $database->where($searchFavorite);
        $database->field($fieldParam);
        $ret = $database->select('favorite');
        //TODO: check return
        $database->close();

        return $ret;
    }
    public static function getPageFavorite($_uid, $page) {
        global $gNumPerPage;
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO: throw new Exception;
        }
        $searchFavorite = array(
            'userid'=>"'$_uid'"
        );
        $database->where($searchFavorite);
        $database->limit($page, $gNumPerPage);
        $ret = $database->select('favorite');
        //TODO: check return
        $database->close();

        return $ret;
    }

    public static function getFollowSum($_uid) {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO: throw new Exception;
        }
        $searchFollow = array(
            'userid'=>"'$_uid'"
        );
        $fieldParam = array(
            'count(*)'
        );
        $database->where($searchFollow);
        $database->field($fieldParam);
        $ret = $database->select('follow');
        //TODO: check return
        $database->close();

        return $ret;
    }
    public static function getPageFollow($_uid, $page) {
        global $gNumPerPage;
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO: throw new Exception;
        }
        $searchFollow = array(
            'userid'=>"'$_uid'"
        );
        $database->where($searchFollow);
        $database->limit($page, $gNumPerPage);
        $ret = $database->select('follow');
        //TODO: check return
        $database->close();

        return $ret;
    }

    public static function getUser($_uid) {
        global $gNumPerPage;
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
        $database->where($searchUser);
        $ret = $database->select('user');
        //TODO: check return
        $database->close();

        return $ret;
    }

    public static function getContributorSum($_uid) {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO: throw new Exception;
        }
        $searchContributor = array(
            'userid'=>"'$_uid'"
        );
        $fieldParam = array(
            'count(*)'
        );
        $database->where($searchContributor);
        $database->field($fieldParam);
        $ret = $database->select('contributor');
        //TODO: check return
        $database->close();

        return $ret;
    }

    public static function getPageContributor($_uid, $page) {
        global $gNumPerPage;
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO: throw new Exception;
        }
        $searchContributor = array(
            'userid'=>"'$_uid'"
        );
        $database->where($searchContributor);
        $database->limit($page, $gNumPerPage);
        $ret = $database->select('contributor');
        //TODO: check return
        $database->close();

        return $ret;
    }

    public static function getProject($_pid) {
        global $gNumPerPage;
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO: throw new Exception;
        }
        $searchProject = array(
            'id'=>"'$_pid'"
        );
        $database->where($searchProject);
        $ret = $database->select('project');
        //TODO: check return
        $database->close();

        return $ret;
    }

    public static function getProjectSum($_uid) {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO: throw new Exception;
        }
        $searchProject = array(
            'creator'=>"'$_uid'"
        );
        $fieldParam = array(
            'count(*)'
        );
        $database->where($searchProject);
        $database->field($fieldParam);
        $ret = $database->select('project');
        //TODO: check return
        $database->close();

        return $ret;
    }

    public static function getPageProject($_uid, $page) {
        global $gNumPerPage;
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch (DatabaseException $e)
        {
            //TODO: throw new Exception;
        }
        $searchProject = array(
            'creator'=>"'$_uid'"
        );
        $database->where($searchProject);
        $database->limit($page, $gNumPerPage);
        $ret = $database->select('project');
        //TODO: check return
        $database->close();

        return $ret;
    }
}
?>