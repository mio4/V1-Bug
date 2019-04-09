<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 2019/4/8
 * Time: 9:04
 */
$input = file_get_contents('php://input');
$input = json_decode($input,true);
$file_path = "log.info";
$file = fopen($file_path,'a');
fwrite($file,$input["userId"]);
fclose($file);
