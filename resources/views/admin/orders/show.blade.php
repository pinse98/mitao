@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>订单列表</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/users/create') }}" class="btn btn-secondary radius mt-10">添加</a></div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table table-border table-bordered table-striped mt-20">
            <thead>
            <tr>
                <th>订单号</th>
                <th>商品</th>
                <th>型号参数</th>
                <th>优惠金额</th>
                <th>订单金额</th>
                <th>支付状态</th>
                <th>发货状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->product_name }}</td>
                    <td>{{ $order->sku_name }}</td>
                    <td>{{ $order->coupon_price }}</td>
                    <td>{{ $order->total_fee }}</td>
                    <td>
                        @if($order->pay_type)
                            <font color="green">已支付</font>
                        @else
                            <font color="red">未支付</font>
                        @endif
                    </td>
                    <td>
                        @if($order->delivery)
                            <font color="green">已发货</font>
                        @else
                            <font color="red">未发货</font>
                        @endif
                    </td>
                    <td class="col3">
                        @if(!$order->pay_type)
                            <a href="{{ url('admin/orders/pay') }}/{{ $order->id }}">支付订单</a>&nbsp;|&nbsp;
                        @endif

                        @if($order->delivery)
                            <a href="{{ url('admin/orders/view/shipping') }}/{{ $order->id }}">查看物流</a>
                        @else
                            <a href="{{ url('admin/orders/send/shipping') }}/{{ $order->id }}">发货</a>
                        @endif

                    </td>
                </tr>
            @endforeach
            @if($orders->count() >= 10)
                <tr>
                    <td colspan="3"><?php echo $orders->render(); ?></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection