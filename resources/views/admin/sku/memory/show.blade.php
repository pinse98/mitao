@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>Sku内存列表</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/sku/memory/create') }}" class="btn btn-secondary radius mt-10">添加</a></div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table table-border table-bordered table-striped mt-20">
            <thead>
            <tr>
                <th class="col1">ID</th>
                <th class="col2">名称</th>
                <th class="col3">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($memorys as $memory)
            <tr>
                <td class="col1">{{ $memory->id }}</td>
                <td class="col2">{{ $memory->name }}</td>
                <td class="col3">
                    <a href="{{ url('admin/sku/memory/edit') }}/{{ $memory->id }}">编辑</a>
                    &nbsp;|&nbsp;
                    <a href="{{ url('admin/sku/memory/delete') }}/{{ $memory->id }}">删除</a>
                </td>
            </tr>
            @endforeach
            @if($memorys->count() >= 10)
            <tr>
                <td colspan="3"><?php echo $memorys->render(); ?></td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection