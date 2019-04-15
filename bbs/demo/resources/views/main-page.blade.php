@extends('master')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <ul>
            @if(session()->has('uid'))
                <li><a href="project/create">创建项目</a></li>
                <li><a href="usr/sign-out">退出登录</a></li>
            @else
                <li><a href="usr/sign-in">登陆</a></li>
                <li><a href="usr/sign-up">注册</a></li>
            @endif
        </ul>
    </div>
@endsection