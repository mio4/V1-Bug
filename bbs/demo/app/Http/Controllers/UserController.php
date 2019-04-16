<?php

namespace App\Http\Controllers;

use App\DataEntity\User;
use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
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

        // return view('sign-up', $binding);
        return redirect()->to('html/new-sign-in.html');
    }

    public function signUpProcess()
    {
        $input = request()->all();
        $response = [];
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
                'in:G,O'
            ]
        ];

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            $response['status'] = 400;
            $response['massage'] = $validator;
            return response()->json($validator);
        }

        $searchName = User::where('user_name', $input['user_name'])->get();
        $searchEmail = User::where('user_email', $input['user_email'])->get();
        if($searchName->count() != 0 || $searchEmail->count() != 0)
        {
            $response['status'] = 400;
            $response['massage'] = '用户已存在';
            return response()->json($response);
        }

        $input['password'] = Hash::make($input['password']);    // 使用APP_KEY进行加密
        $input['user_regTime'] = date("Y-m-d");
        $User = User::create($input);

        if(null != $User)
        {
            $response['status'] = 200;
            $response['redirect'] = 'main';
        }
        else{
            $response['status'] = 400;
            $response['massage'] = '网络繁忙';
        }
        return response()->json($response);
    }

    public function signInPage()
    {
        $binding = [
            'title' => '登陆'
        ];

        return redirect()->to('html/new-sign-in.html');
    }

    public function signInProcess()
    {
        $input = request()->all();
        $response = [];

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
            $response['status'] = 400;
            return response()->json($response);
        }

        // 验证密码。
        $user = User::where('user_name', $input['user_name'])->first();
        if(is_null($user))
        {
            $response['status'] = 400;
            return response()->json($response);
        }
        $isPasswordCorrect = Hash::check($input['password'], $user->password);
        if(is_null($isPasswordCorrect))
        {
            $response['status'] = 400;
            return response()->json($response);
        }

        // 登陆成功，写session
        session()->put('uid', $user->uid);
        $response['status'] = 200;
        $response['redirect'] = 'main';
        return response()->json($response);
    }

    public function signOut()
    {
        session()->forget('uid');

        return redirect('main');
    }

    public function changeName(Request $request,$uid){
        $data = json_decode($request->getContent(),true);
        $username = $data["name"];
        //1.TODO 判断用户名是否合法
        //2.修改用户名
        if(User::find($uid)){
            User::where("uid",'=',$uid)->update(['user_name' => $username]);
            $response = [
                'status' => 200,
            ];
        }
        else{
            $response = [
                'status' => 400,
            ];
        }
        //3.FIXME 封装返回函数，返回status code
        return response()->json($response);
    }

    public function changePwd(Request $request,$uid){ //same as change name
        $data = json_decode($request->getContent(),true);
        $password = $data["password"];
        $password = Hash::make($password);
        //1.判断密码是否合法

        //2.修改密码
        if(User::find($uid)){
            User::where("uid",'=',$uid)->update(['password' => $password]);
            $response = [
                'status' => 200,
            ];
        }
        else{
            $response = [
                'status' => 400,
            ];
        }
        //3.返回status code
        return response()->json($response);
    }


    /**
     * @param $code
     * @param $is_redirect
     * @param null $redirect 封装统一的返回函数
     */
    public function finish($code,$is_redirect,$redirect = null){
        if($code == 200){

        }
        else if($code == 400){

        }
    }




}
