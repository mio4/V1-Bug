<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        return "Hello,World!";
    }

    public function test(){
        $url = $_SERVER["HTTP_HOST"];
        $id = 100;
        $arr = array($id,$url);
        $arrs =json_encode($arr);
        return $arrs;
    }
}
