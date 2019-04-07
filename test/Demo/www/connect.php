<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 2019/4/5
 * Time: 20:22
 */

    $server = "localhost";
    $db_username = "root";
    $db_password = "123456";

    $conn = mysqli_connect($server,$db_username,$db_password);
    if(!$conn){
        echo "MySQL连接失败" . mysqli_connect_error();
    }

    mysqli_select_db($conn,"v1_test");
    //TODO

//    mysqli_close($conn);
?>