@extends('master')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <form action="sign-in" method="post">
            <label for="user_name">
                用户名：
                <input type="text"
                       name="user_name"
                       placeholder="User Name"
                       value="{{ old('user_name') }}"
                >
            </label>
            <label for="password">
                密码：
                <input type="password"
                       name="password"
                       placeholder="User Name"
                >
            </label>
            <button type="submit">登陆</button>
            {!! csrf_field() !!}
        </form>
        @include('components.validationErrorMessage')
    </div>
@endsection