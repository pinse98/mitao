@extends('home.base')
@section('css')
    {{--<link rel="stylesheet" href="{{ asset('css/product.list.css') }}"/>--}}
    <link rel="stylesheet" href="http://img01.mifile.cn/m/atpl/sass/xmapp_b17276b.css"/>
@endsection
@section('content')
    <div class="user_view_03 mt20">
        <div class="box box_02 mb20">
            <div class="user_nav list_nav mlr20">
                <ul>
                    <li class="items">
                        <a class="lnk" href="{{ url('my/order/success') }}">
                            <div class="un un_01">已完成订单</div>
                        </a>
                    </li>
                    <li class="items">
                        <a class="lnk" href="{{ url('my/order/waitpay') }}">
                            <div class="un un_02">待付款订单</div>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="items">
                        <a class="lnk" href="{{ url('my/coupon') }}">
                            <div class="un un_04">
                                优惠券
                            </div>
                        </a>
                    </li>
                    <li class="items">
                        <a class="lnk" href="{{ url('my/shipping') }}">
                            <div class="un un_05">
                                地址管理
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection