<?php

namespace App\Http\Controllers;

use App\DataEntity\UserProject;
use Illuminate\Http\Request;

/**
 * Class StarController
 * @package App\Http\Controllers 关注相关Controller
 * 重点在于多对多关系的处理
 */
class StarController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 关注项目：
     * 1. user_project表添加一条数据
     */
    public function starProject(Request $request){
        $data = json_decode($request->getContent(),true);
        $pid = $data["pid"];
        $session = $request->session();
        $uid = $session->get('uid');
        //插入数据
        $starInfo = array(
            "uid" => $uid,
            "pid" => $pid
        );
        try{
            UserProject::create($starInfo);
            $response = array(
                "status" => 200
            );
        } catch (\Exception $exception){
            $response = array(
                "status" => 400
            );
        }
        return response()->json($response);
    }

    //TODO
    public function getStarProject(Request $request){
        $session = $request->session();
        $uid = $session->get('uid');
    }

    //TODO
    public function getStarProjectByUid(Request $request){
        $data = json_decode($request->getContent(),true);
        $uid = $data['uid'];
    }

    //TODO
    public function starUser(Request $request){
        $data = json_decode($request->getContent(),true);
        $star_uid = $data['uid'];
        $session = $request->session();
        $cur_uid = $session->get('uid');


    }

    //TODO
    public function getStarUser(Request $request){
        $session = $request->session();
        $uid = $session->get('uid');
    }
}

