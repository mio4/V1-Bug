<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        // var_dump($input);

        $rules = [
            'nickname' => [
                'required',
                'max:50'
            ],
            'e-mail' => [
                'required',
                'max:50',
                'email'
            ],
            'password' => [
                'required',
                'same:password_confirmation',
                'min:6'
            ],
            'password_confirmation' => [
                'required',
                'min:6'
            ],
            'type' => [
                'required',
                'in:G,A'
            ]
        ];

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return redirect('usr/sign-up')
                ->withErrors($validator)        // 带错误信息的重定向
                ->withInput();                  // 保存原输入
        }

        $input['password'] = Hash::make($input['password']);    // 使用APP_KEY进行加密
        exit;
    }
}
