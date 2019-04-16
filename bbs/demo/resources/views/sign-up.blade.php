
@extends('master')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <form action="sign-up" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="user_name">
                用户名：
                <input type="text"
                       name="user_name"
                       placeholder="User name"
                       value="{{ old('user_name') }}"
                >
            </label>
            <br/>
            <label for="user_email">
                邮箱：
                <input type="text"
                       name="user_email"
                       placeholder="E-mail"
                       value="{{ old('user_email') }}"
                >
            </label>
            <br/>
            <label for="password">
                密码：
                <input type="password"
                       name="password"
                       placeholder="Password"
                >
            </label>
            <br/>
            <label for="password_confirmation">
                确认密码：
                <input type="password"
                       name="password_confirmation"
                       placeholder="Confirmation"
                >
            </label>
            <br/>
            <label for="user_kind">
                账户类型：
                <select name="user_kind">
                    <option value="G">一般用户</option>
                    <option value="A">开发者</option>
                    <option value="L">实验室官方</option>
                </select>
            </label>
            <br/>
            <button type="submit">注册</button>
            {!! csrf_field() !!}
        </form>
        @include('components.validationErrorMessage')
    </div>
@endsection()



