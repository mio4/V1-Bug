<?php

namespace App\Http\Controllers;

use App\DataEntity\User;
use App\DataEntity\Project;
use App\DataEntity\UserProject;
use App\DataEntity\UserStar;
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

//    /**
//     *
//     * @param Request $request
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function getStarProject(Request $request){
//        $session = $request->session();
//        $u1_id = $session->get('uid');
//        $data = json_decode($request->getContent(),true);
//        $u2_id = $data["uid"];
//        $starInfo = array(
//            "u1_id" => $u1_id,
//            "u2_id" => $u2_id
//        );
//        try{
//            UserProject::create($starInfo);
//            $response = array(
//                "status" => 200
//            );
//        } catch (\Exception $exception){
//            $response = array(
//                "status" => 400
//            );
//        }
//        return response()->json($response);
//    }

    /**
     * 查看用户的收藏列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStarProjectByUid(Request $request){
        $data = json_decode($request->getContent(),true);
        $uid = $data['uid'];

        $result = array();
        try{
            $data = UserProject::where("uid","=",$uid)->get();
            foreach($data as $single_data){
                $pid = $single_data["pid"];
                $project_res = Project::find($pid);
                $project = array();
                $project["pid"] = $project_res["pid"];
                $project["name"] = $project_res["project_name"];
                $project["picture"] = $project_res["project_photo"];
                $project["create_time"] = $project_res["project_createTime"];
                array_push($result,$project);
            }
        } catch (\Exception $exception){
            $result = array(
                "status" => 400
            );
        }
        return response()->json($result);
    }

    /**
     * 关注用户
     * 1. user_star表中添加一条数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function starUser(Request $request){
        $session = $request->session();
        $u1_id = $session->get('uid');
        $data = json_decode($request->getContent(),true);
        $u2_id = $data["uid"];
        $starInfo = array(
            "u1_id" => $u1_id,
            "u2_id" => $u2_id
        );
        try{
            UserStar::create($starInfo);
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

    /**
     * 根据uid查询用户的关注列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserStarList(Request $request){
        $data = json_decode($request->getContent(),true);
        $u1_id = $data['uid'];
        $result["info"] = array();

        try{
            $data = UserStar::where("u1_id","=",$u1_id)->get();
            foreach($data as $single_data){
                $u2_id = $single_data["u2_id"];
                $user_res = User::find($u2_id);
                $user = array();
                $user["uid"] = $u2_id;
                $user["name"] = $user_res["user_name"];
                $user["picture"] = $user_res["picture"];
                array_push($result["info"],$user);
            }
        } catch (\Exception $exception){
            $result = array(
                "status" => 400
            );
        }
        return response()->json($result);
    }

    public function test(){
        echo "hello";
    }
}

