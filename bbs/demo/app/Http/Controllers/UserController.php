<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

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

    public function signUpPage()
    {
        $binding =[
            'title' => '注册'
        ];

        return view('sign-up', $binding);
    }

    public function signUpProcess()
    {
        $input = request()->all();
        var_dump($input);
        exit;
    }
}
