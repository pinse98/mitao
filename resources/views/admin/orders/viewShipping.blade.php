@extends('admin.base')
@section('content')
    <div class="Hui-wraper">
        <div class="responsive">
            <div class="row cl">
                <div class="col-6 left"><h3>查看物流</h3></div>
                <div class="col-6" style="text-align: right"><a href="{{ url('admin/orders/show') }}" class="btn btn-secondary radius mt-10">返回</a></div>
            </div>
        </div>
        <div class="line"></div>
        <table class="table table-border table-bordered table-striped mt-20">
            <thead>
            <tr>
                <th>{{ $name }}</th>
                <th>{{ $code }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($datas as $dataOne)
                <tr>
                    <td>{{ $dataOne['time'] }}</td>
                    <td>{{ $dataOne['context'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection