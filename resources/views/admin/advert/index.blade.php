@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>首页广告列表</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/advert/create') }}" class="btn btn-secondary radius mt-10">添加</a></div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table table-border table-bordered table-striped mt-20">
            <thead>
            <tr>
                <th>ID</th>
                <th>广告名称</th>
                <th>广告图片</th>
                <th>广告链接</th>
                <th>广告排序</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @if(count($adverts))
                @foreach($adverts as $advert)
                    <tr>
                        <td>{{ $advert->id }}</td>
                        <td>{{ $advert->name }}</td>
                        <td>
                            @if($advert->image)
                                <img src="{{ $advert->image }}" height="50px"/>
                            @endif
                        </td>
                        <td>{{ $advert->url }}</td>
                        <td>{{ $advert->level }}</td>
                        <td>
                            <a href="{{ url('admin/advert/edit') }}/{{ $advert->id }}">编辑</a>
                            &nbsp;|&nbsp;
                            <a href="{{ url('admin/advert/delete') }}/{{ $advert->id }}">删除</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            @if($adverts->count() >= 10)
                <tr>
                    <td colspan="6"><?php echo $adverts->render(); ?></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection