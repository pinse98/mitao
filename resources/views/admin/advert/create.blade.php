@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>首页广告添加</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/advert/show') }}" class="btn btn-secondary radius mt-10">返回</a></div>
            </div>
        </div>
        <div class="line"></div>
        <form action="" method="post" class="form form-horizontal responsive" id="demoform">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
            <div class="row cl">
                <label class="form-label col-2">广告名称：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text" placeholder="广告名称" name="name" datatype="*1-16" nullmsg="名称不能为空">
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">广告图片：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text" placeholder="广告图片" name="image" datatype="*1-1000" nullmsg="名称不能为空">
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">广告链接：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text" placeholder="广告链接" name="url" datatype="*1-1000" nullmsg="名称不能为空">
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">广告排序：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text" placeholder="广告排序" name="level" datatype="*1-16" nullmsg="名称不能为空">
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