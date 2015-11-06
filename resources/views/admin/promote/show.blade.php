@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.success.css') }}"/>
@endsection
@section('content')
    <div id="wrapper">
        <div class="page-order-pay" data-log="在线支付">
            <div class="box box2">
                <div class="p">推广收益：<font color="green">{{ $price }}</font> 元</div>
                <div class="p">推广代码：{{ $code }}</div>
            </div>
            <div class="box box3">
                <div class="head"><span>推广详细</span></div>
                @if($orders)
                <div class="list">
                    @foreach($orders as $order)
                    <div class="item">
                        @if($order->pay_type)
                            <div class="p"><span class="iconfont success-pay">&#xe605;</span>&nbsp;<span>{{ $order->product_name }} {{ $order->sku_name }}</span>&nbsp;<font color="green">+100</font></div>
                        @else
                            <div class="p"><span class="iconfont failure-pay">&#xe604;</span>&nbsp;<span>{{ $order->product_name }} {{ $order->sku_name }}</span>&nbsp;<font color="#ccc">+100</font></div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{--<div class="box box5">--}}
                {{--<a href="https://wx.tenpay.com/f2f?p=WaY7LwWK%2BLoy86aTMgge0Pck2uTXQ6S2Vyd9PBi%2F1yGQicEI5bhCtuY26YYiGtCqw6WOUP4yEmBFh5i7iJFgDlR%2BWQcb%2Fuf%2BMhB7xDL%2BaBu7Ur5twHEZz2ysYImQf4YNY3UiGttLCf63%2Bn5gH6L4i20IvgRosdc9nUbiqsZBQqg%3D" class="xm-button"><span>立即支付</span></a>--}}
            {{--</div>--}}

        </div>
    </div>
@endsection