@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/order.details.css') }}"/>
@endsection
@section('content')
<div id="wrapper">
    <div class="page-order-checkout" data-log="提交订单">
        <form action="" method="POST" id="sub-order">
            <input name="sku_id" id="sku-id" type="hidden" value="{{ $id }}" />
            <input name="coupon_id" id="coupon-id" type="hidden" value="0"/>
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        </form>
        <div class="address">
            <ul>
                <li class="item edit">
                    <a href="{{ url('my/shipping/edit') }}/{{ $user->shipping->id }}?callback={{ url('order/details') }}/{{ $id }}">
                        <div class="p">
                            <span>
                                {{ $user->shipping->province }}
                                {{ $user->shipping->city }}
                                {{ $user->shipping->district }}
                                {{ $user->shipping->address }}
                            </span>
                        </div>
                        <div class="p"><span>({{ $user->shipping->zipcode }})</span></div>
                        <div class="p"><span>{{ $user->shipping->name }} {{ $user->shipping->tel }}</span></div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sepa"></div>
        <div class="t1">
            <div class="item">
                <div class="head">
                    <span class="tit">支付方式</span><span class="val">在线支付</span>
                </div>
            </div>
            <div class="item">
                <div class="head">
                    <span class="tit">配送方式</span><span class="val">快递配送</span>
                </div>
            </div>
            <div class="item">
                <div class="head">
                    <span class="tit">发票信息</span><span class="val">个人发票</span>
                </div>
            </div>
        </div>
        <div class="sepa"></div>
        <div class="t2">
            <div class="item">
                <div class="head" id="c-class"><span class="tit">使用优惠券</span></div>
                <div class="body coupon" style="display: none">
                    @if($user->coupons)
                        @foreach($user->coupons()->where(['is_used' => 0])->get() as $coupon)
                            <div class="child o-coupon" data-coupon="{{ $coupon->coupon->id }}"><span>￥{{ $coupon->coupon->coupon_price }}元</span></div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="item">
                <div class="head" id="p-class"><span class="tit">商品清单：共1件商品</span></div>
                <div class="body product" style="display: none">
                    <div class="child">
                        <div class="pic">
                            <img src="{{ App\Models\PhoneImage::find($product->image_id)->image }}">
                        </div>
                        <div class="tit">
                            <span>
                                {{ App\Models\PhoneProduct::find($product->product_id)->name }}
                                {{ App\Models\PhoneNetwork::find($product->network_id)->name }}
                                {{ App\Models\PhoneMemory::find($product->memory_id)->name }}
                                {{ App\Models\PhoneColor::find($product->color_id)->name }}
                                {{ App\Models\PhoneStorage::find($product->storage_id)->name }}
                            </span>
                        </div>
                        <div class="attr">
                            <span>价格：{{ $product->price }}元 &nbsp; &nbsp;数量：1 &nbsp; &nbsp;小计：{{ $product->price }}元</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sepa"></div>
        <div class="satt">
            <div class="pt"><span>订单金额</span><span class="right">{{ $product->price }}元</span></div>
            <div class="pt"><span>运费</span><span class="right">0元</span></div>
            <div class="pt"><span>优惠劵</span><span class="right" id="coupon_fee">0元</span></div>
            <div class="pt hot"><span>商品金额合计</span><span class="right" id="total_fee">{{ $product->price }}元</span></div>
            <div class="btn">
                <a href="javascript:void(0);" onclick="document.getElementById('sub-order').submit();" class="xm-button"><span>去结算</span></a>
            </div>
        </div>
    </div>
</div>
<script>
    $('#p-class').click(function(){
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('.product').hide();
        } else {
            $(this).addClass('active');
            $('.product').show();
        }
    });

    $('#c-class').click(function(){
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('.coupon').hide();
        } else {
            $(this).addClass('active');
            $('.coupon').show();
        }
    });

    $('.o-coupon').click(function(){
        $('.o-coupon').removeClass('active');
        $(this).addClass('active');
        var couponId = $(this).data('coupon');
        var productId = '{{ $id }}';
        var token = '{{ csrf_token() }}';
        $('#coupon-id').val(couponId);
        $.ajax({
            url: '{{ url('order/coupon/used') }}',
            data: {'coupon_id': couponId, 'product_id': productId, '_token': token},
            dataType: 'json',
            type: 'POST',
            success: function(data){
                if (data.code == 200) {
                    $('#coupon_fee').text('-' + data.ret.couponPrice + '元');
                    $('#total_fee').text(data.ret.skuPrice + '元');
                }
                alert(data.msg);
            }
        });
    });
</script>
@endsection