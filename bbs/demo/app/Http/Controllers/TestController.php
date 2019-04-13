<?php

namespace App\Http\Controllers;

use App\testModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;


/**
 * Class TestController 测试使用
 * @package App\Http\Controllers
 */
class TestController extends Controller
{
    //-------------------- 测试前端->Controller --------------------
    public function testGet(Request $request){
        $name = $request->input("name");
        echo "$name";
    }

    public function testGetId(Request $request,$id){
        $name = $request->input("name");
        echo "name:$name" . " id:$id";
    }

    public function testPath(Request $request){
        $path = $request->path();
        echo $path;
    }

    public function testPath2(Request $request){
        $path = $request->path();
        if($path == "testPath2/100"){
            echo "你的路径输入正确";
        }
        else{
            echo "你的路径输入错误";
        }
    }

    public function testMethod(Request $request){
        $method = $request->method();
        echo "$method</br>";
        if($request->isMethod("post")){
            echo "POST Method";
        }
        else{
            echo "Other Method";
        }

    }

    public function testView(Request $request){
        $name = "后台数据~";
        return view("testV")->with("name",$name);
    }

    public function testView2(Request $request){
        $name = "this is name...";
        $id = "this is id...";
        $data = array(
            "name" => $name,
            "id" => $id
        );
        return view("testV2")->with($data);
    }

    public function testRedirect(){ //重定向到页面
        return redirect("html/component.html");
    }

    public function testRedirect2(){ //重定向到Controller
        return redirect()->action("TestController@testView");
    }

    public function testJson(){
        $data = Input::json();
        return $data->get("name","mio");
    }

    public function testJson2(Request $request){
        $data = $request->getContent();
        $data = json_decode($data);
        dd($data);
    }

    public function testAddCookie(){
        $response = new Response();
        $response->withCookie("website","www.mio4.com",1);
        return $response;
    }

    public function testGetCookieAll(Request $request){
        $cookies = $request->cookie();
        dd($cookies);
    }

    public function testGetCookieSingle(Request $request){
        $cookie = $request->cookie("website");
        echo $cookie;
    }

    public function testFileUpload(Request $request){
        if($request->isMethod("post")){
            $file = $request->file("myFile");
            //TODO 存放在指定路径下

        }

    }

    public function testAddSession(Request $request){
        $session = $request->session();
        $session->put("my_name","mio");
        echo "data has been added to session";
    }

    public function testGetSession(Request $request){
        $session = $request->session();
        if($session->get("my_name")){
            echo $session->get("my_name");
        }
        else{
            echo "no data in the session";
        }
    }

    public function testDelSession(Request $request){
        $session = $request->session();
        $session->remove("my_name");
        echo "data has been removed from session";
    }

    //-------------------- 测试Controller->Model --------------------
    public function testSelectOne(){
        $test_model = new TestModel();
        $people = $test_model->readAll();

    }









}
