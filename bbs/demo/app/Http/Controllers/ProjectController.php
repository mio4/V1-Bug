<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\DataEntity\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
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
        // return redirect('project/'.$project_id);
        return redirect('main');
    }
}
