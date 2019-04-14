<?php

namespace App\Http\Controllers;

use App\DataEntity\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
            'user_name' => [
                'required',
                'max:16',
                'min:8',
            ],
            'user_email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'same:password_confirmation',
                'min:8',
                'max:16'
            ],
            'password_confirmation' => [
                'required',
                'min:8',
                'max:16'
            ],
            'user_kind' => [
                'required',
                'in:G,A,L'
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
        //$User = User::create($input);
        $retVar = DB::table('user')->insert([
            'user_name'=>$input['user_name'],
            'user_email'=>$input['user_email'],
            'user_kind'=>$input['user_kind'],
            'password'=>$input['password'],
            'user_regTime'=>date("Y-m-d")
        ]);

        if(true == $retVar)
        {
            return redirect('usr/sign-up')
                ->with(['status'=>200]);
        }
        else{
            return redirect('usr/sign-up')
                ->with(['status'=>400]);
        }
    }

    public function signInPage()
    {
        $binding = [
            'title' => '登陆'
        ];
        return view('signIn', $binding);
    }

    public function signInProcess()
    {
        $input = request()->all();

        $rules = [
            'user_name' => [
                'required',
                'max:16',
                'min:8',
            ],
            'password' => [
                'required',
                'min:8',
                'max:16'
            ]
        ];

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return redirect('usr/sign-up')
                ->withErrors($validator)        // 带错误信息的重定向
                ->withInput();                  // 保存原输入
        }

        // TODO: 改用ORM操作数据库

    }

    public function signOut()
    {

    }
}
