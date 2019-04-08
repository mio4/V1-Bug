<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 2019/4/7
 * Time: 23:52
 */

require_once 'DatabaseBasicFunc.php';

class SignerDao{

    public static function signUp($_username,$_password,$_email,$_type)
    {
        $database = new DatabaseBasicFunc();
        $data = array(
            'username'=>$_username,
            'password'=>$_password,
            'email'=>$_email,
            'type'=>$_type
        );
        $retVar = false;
        //$sql = "insert into user(username,password,email,type) values ('$username','$password','$email','$type')";
        //$conn = self::getConnection();
        //$result = mysqli_query($conn,$sql);
        //mysqli_close($conn);
        try{
            $database->startTrans();
            $retVar = $database->insert('User',$data) > 0;
            $database->commit();
        }
        catch(Exception $exception)
        {
            $database->rollback();
        }
        $database->close();

        return $retVar;
    }
}