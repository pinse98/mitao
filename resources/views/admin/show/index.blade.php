@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>首页排版列表</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/show/create') }}" class="btn btn-secondary radius mt-10">添加</a></div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table table-border table-bordered table-striped mt-20">
            <thead>
            <tr>
                <th>ID</th>
                <th>商品名称</th>
                <th>商品标签</th>
                <th>标签颜色</th>
                <th>商品图片</th>
                <th>商品排序</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @if(count($shows))
                @foreach($shows as $show)
                    <tr>
                        <td>{{ $show->id }}</td>
                        <td>{{ $show->product->name }}</td>
                        <td>{{ $show->details }}</td>
                        <td>
                            @if($show->details_class)
                                {{ $show->detailsClass->name }}
                            @endif
                        </td>
                        <td>
                            @if($show->image)
                            <img src="{{ $show->image }}" height="50px"/>
                            @endif
                        </td>
                        <td>{{ $show->level }}</td>
                        <td>
                            <a href="{{ url('admin/show/edit') }}/{{ $show->id }}">编辑</a>
                            &nbsp;|&nbsp;
                            <a href="{{ url('admin/show/delete') }}/{{ $show->id }}">删除</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            @if($shows->count() >= 10)
                <tr>
                    <td colspan="6"><?php echo $shows->render(); ?></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection