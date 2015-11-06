<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{ asset('static/lib/html5.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/lib/respond.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/lib/PIE_IE678.js') }}"></script>
    <![endif]-->
    <link href="{{ asset('static/h-ui/css/H-ui.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('static/h-ui/css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('static/lib/icheck/icheck.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('static/lib/bootstrapSwitch/bootstrapSwitch.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('static/lib/font-awesome/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <!--[if IE 7]>
    <link href="{{ asset('static/lib/font-awesome/font-awesome-ie7.min.css') }}" rel="stylesheet" type="text/css"/>
    <![endif]-->
    <link href="{{ asset('static/lib/iconfont/iconfont.css') }}" rel="stylesheet" type="text/css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="{{ asset('static/lib/DD_belatedPNG_0.0.8a-min.js') }}"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>后台管理系统 - 米淘优品</title>
    <meta name="keywords" content="关键词,5个左右,单个8汉字以内">
    <meta name="description" content="网站描述，字数尽量空制在80个汉字，160个字符以内！">
</head>
<body>
<header class="header">
    <nav class="mainnav Hui-wraper">
        <ul class="cl">
            <li class="current"><a href="#">首页</a></li>
            <li class="dropDown dropDown_hover"><a href="#" class="dropDown_A">首页管理 <i class="iconfont">
                        &#xf02a9;</i></a>
                <ul class="dropDown-menu radius box-shadow">
                    <li><a href="{{ url('admin/advert/show') }}">首页广告</a></li>
                    <li><a href="{{ url('admin/show/show') }}">首页商品</a></li>
                </ul>
            </li>
            <li><a href="{{ url('admin/orders/show') }}">订单管理</a></li>
            <li class="dropDown dropDown_hover"><a href="#" class="dropDown_A">用户管理 <i class="iconfont">
                        &#xf02a9;</i></a>
                <ul class="dropDown-menu radius box-shadow">
                    <li><a href="{{ url('admin/users/show') }}">商家管理</a></li>
                    <li><a href="{{ url('admin/users/members/show') }}">用户管理</a></li>
                </ul>
            </li>
            <li><a href="{{ url('admin/product/show') }}">商品管理</a></li>
            <li class="dropDown dropDown_hover"><a href="#" class="dropDown_A">SKU管理 <i class="iconfont">
                        &#xf02a9;</i></a>
                <ul class="dropDown-menu radius box-shadow">
                    <li><a href="{{ url('admin/sku/network/show') }}">网络</a></li>
                    <li><a href="{{ url('admin/sku/storage/show') }}">存储</a></li>
                    <li><a href="{{ url('admin/sku/memory/show') }}">内存</a></li>
                    <li><a href="{{ url('admin/sku/color/show') }}">颜色</a></li>
                    <li><a href="{{ url('admin/sku/image/show') }}">小图</a></li>
                </ul>
            </li>
            <li><a href="{{ url('admin/coupon/show') }}">优惠管理</a></li>
            <li><a href="{{ url('admin/logout') }}">退出登录</a></li>
        </ul>
    </nav>
</header>
<section class="Hui-container">
    <nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> <a href="/" class="c-primary">首页</a></nav>
    @yield('content')
</section>
{{--<footer class="footer">--}}
{{--<p>Copyright &copy;2013-2015 H-ui.net All Rights Reserved.</p>--}}
{{--</footer>--}}
<script type="text/javascript" src="{{ asset('static/lib/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/lib/layer1.8/layer.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/lib/laypage/laypage.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/lib/My97DatePicker/WdatePicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/lib/icheck/jquery.icheck.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/lib/bootstrapSwitch/bootstrapSwitch.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/lib/Validform_v5.3.2.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/lib/passwordStrength-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/h-ui/js/H-ui.js') }}"></script>
<script>
    $(function () {
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
        $("#demoform").Validform({
            tiptype: 2
        });
    });
</script>
</body>
</html>