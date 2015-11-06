<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>米淘优品</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="{{ asset('assets/frozenui/css/frozen.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/frozenui/css/basic.css') }}"/>
    <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
    <link href="{{ asset('imgs/help/favicon.ico') }}" rel="shortcut icon">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}"/>
    @yield('css')
    @yield('js')
</head>
<body>
<div class="viewport" id="app">
    @if (Session::has('flash_notification.message'))
        <div class="show-msg">{{ Session::get('flash_notification.message') }}</div>
    @endif
    <div class="header">
        <div style="position:relative">
            <div class="left">
                <a href="{{ url('/') }}" class="home"><span class="iconfont">&#xe607;</span></a>
            </div>
            <div class="tit"></div>
            <div class="right">
                <ul>
                    <li class="cart">
                        <a href="{{ url('my/user/center') }}"><span class="iconfont ucenter-right">&#xe606;</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @yield('content')
</div>
<div id="footer" class="footer hide" style="display: block;">
    <div class="box box_03">
        <p>©2015 米淘优品</p>
    </div>
</div>
</body>
</html>