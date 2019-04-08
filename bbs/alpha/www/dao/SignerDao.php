<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 2019/4/7
 * Time: 23:52
 */

class SignerDao{

    public static function signUp($username,$password,$email,$type){
        $sql = "insert into user(username,password,email,type) values ('$username','$password','$email','$type')";
        $conn = self::getConnection();
        $result = mysqli_query($conn,$sql);
        mysqli_close($conn);
        return $result;
    }

    public static function getConnection(){
        $server = "localhost";
        $db_username = "root";
        $db_password = "";
        $conn = mysqli_connect($server,$db_username,$db_password);

        if(!$conn){
            echo "MySQL连接失败" . mysqli_connect_error();
            //TODO 打印日志
        }
        mysqli_select_db($conn,"v1_test");
        return $conn;
    }
}