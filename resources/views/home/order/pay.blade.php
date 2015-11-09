@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.success.css') }}"/>
@endsection
@section('content')
    <div id="wrapper">
        <div class="page-order-pay" data-log="在线支付">
            <div class="box box1">
                @if($success)
                    <div class="p1"><span class="iconfont">&#xe601;</span>&nbsp;&nbsp;&nbsp;<span>订单支付成功</span></div>
                    <div class="p2"><span>亲~到个人中心可以查询宝贝的物流信息哦~</span></div>
                @else
                    <div class="p1" style="color: red"><span class="iconfont">&#xe609;</span>&nbsp;&nbsp;&nbsp;<span>订单支付失败</span></div>
                    <div class="p2"><span>亲~请重新支付，超时订单将关闭。</span></div>
                @endif
            </div>
            <div class="box box5">
                <a href="{{ $myOrder }}" class="xm-button"><span>我的订单</span></a>
            </div>
            <div class="b b3 list">
                <ul>
                    <li>
                        <a>
                            <div class="imgurl">
                                <img class="lazy" src="{{ asset('imgs/help/service.jpg') }}">
                            </div>
                        </a>
                    </li>
                </ul>
                <!--vue-if-->
            </div>
        </div>
    </div>
@endsection