@extends('home.base')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/shipping.create.css') }}"/>
@endsection
@section('js')
    <script src="{{ asset('js/Address.js') }}"></script>
@endsection
@section('content')
@if(Illuminate\Support\Facades\Input::get('msg', null))
    <div class="show-msg">{{ Illuminate\Support\Facades\Input::get('msg') }}</div>
@endif
<div class="address_add mlr20 ">
    <form action="" id="shipform" method="POST">
        <input name="_token" value="{{ csrf_token() }}" type="hidden"/>
        <div class="box box_01">
            <div class="title">
                <h3>收货人姓名</h3>
            </div>
            <div class="input">
                <input type="text" name="name" placeholder="请填写真实姓名" id="consignee" maxlength="15">
            </div>
        </div>
        <div class="box box_02">
            <div class="title">
                <h3>收货地址</h3>
            </div>
            <div class="box_02_01 h_box">
                <div class="flex_1">
                    <div data-type="select" class="select">
                        <div data-value="0" class="option" id="province">请选择省</div>
                        <select name="province" id="province_id"></select>
                    </div>
                </div>
                <div class="flex_1">
                    <div data-type="select" class="select">
                        <div data-value="0" class="option" id="city">请选择市</div>
                        <select name="city" id="city_id"></select>
                    </div>
                </div>
            </div>
            <div class="box_02_02">
                <div data-type="select" class="select">
                    <div data-value="0" class="option" id="district">请选择区</div>
                    <select name="district" id="district_id"></select>
                </div>
            </div>
            <div class="box_02_03">
                <div class="textarea">
                    <textarea name="address" placeholder="路名或街道地址，门牌号，不少于10个字" id="address" maxlength="120"></textarea>
                </div>
            </div>
        </div>
        <div class="box box_03">
            <div class="title">
                <h3>邮政编码</h3>
            </div>
            <div class="input">
                <input name="zipcode" placeholder="邮政编码,为6位数字" id="zipcode" type="tel" maxlength="6">
            </div>
        </div>
        <div class="box box_04">
            <div class="title">
                <h3>手机号码</h3>
            </div>
            <div class="input">
                <input name="tel" placeholder="联系人电话，11位数字" id="tel" type="tel" maxlength="11">
            </div>
        </div>
        <div class="box box_05">
            <a href="javascript:void(0);" class="button active_button" onclick="document.getElementById('shipform').submit();">确认完成</a>
        </div>
    </form>
</div>
<script>
    addressInit('province_id', 'city_id', 'district_id');
    $('#province_id').change(function(){
        var pname = $(this).val();
        $('#province').text(pname);
        var cname = $('#city_id').val();
        $('#city').text(cname);
        var dname = $('#district_id').val();
        $('#district').text(dname);
    });

    $('#city_id').change(function(){
        var cname = $(this).val();
        $('#city').text(cname);
    });
    $('#district_id').change(function(){
        var dname = $(this).val();
        $('#district').text(dname);
    });
</script>
@endsection