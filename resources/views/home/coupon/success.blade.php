@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.success.css') }}"/>
@endsection
@section('content')
    <div id="wrapper">
        <div class="page-order-pay">
            <div class="box box1">
                <div class="p1"><span class="iconfont">&#xe601;</span>&nbsp;&nbsp;&nbsp;<span>恭喜您~</span></div>
                <div class="p2"><span><font color="#f60">￥{{ $price }}元</font> 现金红包已经发送到您米淘的账户中~</span></div>
            </div>
            <div class="box box5">
                <a href="{{ url('my/coupon') }}" class="xm-button"><span>查看我的红包</span></a>
            </div>
            <div class="box box5">
                <a href="{{ url('/') }}" class="xm-button"><span>返回首页</span></a>
            </div>
        </div>
    </div>
@endsection