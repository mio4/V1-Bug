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
//测试数据库连接
Route::get("/testConnection","TestController@testConnection");
//------------ 路由测试 ------------

//------------ 主要页面 ------------
Route::get('/main', 'MainController@mainPage');
//------------ 主要页面 ------------

//------------ 注册登录&修改个人信息 ------------
Route::group(['prefix' => 'user'], function(){
    // 注册页面
    Route::get('/sign-up', 'UserController@signUpPage');
    // 注册请求
    Route::post('/sign-up', 'UserController@signUpProcess');
    // 登陆页面
    Route::get('/sign-in', 'UserController@signInPage');
    // 登录请求
    Route::post('/sign-in', 'UserController@signInProcess');
    // 登出请求
    Route::get('/logout', 'UserController@logOut');
    //获取个人信息——GET
    Route::get('/info','UserController@getCurUserInfo');
    //获取个人信息——POST
    Route::post('/info','UserController@getUserInfoByUid');
});

Route::group(['prefix' => 'user/info/change'], function(){
    //全量修改
    Route::post('/','UserController@changeAll');
    //修改用户昵称
    Route::post('/name','UserController@changeName');
    //修改用户密码
    Route::post('/password','UserController@changePassword');
});
//------------ 注册登录&修改个人信息 ------------

//------------ 项目管理 ------------
Route::group(['prefix' => 'project'], function(){
    // 浏览项目列表
    Route::get('/', 'ProjectController@projectListPage');
    // 创建项目
    Route::get('/create', 'ProjectController@projectCreateProgress')
        ->middleware('user.online');
    // 关闭项目
    Route::post('/close', 'ProjectController@projectCloseProgress')
        ->middleware('user.online');
    // 参加项目
    Route::post('/participate', 'ProjectController@projectParticipateProgress');

    Route::group(['prefix' => 'info'], function(){
        // 项目信息
        Route::post('/', 'ProjectController@projectInfoGet');

        Route::group(['prefix' => 'basic'], function(){
            // 项目基本信息
            Route::post('/', 'ProjectController@projectBasicInfoGet');
            // 个人创建项目基本信息
            Route::post('/own', 'ProjectController@projectOwnBasicInfoGet');
            // 个人参加项目基本信息
            Route::post('/participate', 'ProjectController@projectParticipateBasicInfoGet');
        });
    });

    Route::group(['prefix' => 'star'], function(){
        // 收藏项目
        Route::post('/', 'ProjectController@projectStarProgress');
        // 获取个人收藏项目列表
        Route::post('/get', 'ProjectCOntroller@projectStarGet');
    });


//    Route::group(['prefix' => '{project_id}'], function(){
//        // 浏览项目页面
//        Route::get('/', 'ProjectController@projectItemPage');
//        // 修改项目信息页面
//        Route::get('/edit', 'ProjectController@projectItemEditPage')
//            ->middleware('user.online');
//        // 修改项目信息请求
//        Route::put('/edit', 'ProjectController@projectItemUpdateProgress')
//            ->middleware('user.online');
//        // TODO 添加更多功能
//    });
});
//------------ 项目管理 ------------

//------------ 关注 ------------
Route::group(['prefix' => 'project/star'],function(){
    //关注项目
    Route::post('/','StarController@starProject');
//    获取关注项目的基本信息
//    Route::get('/','StarController@getStarProject');
    //查看用户的收藏列表
    Route::post('/get','StarController@getStarProjectByUid');
});
Route::group(['prefix' => 'user/star'],function(){
    //关注用户
    Route::post('/','StarController@starUser');
    //根据uid获取用户的关注列表
    Route::post('/get','StarController@getUserStarList');

    Route::post('/hello','StarController@test');
});
//------------ 关注 ------------

//------------ 评论 ------------
Route::group(['prefix' => 'project/comment'],function(){
    //发表项目的评论
    Route::post('/publish','CommentController@publishComment');
    //对项目的评论发表回复
    Route::post('/reply/publish','CommentController@replyComment');
    //获取项目的评论
    Route::post('/get','CommentController@getComment');
    //获取评论的回复
    Route::post('/reply/get','CommentController@getReply');
});
//------------ 评论 ------------