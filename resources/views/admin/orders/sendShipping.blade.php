@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>订单发货</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/orders/show') }}" class="btn btn-secondary radius mt-10">返回</a></div>
            </div>
        </div>
        <div class="line"></div>
        <form action="" method="post" class="form form-horizontal responsive" id="demoform">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
            <input name="orderId" value="{{ $order->id }}" type="hidden"/>
            <div class="row cl">
                <label class="form-label col-2">快递公司：</label>
                <div class="formControls col-5">
                    <select class="select" name="express">
                        @foreach(App\Models\AdminExpress::all() as $express)
                            <option value="{{ $express->id }}">{{ $express->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">运单号：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text" name="code" placeholder="运单号" datatype="*1-50" nullmsg="运单号" />
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