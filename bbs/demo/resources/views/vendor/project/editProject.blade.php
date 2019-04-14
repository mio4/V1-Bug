@extends('master')

@section('title', $title);

@section('content')
    <div class="content">
        <h1>{{ $title }}</h1>

        <form action="./" method="post">
            {{ method_field('PUT') }}

            <label for="project_name">
                项目名称：
                <input type="text"
                       name="project_name"
                       placeholder="Project name"
                       value="{{ old('project_name') }}"
                >
            </label>
            <br>
            <label for="project_kind">
                项目类型：
                <input type="text"
                       name="project_kind"
                       placeholder="Project kind"
                       value="{{ old('project_kind') }}"
                >
            </label>
            <br>
            <label for="project_reward">
                项目类型：
                <input type="text"
                       name="project_kind"
                       placeholder="Project kind"
                       value="{{ old('project_kind') }}"
                >
            </label>
            <br>
            <label for="project_info">
                项目名称：
                <textarea name="project_info"
                          placeholder="Project name"
                          cols="30" rows="10">
                    {{ old('project_info') }}
                </textarea>
            </label>
            <br>
            <button type="submit" class="btn btn-default">确认</button>
            {{ csrf_field() }}
        </form>
        @include('components.validationErrorMessage')
    </div>
@endsection
