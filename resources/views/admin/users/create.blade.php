@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>商家添加</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/users/show') }}" class="btn btn-secondary radius mt-10">返回</a></div>
            </div>
        </div>
        <div class="line"></div>
        <form action="" method="post" class="form form-horizontal responsive" id="demoform">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
            <div class="row cl">
                <label class="form-label col-2">用户名：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text" name="username" placeholder="用户名" datatype="*3-10" nullmsg="用户名不能为空">
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">密码：</label>
                <div class="formControls col-5">
                    <input type="password" class="input-text" name="password" placeholder="密码" datatype="*6-10" nullmsg="密码不能为空">
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">优惠码：</label>
                <div class="formControls col-5">
                    <select class="select" name="coupon">
                        <option value="0">请选择</option>
                        @foreach(App\Models\AdminCoupon::all() as $coupon)
                            <option value="{{ $coupon->id }}">{{ $coupon->coupon_name }}</option>
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