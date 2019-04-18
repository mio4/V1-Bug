<?php

namespace App\Http\Controllers;

use App\DataEntity\User;
use App\Http\Controllers;
use App\DataEntity\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{

    /**
     * 更新项目信息
     * @param $project  Project
     * @param $data     array
     * @return int
     */
    private function updateProjectInfo($project, $data){
        $rules = [
            'project_name' => [
                'required',
                'min:1',
                'max:30'
            ],
            'project_info' => [
                'required',
                'min:10',
                'max:300',
            ],
            'project_kind' => [
                'required',
                'integer',
                'in:0,1,2',
            ],
            'project_reward' => [
                'required',
                'integer',
                'min:0',
                'max:10000'
            ],
            'participant_max' => [
                'requires',
                'min:0',
                'max:10',
                'integer',
            ]
            // TODO 图片
        ];

        $validator = Validator::make($data, $rules);

        // 验证失败，返回创建界面
        if($validator->fails())
        {
            return 400;
        }

        $project->update($data);

        // 创建成功
        return 200;
    }

    /**
     * 创建项目，重定向至项目信息修改页面。
     * @return \Illuminate\Http\JsonResponse
     */
    public function projectCreateProgress()
    {
        $input = request()->all();
        $response = [
            'status' => 400
        ];
        $projectData = [
            'project_name' => $input['name'],
            'project_owner' => session()->get('uid'),
            'project_info' => $input['info'],
            'project_kind' => $input['kind'],
            'project_reward' => $input['reward'],
            'participant_max' => $input['participant_max'],
            'project_photo' => '',
            'project_createTime' => date('Y-m-d')
        ];

        $newProject = Project::create($projectData);

        $response['status'] = $this->updateProjectInfo($newProject, $projectData);

        return response()->json($response);
    }

    /**
     * 项目信息修改页面。
     * @param $project_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
//    public function projectItemEditPage($project_id)
//    {
//        $searchProject = Project::where('pid', intVal($project_id))->first();
//        if(is_null($searchProject))
//        {
//            // TODO 未找到项目
//        }
//
//        $binding = [
//            'title' => '编辑项目信息',
//            'pid' => $searchProject->pid
//        ];
//
//        // 重定向至编辑页面
//        return view('project.editProject', $binding);
//    }

    /**
     * 更新项目逻辑
     * @param $project_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
//    public function projectItemUpdateProgress($project_id)
//    {
//        $project = Project::where('pid', intVal($project_id))->first();
//        $input = request()->all();
//
//        $rules = [
//            'project_name' => [
//                'required',
//                'max:32'
//            ],
//            'project_info' => [
//                'required',
//                'max:500',
//            ],
//            'project_kind' => [
//                'required',
//                'max:1'
//            ],
//            'project_reward' => [
//                'required',
//                'integer'
//            ]
//        ];
//
//        $validator = Validator::make($input, $rules);
//
//        // 验证失败，返回创建界面
//        if($validator->fails())
//        {
//            return redirect('project/'.$project_id.'/edit')
//                ->withErrors($validator)
//                ->withInput();
//        }
//
//        $project->update($input);
//
//        // 创建成功，进入项目页面
//        return redirect('project/'.$project_id);
//        // return redirect('main');
//    }

    /**
     * 项目页面显示
     */
//    public function projectItemPage($project_id)
//    {
//        $searchProject = Project::where('pid', intVal($project_id))->first();
//
//        $binding = [
//            'title' => '项目',
//            'pid' => $searchProject->pid,
//            'project_name' => $searchProject->project_name,
//            'project_kind' => $searchProject->project_kind,
//            'project_reward' => $searchProject->project_reward,
//            'project_createTime' => $searchProject->project_createTime,
//            'project_info' => $searchProject->project_info,
//        ];
//
//        return view('project.project-page', $binding);
//    }

    /**
     * 关闭项目， TODO 尚未设计
     * @return \Illuminate\Http\JsonResponse
     */
    public function projectCloseProgress(){
        $response = [
            'status' => 400,
        ];
        // TODO 进行关闭项目的操作

        $response['status'] = 200;
        return response()->json($response);
    }

    /**
     * 返回PID项目的详细信息。
     * @return \Illuminate\Http\JsonResponse
     */
    public function projectInfoGet(){
        $input = request()->all();
        $project = Project::where('pid', $input['pid'])->first();
        $user = User::where('uid', $project->project_owner);
        $retJson = [
            'name'              => $project->project_name,
            'uid'               => $project->project_owner,
            'user_name'         => $user->user_name,
            'kind'              => $project->project_kind,
            'reward'            => $project->project_reward,
            'participant_max'   => $project->participant_max,
            'create_time'       => $project->project_createTime,
            'info'              => $project->project_info,
            'picture'           => '', // TODO 增加图片功能
        ];
        return response()->json($retJson);
    }

    /**
     * 返回所有项目的基础信息
     * @return \Illuminate\Http\JsonResponse
     */
    public function projectInfoBasicGet(){
        $retJson = [];
        $retSum = 0;
        foreach(Project::cursor() as $project){
            $retJson[$retSum++] = [
                'name'              => $project->project_name,
                'kind'              => $project->project_kind,
                'reward'            => $project->project_reward,
                'create_time'       => $project->project_createTime,
                //'info'              => $project->project_info,
                'picture'           => '', // TODO 增加图片功能
            ];
        }
        return response()->json($retJson);
    }

    public function projectOwnBasicInfoGet(){

    }

    public function projectParticipateBasicInfoGet(){

    }
}
