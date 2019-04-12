<?php

require_once '../config.php';
require_once ROOT_PATH.'/service/LoginService.php';
require_once ROOT_PATH.'/exception/InfoException.php';

class InfoController
{
    public static function updateMail() {
        $input = self::test_input($_POST["newMail"]);
        $input = json_decode($input, true);
        $newMail = $input[0]["value"]; //TODO: check name
        header('content-type:application/json');
        $ret = array('status'=>404);
        $userid = $_SESSION["userid"]; //TODO: SESSION

        try {
            InfoService::updateMail($userid, $newMail);
            $ret['status'] = 200;
            echo json_encode($ret);
            exit;
        } catch (Exception $e) {
            $ret['status'] = 400;
            echo json_encode($ret);
            exit;
        }
    }

    public static function updateName() {
        $input = self::test_input($_POST["newName"]);
        $input = json_decode($input, true);
        $newName = $input[0]["value"]; //TODO: check name
        header('content-type:application/json');
        $ret = array('status'=>404);
        $userid = $_SESSION["userid"]; //TODO: SESSION

        try {
            InfoService::updateName($userid, $newName);
            $ret['status'] = 200;
            echo json_encode($ret);
            exit;
        } catch (Exception $e) {
            $ret['status'] = 400;
            echo json_encode($ret);
            exit;
        }
    }

    public static function setPassword() {
        $input = self::test_input($_POST["newPassword"]);
        $input = json_decode($input, true);
        $newPassword = $input[0]["value"]; //TODO: check name
        header('content-type:application/json');
        $ret = array('status'=>404);
        $userid = $_SESSION["userid"]; //TODO: SESSION

        try {
            InfoService::updateName($userid, $newPassword);
            $ret['status'] = 200;
            echo json_encode($ret);
            exit;
        } catch (Exception $e) {
            $ret['status'] = 400;
            echo json_encode($ret);
            exit;
        }
    }

    public static function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function getFavorites() {
        $current_page   = empty($_GET['page']) ? 1 : $_GET['page'];
        $previous_page  = $current_page - 1;
        $next_page      = $current_page + 1;
        header('content-type:application/json');
        $ret = array(
            'status'=>404,
            'project'=>null
        );
        $userid = $_SESSION["userid"]; //TODO: SESSION

        try {
            $ret['project'] = InfoService::getFavorites($userid, $current_page);
            $ret['status'] = 200;
            echo json_encode($ret);
            exit;
        } catch (Exception $e) {
            $ret['status'] = 400;
            echo json_encode($ret);
            exit;
        }
    }
    public static function getFollows() {
        $current_page   = empty($_GET['page']) ? 1 : $_GET['page'];
        $previous_page  = $current_page - 1;
        $next_page      = $current_page + 1;
        header('content-type:application/json');
        $ret = array(
            'status'=>404,
            'follow'=>null
        );
        $userid = $_SESSION["userid"]; //TODO: SESSION

        try {
            $ret['follow'] = InfoService::getFollows($userid, $current_page);
            $ret['status'] = 200;
            echo json_encode($ret);
            exit;
        } catch (Exception $e) {
            $ret['status'] = 400;
            echo json_encode($ret);
            exit;
        }
    }
    public static function getContributors() {
        $current_page   = empty($_GET['page']) ? 1 : $_GET['page'];
        $previous_page  = $current_page - 1;
        $next_page      = $current_page + 1;
        header('content-type:application/json');
        $ret = array(
            'status'=>404,
            'contributor'=>null
        );
        $userid = $_SESSION["userid"]; //TODO: SESSION

        try {
            $ret['contributor'] = InfoService::getContributors($userid, $current_page);
            $ret['status'] = 200;
            echo json_encode($ret);
            exit;
        } catch (Exception $e) {
            $ret['status'] = 400;
            echo json_encode($ret);
            exit;
        }
    }
    public static function getProjects() {
        $current_page   = empty($_GET['page']) ? 1 : $_GET['page'];
        $previous_page  = $current_page - 1;
        $next_page      = $current_page + 1;
        header('content-type:application/json');
        $ret = array(
            'status'=>404,
            'project'=>null
        );
        $userid = $_SESSION["userid"]; //TODO: SESSION

        try {
            $ret['project'] = InfoService::getProjects($userid, $current_page);
            $ret['status'] = 200;
            echo json_encode($ret);
            exit;
        } catch (Exception $e) {
            $ret['status'] = 400;
            echo json_encode($ret);
            exit;
        }
    }
}