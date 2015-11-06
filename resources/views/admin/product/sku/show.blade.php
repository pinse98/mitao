@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>商品SKU列表</h3></div>
                <div class="col-6" style="text-align: right">
                    <a href="{{ url('admin/product/sku/create') }}/{{ $skus->pid }}" class="btn btn-secondary radius mt-10">添加</a>
                    <a href="{{ url('admin/product/show') }}" class="btn btn-secondary radius mt-10">返回</a>
                </div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table table-border table-bordered table-striped mt-20">
            <thead>
            <tr>
                <th>ID</th>
                <th>商品名称</th>
                <th>小图</th>
                <th>网络制式</th>
                <th>内存</th>
                <th>容量</th>
                <th>颜色</th>
                <th>价格</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($skus as $sku)
                <tr>
                    <td>{{ $sku->id }}</td>
                    <td>{{ App\Models\PhoneProduct::find($sku->product_id)? App\Models\PhoneProduct::find($sku->product_id)->name : null }}</td>
                    <td><img class="img" src="{{ App\Models\PhoneImage::find($sku->image_id) ? App\Models\PhoneImage::find($sku->image_id)->image : null }}" width="50px" height="50px"/></td>
                    <td>{{ App\Models\PhoneNetwork::find($sku->network_id) ? App\Models\PhoneNetwork::find($sku->network_id)->name : null }}</td>
                    <td>{{ App\Models\PhoneMemory::find($sku->memory_id) ? App\Models\PhoneMemory::find($sku->memory_id)->name : null }}</td>
                    <td>{{ App\Models\PhoneColor::find($sku->color_id) ? App\Models\PhoneColor::find($sku->color_id)->name : null}}</td>
                    <td>{{ App\Models\PhoneStorage::find($sku->storage_id) ? App\Models\PhoneStorage::find($sku->storage_id)->name : null}}</td>
                    <td>{{ $sku->price }}</td>
                    <td>
                        <a href="{{ url('admin/product/sku/edit') }}/{{ $skus->pid }}/{{ $sku->id }}">编辑</a>
                        &nbsp;|&nbsp;
                        <a href="{{ url('admin/product/sku/delete') }}/{{ $skus->pid }}/{{ $sku->id }}">删除</a>
                    </td>
                </tr>
            @endforeach
            @if($skus->count() >= 10)
                <tr>
                    <td colspan="3"><?php echo $skus->render(); ?></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection