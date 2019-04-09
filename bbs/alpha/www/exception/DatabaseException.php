<?php
/**
 * 数据库异常类
 * @name        DatabaseException
 * @author      Cookize
 */

require_once '../config.php';
require_once ROOT_PATH.'/exception/BasicException.php';

/**
 * Class DatabaseException
 * ErrorCode:
 *      1 -------------------- 数据库连接异常
 */
class DatabaseException extends BasicException
{

}