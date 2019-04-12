<?php

require_once '../config.php';
require_once ROOT_PATH.'/dao/InfoDao.php';
require_once ROOT_PATH.'/exception/InfoException.php';

$gNumPerPage = 20;


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

    public static function getFavorites($userid, $page) {
        global $gNumPerPage;
        $total_records = InfoDao::getFavoriteSum($userid);
        $total_pages = ceil($total_records / $gNumPerPage);
        if ($page > $total_pages || $page <= 0) {
            $pageErr = "";
            return -1;
        }
        $projects = InfoDao::getPageFavorite($userid, $page);
        $ret = array();
        $len = count($projects);
        for ($x = 0; $x < $len; $x++) {
            $pid = $projects[$x]["pid"];
            $ret.array_push(InfoDao::getProject($pid));
        }
        return $ret;
    }

    public static function getFollows($userid, $page) {
        global $gNumPerPage;
        $total_records = InfoDao::getFollowSum($userid);
        $total_pages = ceil($total_records / $gNumPerPage);
        if ($page > $total_pages || $page <= 0) {
            $pageErr = "";
            return -1;
        }
        $users = InfoDao::getPageFollow($userid, $page);
        $ret = array();
        $len = count($users);
        for ($x = 0; $x < $len; $x++) {
            $uid = $users[$x]["uid"];
            $ret.array_push(InfoDao::getUser($uid));
        }
        return $ret;
    }
    
    public static function getContributors($userid, $page) {
        global $gNumPerPage;
        $total_records = InfoDao::getContributorSum($userid);
        $total_pages = ceil($total_records / $gNumPerPage);
        if ($page > $total_pages || $page <= 0) {
            $pageErr = "";
            return -1;
        }
        $projects = InfoDao::getPageContributor($userid, $page);
        $ret = array();
        $len = count($projects);
        for ($x = 0; $x < $len; $x++) {
            $pid = $projects[$x]["pid"];
            $ret.array_push(InfoDao::getProject($pid));
        }
        return $ret;
    }
    public static function getProjects($userid, $page) {
        global $gNumPerPage;
        $total_records = InfoDao::getProjectSum($userid);
        $total_pages = ceil($total_records / $gNumPerPage);
        if ($page > $total_pages || $page <= 0) {
            $pageErr = "";
            return -1;
        }
        $ret = InfoDao::getPageProject($userid, $page);
        return $ret;
    }
}
?>