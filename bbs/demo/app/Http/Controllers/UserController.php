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

        $rules = [
            'name' => [
                'required',
                'max:16',
                'min:8',
            ],
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'min:8',
                'max:16'
            ],
            'kind' => [
                'required',
                'in:1,2,3'
            ]
        ];

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return redirect('usr/sign-up')
                ->withErrors($validator)        // 带错误信息的重定向
                ->withInput();                  // 保存原输入
        }

        $searchName = User::where('user_name', $input['name'])->get();
        $searchEmail = User::where('user_email', $input['email'])->get();
        if($searchName->count() != 0 || $searchEmail->count() != 0)
        {
            return redirect('usr/sign-in')
                ->with(['status'=>400]);
        }


        $input['password'] = Hash::make($input['password']);    // 使用APP_KEY进行加密
        $input['user_regTime'] = date("Y-m-d");
        $userInfo = array(
            "user_name" => $input["name"],
            "password" => $input["password"],
            "user_email" => $input["email"],
            "user_kind" => $input["kind"],
            "user_regTime" => $input["user_regTime"]
        );
//        $User = User::create($input);
        $User = User::create($userInfo);
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

        return redirect()->to('html/new-sign-in.html');
    }

    public function signInProcess()
    {
        $input = request()->all();

        $rules = [
            'name' => [
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
            $response = [
                'status' => 400,
            ];
            return response()->json($response);;
        }

        // 验证密码。
        $user = User::where('user_name', $input['name'])->firstOrFail();
        $isPasswordCorrect = Hash::check($input['password'], $user->password);
        if(is_null($isPasswordCorrect))
        {
            $response = [
                'status' => 400,
            ];
            return response()->json($response);
        }

        // 登陆成功，写session
        session()->put('uid', $user->uid);

        $response = [
            'status' => 200,
            'redirect' => 'main',
        ];

        return response()->json($response);
    }

    /**
     * 注销逻辑：从session中删除uid
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logOut()
    {
        session()->forget('uid');
        return redirect('main');
    }

    /**
     * 通过Session获取uid
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurUserInfo(Request $request){
        $session = $request->session();
        $uid = $session->get('uid');
        $user = User::find($uid);
        $response = array(
            "email" => $user["user_email"],
            "name" => $user["user_name"],
            "password" => $user["password"],
            "regTime" => $user["user_regTime"],
            "kind" => $user["user_kind"],
        );
        return response()->json($response);
    }

    /**
     * 通过POST获取uid
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfoByUid(Request $request){
        $data = json_decode($request->getContent(),true);
        $uid = $data['uid'];
        $user = User::find($uid);
        $response = array(
            "email" => $user["user_email"],
            "name" => $user["user_name"],
            "password" => $user["password"],
            "regTime" => $user["user_regTime"],
            "kind" => $user["user_kind"],
        );
        return response()->json($response);
    }

    public function changeAll(Request $request){
        $data = json_decode($request->getContent(),true);
        $session = $request->session();
        $uid = $session->get('uid');
        $changeInfo = array(
            'user_email' => $data["email"],
            'user_name' => $data["name"],
            'password' => $data["password"],
            'user_kind' => $data["kind"]
        );
        if(User::find($uid)){
            User::where("uid","=",$uid)->update($changeInfo);
            $response = array(
                'status' => 200,
            );
        }
        else{
            $response = array(
                'status' => 400,
            );
        }
        return response()->json($response);
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
        return response()->json($response);
    }

    public function changePassword(Request $request,$uid){ //same as change name
        $data = json_decode($request->getContent(),true);
        $password = $data["password"];
        $password = Hash::make($password);
        //TODO 1.判断密码是否合法
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
        return response()->json($response);
    }
}
