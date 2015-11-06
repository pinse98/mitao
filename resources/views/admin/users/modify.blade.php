@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>商家编辑</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/users/show') }}" class="btn btn-secondary radius mt-10">返回</a></div>
            </div>
        </div>
        <div class="line"></div>
        <form action="" method="post" class="form form-horizontal responsive" id="demoform">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
            <div class="row cl">
                <label class="form-label col-2">用户名：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text disabled" value="{{ $user->username }}" placeholder="用户名" readonly>
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">新密码：</label>
                <div class="formControls col-5">
                    <input type="password" class="input-text" name="password" placeholder="密码">
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">优惠码：</label>
                <div class="formControls col-5">
                    <select class="select" name="coupon">
                        <option value="0">请选择</option>
                        @foreach(App\Models\AdminCoupon::all() as $coupon)
                            @if($user->coupon_id == $coupon->id)
                                <option value="{{ $coupon->id }}" selected>{{ $coupon->coupon_name }}</option>
                            @else
                                <option value="{{ $coupon->id }}">{{ $coupon->coupon_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <div class="col-10 col-offset-2">
                    <input class="btn btn-primary" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </div>
@endsection