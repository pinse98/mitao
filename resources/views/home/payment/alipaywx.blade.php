@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.success.css') }}"/>
@endsection
@section('js')
    <script src="{{ asset('js/ap.js') }}"></script>
    <script>
        var href = '{{ $goPay }}';
        _AP.pay(href);
    </script>
@endsection