@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>Sku小图列表</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/sku/image/create') }}" class="btn btn-secondary radius mt-10">添加</a></div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table table-border table-bordered table-striped mt-20">
            <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>图片</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($images as $image)
            <tr>
                <td>{{ $image->id }}</td>
                <td>{{ $image->name }}</td>
                <td><img src="{{ $image->image }}" width="50px" height="50px" /></td>
                <td>
                    <a href="{{ url('admin/sku/image/edit') }}/{{ $image->id }}">编辑</a>
                    &nbsp;|&nbsp;
                    <a href="{{ url('admin/sku/image/delete') }}/{{ $image->id }}">删除</a>
                </td>
            </tr>
            @endforeach
            @if($images->count() >= 10)
            <tr>
                <td colspan="3"><?php echo $images->render(); ?></td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection