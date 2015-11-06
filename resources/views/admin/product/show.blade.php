@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>商品列表</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/product/create') }}" class="btn btn-secondary radius mt-10">添加</a></div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table table-border table-bordered table-striped mt-20">
            <thead>
            <tr>
                <th class="col1">ID</th>
                <th class="col2">名称</th>
                <th>底价</th>
                <th>SKU数量</th>
                <th class="col3">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td class="col1">{{ $product->id }}</td>
                    <td class="col2">{{ $product->name }}</td>
                    <td>{{ $product->show_price }}</td>
                    <td>{{ App\Models\PhoneSku::where(['product_id' => $product->id])->count() }}</td>
                    <td class="col3">
                        <a href="{{ url('admin/product/sku/show') }}/{{ $product->id }}">SKU管理</a>
                        &nbsp;|&nbsp;
                        <a href="{{ url('admin/product/edit') }}/{{ $product->id }}">编辑</a>
                        &nbsp;|&nbsp;
                        <a href="{{ url('admin/product/delete') }}/{{ $product->id }}">删除</a>
                    </td>
                </tr>
            @endforeach
            @if($products->count() >= 10)
                <tr>
                    <td colspan="3"><?php echo $products->render(); ?></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection