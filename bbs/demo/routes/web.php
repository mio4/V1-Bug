<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//------------ 路由测试 ------------
//主页路由
Route::get('/', function () {
    return view('welcome');
});
//测试普通get
Route::get("/testGet","TestController@testGet");
Route::get("/testGetId/{id}","TestController@testGetId");
Route::get("/testPath/{id}","TestController@testPath");
Route::get("/testPath2/{id}","TestController@testPath2");
Route::post("/testMethod","TestController@testMethod");
Route::get("/testMethod","TestController@testMethod");
//测试视图
Route::get("/testView","TestController@testView");
Route::get("/testView2","TestController@testView2");
//测试重定向
Route::get("/testRedirect","TestController@testRedirect");
Route::get("/testRedirect2","TestController@testRedirect2");
//测试向前端发送JSON
Route::get("/testJson","TestController@testJson");
//测试接收前端发来的JSON-注意这里是POST方法
Route::post("/testJson2","TestController@testJson2");
//测试添加Cookie
Route::get("/testAddCookie","TestController@testAddCookie");
//测试获取Cookie数据
Route::get("/testGetCookieAll","TestController@testGetCookieAll");
Route::get("/testGetCookieSingle","TestController@testGetCookieSingle");
//测试添加-获取-删除session
Route::get("/testAddSession","TestController@testAddSession");
Route::get("/testGetSession","TestController@testGetSession");
Route::get("/testDelSession","TestController@testDelSession");
//测试上传文件-必须使用POST
Route::post("/testFileUpload","TestController@testFileUpload");

//------------ 路由测试 ------------

//------------ 注册登录 ------------
Route::group(['prefix' => 'usr'], function(){
    Route::get('/sign-up', 'UserController@signUpPage');
    Route::post('/sign-up', 'UserController@signUpProcess');
});
Route::group(['prefix' => 'usr'], function(){
    Route::get('/sign-in', 'UserController@signInPage');
    Route::post('/sign-in', 'UserController@signInProcess');
    Route::get('/sign-out', 'UsrController@signOut');
});
