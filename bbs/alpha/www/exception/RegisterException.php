<?php
/**
 * 注册异常类
 * @name:       RegisterException
 * @author:     Cookize
 */

require_once '../config.php';
require_once ROOT_PATH.'/exception/BasicException.php';

/**
 * Class RegisterException
 * ErrorCode:
 *      1 --------------------- 用户名重复
 *      2 --------------------- 邮箱重复
 *      3 --------------------- 数据库错误
 *      4 --------------------- 注册失败（未知错误） 暂时保留，后期删除
 */
class RegisterException extends BasicException
{

}
