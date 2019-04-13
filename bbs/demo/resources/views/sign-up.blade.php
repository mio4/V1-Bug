
@extends('master')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        <form action="/usr/sign-up" method="post">
            <label>
                昵称：
                <input type="text"
                       name="nickname"
                       placeholder="昵称"
                >
            </label>
            <br/>
            <label>
                Email：
                <input type="text"
                       name="nickname"
                       placeholder="E-mail"
                >
            </label>
            <br/>
            <label>
                密码：
                <input type="text"
                       name="nickname"
                       placeholder="密码"
                >
            </label>
            <br/>
            <label>
                确认密码：
                <input type="text"
                       name="nickname"
                       placeholder="确认密码"
                >
            </label>
            <br/>
            <label>
                账户类型：
                <select name="type">
                    <option value="G">一般用户</option>
                    <option value="A">管理者</option>
                </select>
            </label>
            <br/>
            <button type="submit">注册</button>
        </form>
    </div>
@endsection()



