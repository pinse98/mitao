@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.success.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/order.viewShipping.css') }}"/>
@endsection
@section('content')

<section class="container">
    @foreach($expresses as $key => $expresse)
        @if($key == 0)
            <div class="timeline status0">
                <p>{{ $expresse['time'] }}</p>

                <p>{{ $expresse['context'] }}</p>

                <div class="icon">
                    <img src="http://brup.365shengri.cn/image/web/mobile/orderStatusHandle.png">
                </div>
            </div>
        @else
            <div class="timeline status1">
                <p>{{ $expresse['time'] }}</p>

                <p>{{ $expresse['context'] }}</p>

                <div class="icon">
                    <img src="http://brup.365shengri.cn/image/web/mobile/orderStatusDone.png">
                </div>
            </div>
        @endif
    @endforeach
</section>
@endsection



