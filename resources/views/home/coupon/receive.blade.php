@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.details.css') }}"/>
@endsection
@section('content')
    <div id="wrapper">
        <div class="page-order-checkout">
            <form action="" id="sub" method="post">
                <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
                <div class="t2">
                    <div class="item">
                        <div class="head"><span class="tit">领取红包</span></div>
                        <div class="body coupon">
                            <div class="child">
                                <div class="input">
                                    <input type="text" name="code" placeholder="填写红包兑换码">
                                </div>
                            </div>
                            <div class="child-btn">
                                <a href="javascript:void(0);" onclick="document.getElementById('sub').submit();" class="xm-button"><span>兑换红包</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection