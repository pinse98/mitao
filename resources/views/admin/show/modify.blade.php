@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>首页排版编辑</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/show/show') }}" class="btn btn-secondary radius mt-10">返回</a></div>
            </div>
        </div>
        <div class="line"></div>
        <form action="" method="post" class="form form-horizontal responsive" id="demoform">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"/>

            <div class="row cl">
                <label class="form-label col-2">选择商品：</label>
                <div class="formControls col-5">
                    <select class="select" name="product">
                        <option value="0">请选择</option>
                        @foreach(App\Models\PhoneProduct::all() as $product)
                            @if($show->product_id == $product->id)
                                <option value="{{ $product->id }}" selected="selected">{{ $product->name }}</option>
                            @else
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-5"> </div>
            </div>

            <div class="row cl">
                <label class="form-label col-2">商品标签：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text" value="{{ $show->details }}" name="details" placeholder="商品描述">
                </div>
                <div class="col-5"> </div>
            </div>

            <div class="row cl">
                <label class="form-label col-2">标签颜色：</label>
                <div class="formControls col-5">
                    <select class="select" name="tabColor">
                        <option value="0">请选择</option>
                        @foreach(App\Models\PhoneShowTabColor::all() as $tabColor)
                            @if($show->details_class == $tabColor->id)
                                <option value="{{ $tabColor->id }}" selected="selected">{{ $tabColor->name }}</option>
                            @else
                                <option value="{{ $tabColor->id }}">{{ $tabColor->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-5"> </div>
            </div>

            <div class="row cl">
                <label class="form-label col-2">商品图片：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text" value="{{ $show->image }}" name="image" placeholder="商品图片">
                </div>
                <div class="col-5"> </div>
            </div>

            <div class="row cl">
                <label class="form-label col-2">商品排序：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text" name="level" value="{{ $show->level }}" placeholder="商品排序" datatype="*1-16" nullmsg="排序不能为空" />
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