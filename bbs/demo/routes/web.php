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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user','UserController@home');
//Route::get('/user','UserController@action_index');

//Route::get('/',function(){
//   return "Hello,Laravel";
//});

//Route::get('/Hello',function(){
//   return "Laravel";
//});

//Route::get('/user/{id?}')

Route::get("/test","UserController@test");


//------------ 路由测试 ------------
Route::get("/testGet","TestController@testGet");
Route::get("/testGetId/{id}","TestController@testGetId");
Route::get("/testPath/{id}","TestController@testPath");
Route::get("/testPath2/{id}","TestController@testPath2");
Route::post("/testMethod","TestController@testMethod");
Route::get("/testMethod","TestController@testMethod");
//测试视图
Route::get("/testView","TestController@testView");
Route::get("/testView2","TestController@testView2");

//------------ 路由测试 ------------

