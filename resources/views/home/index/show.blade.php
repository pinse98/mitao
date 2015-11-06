@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.show.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}"/>
@endsection
@section('js')
    <script src="{{ asset('js/swiper.js') }}"></script>
@endsection
@section('content')
    <div class="page-index">
        @if(count($datas['adverts']))
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($datas['adverts'] as $advert)
                    <div class="swiper-slide">
                        <a href="{{ $advert->url }}">
                            <img class="swiper-img" src="{{ $advert->image }}"/>
                        </a>
                    </div>
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        @endif
        <div class="title">
            <span>现货购买</span>
        </div>
        <div class="card show_big"></div>
        <div class="card show_big show_big2">
            <div>
                @if(count($datas['products']))
                    @foreach($datas['products'] as $data)
                        <div class="col2">
                            @foreach($data as $da)
                                <div class="row1">
                                    @if($da->details_class and $da->details)
                                        <div class="tab-label {{ $da->detailsClass->class }} top-5 left-5">{{ $da->details }}</div>
                                    @endif
                                    <a class="img" href="{{ url('product/details/') }}/{{ $da->product->id }}">
                                        @if($da->image)
                                            <span class="imgurl"><img src="{{ $da->image }}"></span>
                                        @else
                                            <span class="imgurl"><img src="{{ $da->product->show_image }}"></span>
                                        @endif
                                    </a>
                                    <div class="left-10 bottom-10">{{ $da->product->name }}</div>
                                    <div class="left-10 bottom-10"><font color="#f61">{{ $da->product->show_price }}元起</font></div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div>
        <ul class="ui-list ui-list-pure ui-border-tb">
            <li class="ui-border-tb">
                <p style="text-align: center"><span>点击加载更多</span></p>
            </li>
        </ul>
    </div>
    <script>
        var swiper = new Swiper('.swiper-container', {
            pagination: '.swiper-pagination',
            paginationClickable: true,
            autoplay: 3000
        });
    </script>
@endsection