<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\DataEntity\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{

    /**
     * 创建项目逻辑，重定向至项目信息修改页面。
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function projectCreateProgress()
    {
        $projectData = [
            'project_name' => '',
            'project_owner' => session()->get('uid'),
            'project_info' => '',
            'project_kind' => '',
            'project_reward' => 0,
            'project_photo' => '',
            'project_createTime' => date('Y-m-d')
        ];

        $newProject = Project::create($projectData);

        return redirect('project/'.$newProject->pid.'/edit');
    }

    /**
     * 项目信息修改页面。
     * @param $project_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function projectItemEditPage($project_id)
    {
        $searchProject = Project::where('pid', intVal($project_id))->firstOrFail();
        if(is_null($searchProject))
        {
            // TODO 未找到项目
        }

        $binding = [
            'title' => '编辑项目信息',
            'pid' => $searchProject->pid
        ];

        // 重定向至编辑页面
        return view('project.editProject', $binding);
    }

    /**
     * 更新项目逻辑
     * @param $project_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function projectItemUpdateProgress($project_id)
    {
        $project = Project::where('pid', intVal($project_id))->firstOrFail();
        $input = request()->all();

        $rules = [
            'project_name' => [
                'required',
                'max:32'
            ],
            'project_info' => [
                'required',
                'max:500',
            ],
            'project_kind' => [
                'required',
                'max:1'
            ],
            'project_reward' => [
                'required',
                'integer'
            ]
        ];

        $validator = Validator::make($input, $rules);

        // 验证失败，返回创建界面
        if($validator->fails())
        {
            return redirect('project/'.$project_id.'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $project->update($input);

        // 创建成功，进入项目页面
        return redirect('project/'.$project_id);
        // return redirect('main');
    }

    /**
     * 显示项目列表逻辑
     */
    public function projectListPage()
    {

    }

    /**
     * 管理项目逻辑
     */
    public function projectManageListPage()
    {

    }

    /**
     * 项目页面显示
     */
    public function projectItemPage($project_id)
    {
        $searchProject = Project::where('pid', intVal($project_id))->firstOrFail();

        $binding = [
            'title' => '项目',
            'pid' => $searchProject->pid,
            'project_name' => $searchProject->project_name,
            'project_kind' => $searchProject->project_kind,
            'project_reward' => $searchProject->project_reward,
            'project_createTime' => $searchProject->project_createTime,
            'project_info' => $searchProject->project_info,
        ];

        return view('project.project-page', $binding);
    }
}
