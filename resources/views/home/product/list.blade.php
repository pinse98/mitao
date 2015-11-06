@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.list.css') }}"/>
@endsection
@section('content')
<div>
    <ul class="list">
        @foreach($products as $product)
        <li>
            @if($product->image_id)
                <div class="img">
                    <img src="{{ App\Models\PhoneImage::find($product->image_id)->image }}">
                </div>
            @endif
            <div class="info">
                <div class="name">
                    <p>
                        <strong>
                            <a href="{{ url('order/details/') }}/{{ $product->id }}">
                                <font color="black">
                                    {{ App\Models\PhoneProduct::find($product->product_id) ?  App\Models\PhoneProduct::find($product->product_id)->name : null}}
                                    {{ App\Models\PhoneNetwork::find($product->network_id) ?  App\Models\PhoneNetwork::find($product->network_id)->name : null}}
                                    {{ App\Models\PhoneMemory::find($product->memory_id) ?  App\Models\PhoneMemory::find($product->memory_id)->name : null}}
                                    {{ App\Models\PhoneColor::find($product->color_id) ?  App\Models\PhoneColor::find($product->color_id)->name : null}}
                                    {{ App\Models\PhoneStorage::find($product->storage_id) ?  App\Models\PhoneStorage::find($product->storage_id)->name : null}}
                                </font>
                            </a>
                        </strong>
                    </p>
                </div>
                <div class="price">
                    <p><strong>{{ $product->price }}元</strong>
                    </p>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection