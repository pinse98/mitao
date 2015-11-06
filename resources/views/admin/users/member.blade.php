@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>用户列表</h3></div>
                {{--<div class="col-6" style="text-align: right"><a href="{{ url('admin/users/create') }}" class="btn btn-secondary radius mt-10">添加</a></div>--}}
            </div>
        </div>
        <div class="line"></div>
        <table class="table table-border table-bordered table-striped mt-20">
            <thead>
            <tr>
                <th>ID</th>
                <th>用户名</th>
            </tr>
            </thead>
            <tbody>
            @foreach($members as $member)
                <tr>
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->username }}</td>
                </tr>
            @endforeach
            @if($members->count() >= 10)
                <tr>
                    <td colspan="3"><?php echo $members->render(); ?></td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection