@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>商品SKU添加</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/product/sku/show') }}/{{ $sku->product_id }}" class="btn btn-secondary radius mt-10">返回</a></div>
            </div>
        </div>
        <div class="line"></div>
        <form action="" method="post" class="form form-horizontal responsive" id="demoform">
            <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
            <div class="row cl">
                <label class="form-label col-2">商品名称：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text disabled" placeholder="商品名称" value="{{ App\Models\PhoneProduct::find($sku->product_id)->name }}" readonly>
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">小图：</label>
                <div class="formControls col-5">
                    <select class="select" name="image">
                        <option value="0">请选择</option>
                        @foreach(App\Models\PhoneImage::all() as $image)
                            @if($sku->image_id == $image->id)
                                <option value="{{ $image->id }}" selected>{{ $image->name }}</option>
                            @else
                                <option value="{{ $image->id }}">{{ $image->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">网络制式：</label>
                <div class="formControls col-5">
                    <select class="select" name="network">
                        <option value="0">请选择</option>
                        @foreach(App\Models\PhoneNetwork::all() as $network)
                            @if($sku->network_id == $network->id)
                                <option value="{{ $network->id }}" selected>{{ $network->name }}</option>
                            @else
                                <option value="{{ $network->id }}">{{ $network->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">内存：</label>
                <div class="formControls col-5">
                    <select class="select" name="memory">
                        <option value="0">请选择</option>
                        @foreach(App\Models\PhoneMemory::all() as $memory)
                            @if($sku->memory_id == $memory->id)
                                <option value="{{ $memory->id }}" selected>{{ $memory->name }}</option>
                            @else
                                <option value="{{ $memory->id }}">{{ $memory->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">颜色：</label>
                <div class="formControls col-5">
                    <select class="select" name="color">
                        <option value="0">请选择</option>
                        @foreach(App\Models\PhoneColor::all() as $color)
                            @if($sku->color_id == $color->id)
                                <option value="{{ $color->id }}" selected>{{ $color->name }}</option>
                            @else
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">容量：</label>
                <div class="formControls col-5">
                    <select class="select" name="storage">
                        <option value="0">请选择</option>
                        @foreach(App\Models\PhoneStorage::all() as $storage)
                            @if($sku->storage_id == $storage->id)
                                <option value="{{ $storage->id }}" selected>{{ $storage->name }}</option>
                            @else
                                <option value="{{ $storage->id }}">{{ $storage->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-5"> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-2">价格：</label>
                <div class="formControls col-5">
                    <input type="text" class="input-text" name="price" value="{{ $sku->price }}" placeholder="输入商品价格" datatype="*1-16" nullmsg="价格不能为空" />
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