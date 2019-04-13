<?php
/**
 * Service层 项目服务
 * @author      Cookize
 * @name        ProjectService
 */

require_once '../config.php';
require_once ROOT_PATH.'/dao/ProjectDao.php';
require_once ROOT_PATH.'/exception/ProjectException.php';

class ProjectService
{

    /**
     * 创建项目
     * @param $_name string 项目名称
     * @param $_info string 项目简述
     * @param $_kind int    项目类型
     * @param $_reward int  项目悬赏
     * @param array $_photos string 图片url
     * @throws ProjectException
     */
    public static function create_project($_name, $_info, $_kind, $_reward, array $_photos)
    {

        // 创建项目
        try
        {
            ProjectDao::create_project($_name, $_info, $_kind, $_reward);
        }
        catch(ProjectException $e)
        {
            throw $e;
        }

        // TODO：存储项目图片

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
        try
        {
            ProjectDao::change_project_basic($_name, $_new, $_key);
        }
        catch(ProjectException $e)
        {
            throw $e;
        }
    }

    public static function delete_project($_name)
    {
        // TODO:删除项目
    }

    // TODO:管理项目图片


    public static function participate()
    {

    }
}