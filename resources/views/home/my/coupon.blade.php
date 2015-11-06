@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.list.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/order.details.css') }}"/>
@endsection
@section('content')
    <div class="line-x"></div>
    <ul class="c-ul">
        @if(count($coupons))
            @foreach($coupons as $coupon)
            <li>
                <div class="c-left">
                    <font color="#FFFFFF">￥{{ $coupon->coupon->coupon_price }}元</font>
                </div>
                <a href="{{ url('/') }}">
                    <div class="c-right">
                        <font color="#f60">立即使用</font>
                    </div>
                </a>
                <div class="line-x"></div>
            </li>
            @endforeach
        @endif
    </ul>
    <div style="padding: 20px;">
        <a href="{{ url('coupon/receive') }}" class="xm-button"><span>兑换红包</span></a>
    </div>
@endsection