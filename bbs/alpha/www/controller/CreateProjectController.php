<?php
/**
 * Controller层 项目操作控制
 * @author      Cookize
 * @name        CreateProjectController
 */

require_once '../config.php';
require_once ROOT_PATH.'/service/ProjectService.php';

class CreateProjectController
{
    public static function create_project()
    {
        $name = '';
        $info = '';
        $kind = 0;
        $reward = 0;
        $photos = array();
        // TODO:接收前端数据

        try
        {
            ProjectService::create_project($name, $info, $kind, $reward, $photos);
        }
        catch(Exception $e)
        {
            // TODO:处理Service层抛出的异常，返回信息至前端
        }

        exit;
    }
}

CreateProjectController::create_project();