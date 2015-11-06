@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.login.css') }}"/>
@endsection
@section('content')
    <div class="layout">
        <div class="nl-content">
            <h1 class="nl-login-title" id="custom_display_256"><span id="message_LOGIN_TITLE">注册米淘账号</span></h1>
            <div class="nl-frame-container">
                <div class="ng-form-area show-place" id="form-area">
                    <form method="post" action="" id="miniLogin">
                        <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
                        <div class="shake-area" id="shake_area" style="z-index:30;">
                            <div class="enter-area">
                                <input type="text" name="username" class="enter-item first-enter-item" placeholder="请输入手机号码">
                            </div>
                            <div class="enter-area">
                                <input type="password" name="password"  style="border-top: 0px" class="enter-item" placeholder="请输入密码">
                            </div>
                            <div class="enter-area">
                                <input type="password" name="password-double" class="enter-item last-enter-item" placeholder="请再次输入密码">
                            </div>
                        </div>
                        <input class="button orange" type="submit" value="立即注册">

                        <span id="custom_display_128">
                            <a href="{{ url('login') }}" class="button">返回登录</a>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection