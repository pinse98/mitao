@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.success.css') }}"/>
@endsection
@section('content')
    <div id="wrapper">
        <div class="page-order-pay" data-log="在线支付">
            <div class="line-order"></div>
            @if($orders)
                @foreach($orders as $order)
                    <div class="box box2">
                        <div class="p">订单编号：{{ $order->id }}</div>
                        <div class="p">订单商品：{{ $order->product_name }}{{ $order->sku_name }}</div>
                        <div class="p">订单金额：￥{{ $order->total_fee }}元</div>
                        <div class="p">订单操作：<a href="{{ url('my/order/viewShipping') }}/{{ $order->id }}">查看物流</a></div>
                    </div>
                    <div class="line-order"></div>
                @endforeach
            @endif
        </div>
        <div class="line-order"></div>
    </div>
@endsection