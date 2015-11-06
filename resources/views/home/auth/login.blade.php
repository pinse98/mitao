@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.login.css') }}"/>
@endsection
@section('content')
    <div class="layout">
        {{--@if(Illuminate\Support\Facades\Input::get('msg', null))--}}
            {{--<div class="show-msg">{{ Illuminate\Support\Facades\Input::get('msg') }}</div>--}}
        {{--@endif--}}
        <div class="nl-content">
            <h1 class="nl-login-title" id="custom_display_256"><span>登陆米淘</span></h1>
            <div class="nl-frame-container">
                <div class="ng-form-area show-place" id="form-area">
                    <form method="post" action="" id="miniLogin">
                        <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
                        <div class="shake-area" id="shake_area" style="z-index:30;">
                            <div class="enter-area" id="enter_user">
                                <input type="text" name="username" class="enter-item first-enter-item" placeholder="请输入手机号码">
                            </div>
                            <div class="enter-area">
                                <input type="password" name="password" class="enter-item last-enter-item" placeholder="请输入密码">
                            </div>
                        </div>
                        <input class="button orange" type="submit" value="立即登录">
                        <span>
                            <a href="{{ url('register') }}" class="button">注册米淘帐号</a>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection