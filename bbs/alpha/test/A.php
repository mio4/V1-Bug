<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 2019/4/5
 * Time: 22:08
 */

//require_once include_once use

//include_once "B.php";
require_once "B.php";

$username = "a";
$password = "b";


class A
{
    private $username = "a";
    private $password = "b";

    public function sendToDao()
    {
        echo "send begin";
        B::getUsername($this->username);
        echo "send end";
    }


}

$a = new A();
$a->sendToDao();
