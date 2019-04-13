
@extends('master')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>

        @include('components.validationErrorMessage')

        <form action="sign-up" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>
                昵称：
                <input type="text"
                       name="nickname"
                       placeholder="昵称"
                       value="{{ old('nickname') }}"
                >
            </label>
            <br/>
            <label>
                Email：
                <input type="text"
                       name="e-mail"
                       placeholder="E-mail"
                       value="{{ old('e-mail') }}"
                >
            </label>
            <br/>
            <label>
                密码：
                <input type="password"
                       name="password"
                       placeholder="密码"
                >
            </label>
            <br/>
            <label>
                确认密码：
                <input type="password"
                       name="password_confirmation"
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



