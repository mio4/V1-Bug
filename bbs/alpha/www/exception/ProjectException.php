<?php
/**
 * 项目操作异常
 * @name ProjectException
 * @author Cookize
 */

require_once '../config.php';
require_once ROOT_PATH.'/exception/BasicException.php';


/**
 * Class ProjectException
 * ErrorCode:
 *      1 ----------------- 项目名重复
 *      2 ----------------- 创建失败
 *      3 ----------------- 非法属性名
 *      4 ----------------- 数据库故障
 *      5 ----------------- 修改失败
 */
class ProjectException extends BasicException
{

}