@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.success.css') }}"/>
@endsection
@section('content')
<div id="wrapper">
    <div class="page-order-pay" data-log="在线支付">
        <div class="box box1">
            <div class="p1"><span class="iconfont">&#xe601;</span>&nbsp;&nbsp;&nbsp;<span>订单提交成功</span></div>
            <div class="p2"><span>请尽快完成支付，超时订单将关闭。</span></div>
        </div>
        <div class="box box2">
            <div class="p">订单编号：{{ $order->id }}</div>
            <div class="p">订单金额：{{ $order->total_fee }}元</div>
            <div class="p h_box">
                <div>收货信息：</div>
                <div class="flex_1">{{ $order->contacts_name }} {{ $order->contacts_phone }}
                    <br/>{{ $order->contacts_address }}<br/>({{ $order->contacts_zipcode }})
                </div>
            </div>
            <div class="p">发票类型：个人发票</div>
        </div>
        <div class="box box3">
            <div class="head"><span>请选择支付方式</span></div>
            <div class="list">
                <div class="item active" data-val="alipay">
                    <div class="inner">
                        <div class="p"><span class="iconfont pay-alipay">&#xe602;</span>&nbsp;<span>支付宝支付</span></div>
                    </div>
                </div>
                {{--<div class="item active" data-val="weixin">--}}
                    {{--<div class="inner">--}}
                        {{--<div class="p"><span class="iconfont pay-icon">&#xe600;</span>&nbsp;<span>微信支付</span></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="box box5">
            <form action="{{ url('order/payment') }}" method="post" id="sub-data">
                <input name="orderId" value="{{ $order->id }}" type="hidden"/>
                <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
            </form>
            <a href="javascript:void(0);" onclick="$('#sub-data').submit();" class="xm-button"><span>立即支付</span></a>
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
<script>
    $('.item').click(function(){
        $('.item').removeClass('active');
        $(this).addClass('active');
    });
</script>
@endsection