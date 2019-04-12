<?php

require_once '../config.php';
require_once ROOT_PATH.'/dao/InfoDao.php';
require_once ROOT_PATH.'/exception/InfoException.php';

class InfoService
{
    public static function updateMail($userid, $newMail) {
        if (!filter_var($newMail, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "非法邮箱格式";
            //TODO: throw
            return -1;
        }
        $ret = InfoDao::updateMail($userid, $newMail);
        return $ret;
    }
    public static function updateName($userid, $newName) {
        $pattern = "/^[A-Za-z0-9]{8,16}$/";
        if (!preg_match($pattern, $newName)) {
            $nameErr = "";
            return -1;
        }
        $ret = InfoDao::updateName($userid, $newName);
        return $ret;
    }
    public static function updatePassword($userid, $newPassword) {
        $pattern = "/^[A-Za-z0-9]{8,16}$/";
        if (!preg_match($pattern, $newPassword)) {
            $passwordErr = "";
            return -1;
        }
        $ret = InfoDao::updatePassword($userid, $newPassword);
        return $ret;
    }
}
?>