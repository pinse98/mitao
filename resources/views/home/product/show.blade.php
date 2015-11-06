@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.show.css') }}"/>
@endsection
@section('content')
<div id="slider0" class="swipe swipe0" style="visibility: visible;">
    <div class="swipe-wrap">
        <div data-index="0" class="w-auto">
            <div class="imgurl"><img src="{{ $product->show_image }}"></div>
        </div>
    </div>
</div>
<div class="b b1">
    <div class="b11">
        <p>{{ $product->name }}</p>
    </div>
    <div class="b12">
        <p>{{ $product->show_price }}元起</p>
    </div>
    <div>
        <div>
            <div class="b13">
                @if(App\Models\PhoneSku::where(['product_id' => $product->id])->first())
                    <a class="button active_button" href="{{ url('product/lists') }}/{{ $product->id }}">立即订购</a>
                @else
                    <a class="button disable_button" href="javascript:void(0)">已售罄</a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="b b2">
    <div class="nav">
        <ul>
            <li><a href="{{ url('product/details/image').'/'.$product->id }}">图文详情(建议在WIFI下查看)</a></li>
            {{--<li><a class="on">功能</a></li>--}}
            {{--<li><a>工艺</a></li>--}}
            {{--<li><a>参数</a></li>--}}
            {{--<li><a>意外保</a></li>--}}
        </ul>
    </div>
</div>
<div class="line-border"></div>
<div class="b b3 list">
    <ul>
        <li>
            <a>
                <div class="imgurl">
                    <img src="/imgs/help/help.jpg"/>
                </div>
            </a>
        </li>
    </ul>
</div>
<div class="b b3 list">
    <!--vue-if-->
</div>
<div class="b b3 list">
    <!--vue-if-->
</div>
<div class="b b3 list">
    <!--vue-if-->
</div>
@endsection