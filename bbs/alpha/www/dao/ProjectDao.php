<?php
/**
 * Dao层 项目数据库操作
 * @author      Cookize
 * @name        ProjectDao
 */

require_once '../config.php';
require_once ROOT_PATH.'/dao/DatabaseBasicFunc.php';
require_once ROOT_PATH.'/exception/DatabaseException.php';
require_once ROOT_PATH.'/exception/ProjectException.php';

class ProjectDao
{
    /**
     * 创建项目，存储项目的基本信息：名称、简述、种类、
     * @param $_name string 项目名称
     * @param $_info string 项目简述
     * @param $_kind int    项目类型
     * @param int $_reward 项目悬赏
     * @throws ProjectException
     */
    public static function create_project($_name, $_info, $_kind, $_reward = 0)
    {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch(DatabaseException $e)
        {
            throw new ProjectException('Exception:DATABASE FAILURE', 4);
        }

        $data = array(
            'project_name'=>$_name,
            'project_info'=>$_info,
            'project_kind'=>$_kind,
            'project_reward'=>$_reward
        );

        // 检查项目名是否存在。
        $searchProject = array(
            'project_name'=>"'$_name'"
        );
        $fieldParam = array(
            'pid'
        );
        $database->where($searchProject);
        $database->field($fieldParam);
        $retPid = $database->select('Project');
        if(0 != count($retPid))
        {
            // TODO:抛出错误，项目重名
            throw new ProjectException('Exception:DUPLICATE NAME', 1);
        }
        $retVar = false;
        try
        {
            $database->startTrans();
            $retVar = $database->insert('Project',$data) > 0;
            $database->commit();
        }
        catch(Exception $e)
        {
            $database->rollback();
            throw new ProjectException("Exception:DATABASE FAILURE", 4);
        }
        $database->close();
        if(false == $retVar)
        {
            throw new ProjectException('Exception:CREATE FAILURE', 2);
        }
        return;
    }

    /**
     * 修改项目基本信息
     * @param $_name string 项目名称
     * @param $_new  string|int 新字段值
     * @param $_key  int   修改字段类型
     *          0 -------- 修改项目名称
     *          1 -------- 修改项目简述
     *          2 -------- 修改项目类型
     *          3 -------- 修改项目悬赏
     * @throws ProjectException
     */
    public static function change_project_basic($_name, $_new, $_key)
    {
        $database = new DatabaseBasicFunc();
        try
        {
            $database->init_database();
        }
        catch(DatabaseException $e)
        {
            throw new ProjectException("Exception:DATABASE FAILURE", 4);
        }

        // 根据传入的 key值修改对应字段；
        $keywords = array(
            'project_name',
            'project_info',
            'project_kind',
            'project_reward'
        );
        $update = null;
        if(0 <= $_key && 3 >= $_key)
        {
            $update = array(
                $keywords[$_key]=>$_new
            );
        }
        else{
            throw new ProjectException("Exception:ILLEGAL KEYWORD", 3);
        }

        $whichProject = array(
            'project_name'=>$_name
        );
        $database->where($whichProject);
        $retVar = false;
        try
        {
            $database->startTrans();
            $retVar = $database->update('Project',$update) > 0;
            $database->commit();
        }
        catch(Exception $e)
        {
            throw new ProjectException("Exception:DATABASE FAILURE", 4);
        }
        $database->close();

        if(false == $retVar)
        {
            throw new ProjectException("Exception:UPDATE FAILURE", 5);
        }
        return;
    }
}
