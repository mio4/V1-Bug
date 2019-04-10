<?php
/**
 * Controller层注册操作
 * @author Cookize
 */

require_once '../config.php';
require_once ROOT_PATH.'/service/RegisterService.php';
require_once ROOT_PATH.'/exception/RegisterException.php';

/**
 * Class RegisterController
 * 封装Controller层注册控制操作
 */
class RegisterController
{
    public static function register()
    {
        //从POST体获取数据
        $input = $_POST['RegInfo'];
        $input = json_decode($input, true);
        $username = $input[0]['value'];
        $password = $input[2]['value'];
        $email = $input[1]['value'];
        $type = $input[4]['value'];
        header('content-type:application/json');
        $ret = array('status'=>404);
        // TODO:检查数据是否合法

        //调用Service层逻辑
        try {
            RegisterService::register_service($username, $password, $email, $type);
            $ret['status'] = 200;
            echo json_encode($ret);
            exit;
        } catch (RegisterException $e) {
            $errorCode = $e->getCode();
            switch($errorCode)
            {
                case 1:         // TODO:返回注册失败信息
                case 2:
                case 3:
                case 4:
                default:
            }
        }
        // TODO:返回注册成功信息
        $ret['status'] = 400;
        echo json_encode($ret);
        exit;
    }
}

RegisterController::register();