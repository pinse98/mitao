@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>Sku网络编辑</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/sku/network/create') }}" class="btn btn-secondary radius mt-10">返回</a></div>
            </div>
        </div>
        <div class="line"></div>
        <form action="" method="post" class="form form-horizontal responsive" id="demoform">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="row cl">
                <label class="form-label col-2">网络名称：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text" value="{{ $network->name }}" placeholder="网络名称" name="name" datatype="*1-16" nullmsg="名称不能为空">
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