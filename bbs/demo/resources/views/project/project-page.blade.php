@extends('master')

@section('title', $title)

@section('content')
    <div class="content">
        <ul>
            <li>项目名称：{{ $project_name }}</li>
            <li>项目类型：{{ $project_kind }}</li>
            <li>项目悬赏：{{ $project_reward }}</li>
            <li>项目创建时间：{{ $project_createTime }}</li>
            <li>项目简述：{{ $project_info }}</li>
        </ul>
        <a href="{{ $pid }}/edit">修改项目信息</a>
    </div>
    @include('components.validationErrorMessage')
@endsection