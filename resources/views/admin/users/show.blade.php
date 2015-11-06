@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>商家列表</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/users/create') }}" class="btn btn-secondary radius mt-10">添加</a></div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table table-border table-bordered table-striped mt-20">
            <thead>
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>优惠码</th>
                <td>推广金额</td>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        @if($user->coupon)
                            {{ $user->coupon->coupon_name }}
                        @endif
                    </td>
                    <td>
                        @if($user->coupon)
                            {{ App\Models\PhoneOrder::where(['coupon_id' => $user->coupon->id, 'coupon_pay' => 0])->count() * 100 }}
                        @endif
                    </td>
                    <td class="col3">
                        <a href="{{ url('admin/users/edit') }}/{{ $user->id }}">编辑</a>
                        &nbsp;|&nbsp;
                        @if($user->enable)
                            <a href="{{ url('admin/users/enable') }}/{{ $user->id }}">禁用</a>
                        @else
                            <a href="{{ url('admin/users/enable') }}/{{ $user->id }}">启用</a>
                        @endif
                        &nbsp;|&nbsp;
                        <a href="{{ url('admin/users/pay/commission') }}/{{ $user->id }}">支付佣金</a>
                    </td>
                </tr>
            @endforeach
            @if($users->count() >= 10)
                <tr>
                    <td colspan="3"><?php echo $users->render(); ?></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection