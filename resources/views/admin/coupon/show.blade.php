@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>优惠劵列表</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/coupon/create') }}" class="btn btn-secondary radius mt-10">添加</a></div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table table-border table-bordered table-striped mt-20">
            <thead>
            <tr>
                <th>ID</th>
                <th>优惠劵名称</th>
                <th>优惠码</th>
                <th>优惠金额</th>
                <th>发放量</th>
                <th>绑定用户</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->id }}</td>
                    <td>{{ $coupon->coupon_name }}</td>
                    <td>{{ $coupon->coupon_code }}</td>
                    <td>{{ $coupon->coupon_price }}</td>
                    <td>{{ $coupon->used }}</td>
                    <td>{{ $coupon->user ? $coupon->user->username : null }}</td>
                    <td class="col3">
                        <a href="{{ url('admin/coupon/edit') }}/{{ $coupon->id }}">编辑</a>
                        &nbsp;|&nbsp;
                        <a href="{{ url('admin/coupon/delete') }}/{{ $coupon->id }}">删除</a>
                    </td>
                </tr>
            @endforeach
            @if($coupons->count() >= 10)
                <tr>
                    <td colspan="3"><?php echo $coupons->render(); ?></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection