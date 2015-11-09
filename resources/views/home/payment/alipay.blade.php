@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.success.css') }}"/>
@endsection
@section('content')
    {{ html_entity_decode($showBody) }}
@endsection