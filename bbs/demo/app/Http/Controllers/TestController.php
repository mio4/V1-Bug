<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class TestController 测试使用
 * @package App\Http\Controllers
 */
class TestController extends Controller
{
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









}
