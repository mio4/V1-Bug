<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 2019/4/5
 * Time: 20:37
 */

if(!isset($_POST['submit'])){
    exit("非法提交");
}

$username = $_POST["username"];
$password = $_POST["password"];

include("connect.php");
$sql = "insert into user(username,password) values ('$username','$password')";
$result = mysqli_query($conn,$sql);

if(!$result){
    echo "注册失败" . mysqli_error($conn);
}
else{
    echo "注册成功";
}
