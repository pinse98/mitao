@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.show.css') }}"/>
@endsection
@section('content')
    <div class="line-border"></div>
    <div class="b b1">
        <div>
            <div>
                <div class="b13">
                    <a class="button active_button" href="{{ url('product/details') }}/{{ $product->id }}">返回商品</a>
                </div>
            </div>
        </div>
    </div>
    <div class="line-border"></div>
    @if($product->detail)
        <div class="b b3 list">
            <ul>
                @foreach(explode('||', $product->detail) as $showImg)
                    <li>
                        <a>
                            <div class="imgurl">
                                <img class="lazy" src="{{ $showImg }}">
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <!--vue-if-->
        </div>
    @endif
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