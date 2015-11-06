@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.login.css') }}"/>
@endsection
@section('content')
    <div class="layout">
        <div class="nl-content">
            <h1 class="nl-login-title" id="custom_display_256"><span id="message_LOGIN_TITLE">欢迎登陆米淘商家系统!</span></h1>
            <div class="nl-frame-container">
                <div class="ng-form-area show-place" id="form-area">
                    <form method="post" id="miniLogin">
                        <div class="shake-area" id="shake_area" style="z-index:30;">
                            <div class="enter-area" id="enter_user">
                                <input type="text" name="username" class="enter-item first-enter-item" id="miniLogin_username" placeholder="管理账号">
                                <span class="error-tip"><em class="error-ico"></em><span class="error-msg"></span></span>
                            </div>
                            <div class="enter-area" style="z-index:20;">
                                <input type="password" name="password" class="enter-item last-enter-item" id="miniLogin_pwd" placeholder="密码">
                                <span class="error-tip"><em class="error-ico"></em><span class="error-msg"></span></span>
                            </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input class="button orange" type="submit" id="message_LOGIN_IMMEDIATELY" value="立即登录">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection