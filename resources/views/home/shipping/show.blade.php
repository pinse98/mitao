@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.details.css') }}"/>
@endsection
@section('content')
    <div id="wrapper">
        <div class="page-order-checkout">
            <div class="address">
                <ul>
                    @if($shipping)
                        <li class="item">
                            <div class="p">
                            <span>
                                {{ $shipping->province }}
                                {{ $shipping->city }}
                                {{ $shipping->district }}
                                {{ $shipping->address }}
                            </span>
                            </div>
                            <div class="p"><span>({{ $shipping->zipcode }})</span></div>
                            <div class="p"><span>{{ $shipping->name }} {{ $shipping->tel }}</span></div>
                        </li><div class="sepa"></div>
                        <li class="item-h">
                            <div class="btn"><a href="{{ url('my/shipping/edit') }}/{{ $shipping->id }}" class="xm-button"><span>修改收货地址</span></a></div>
                        </li>
                    @else
                        <li class="item">
                            <div class="btn"><a href="{{ url('my/shipping/create') }}" class="xm-button"><span>添加收货地址</span></a></div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection