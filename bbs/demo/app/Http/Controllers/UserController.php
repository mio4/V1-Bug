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

        $searchName = User::where('user_name', $input['user_name'])->get();
        $searchEmail = User::where('user_email', $input['user_email'])->get();
        if($searchName->count() != 0 || $searchEmail->count() != 0)
        {
            return redirect('usr/sign-in')
                ->with(['status'=>400]);
        }


        $input['password'] = Hash::make($input['password']);    // 使用APP_KEY进行加密
        $input['user_regTime'] = date("Y-m-d");
        $User = User::create($input);

        if(null != $User)
        {
            return redirect('main')
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
            return redirect('usr/sign-in')
                ->withErrors($validator)        // 带错误信息的重定向
                ->withInput();                  // 保存原输入
        }

        // 验证密码。
        $user = User::where('user_name', $input['user_name'])->firstOrFail();
        $isPasswordCorrect = Hash::check($input['password'], $user->password);
        if(!$isPasswordCorrect)
        {
            $errorMessage = [
                'msg' => [
                    '密码认证错误'
                ]
            ];
            return redirect('usr/sign-in')
                ->withErrors($errorMessage)
                ->withInput();
        }

        // 登陆成功，写session
        session()->put('uid', $user->uid);

        // 返回首页
        return redirect('main');
    }

    public function signOut()
    {
        session()->forget('uid');

        return redirect('main');
    }
}
