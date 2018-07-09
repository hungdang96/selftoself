@extends('layouts.app')

@section('content')
    <div class="container border container-radius" onload="construct()">
        <div class="row border-bottom">
            <span class="m-2 ml-3 text-muted"><i class="fa fa-edit"></i> Cập nhật thông tin</span>
        </div>
        <div class="row p-3">
            {{ Form::open(['route' => ['updateProfile',$data->userid],'method' => 'post','class' => "w-100"]) }}
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="avatar" class="col-md-3 col-form-label text-right">Ảnh đại diện:</label>
                <div class="col-md-6">
                    <img src="{{asset('upload/'.$data->avatar)}}" class="img-circle avatar" alt="avatar">
                    <input type="file" class="form-control" value="{{$data->avatar}}">
                    <input type="text" class="form-control" value="{{$data->avatar}}" name="avatar" hidden>
                </div>
            </div>

            <div class="form-group row">
                <label for="avatar" class="col-md-3 col-form-label text-right">Họ và tên:</label>
                <div class="col-md-6">
                    <input type="text" id="fullname" class="form-control" value="{{$data->fullname}}"
                           name="fullname">
                </div>
            </div>
            <div class="form-group row">
                <label for="dob" class="col-form-label col-md-3 text-right">Ngày sinh:</label>
                <div class="col-md-9">
                    <div class="row pl-3">
                        <div class="col-md-1" style="padding: 0px; margin-right: 1em;">
                            <select name="date" id="date" class="form-control" onchange="getDay()">
                                <option id="dayTitle" value="{{$data->date}}">{{$data->date}}</option>
                            </select>
                        </div>
                        <div class="col-md-1" style="padding: 0px; margin-right: 1em;">
                            <select name="month" id="month" class="form-control" onchange="getDay()">
                                <option id="monthTitle" value="{{$data->month}}">{{$data->month}}</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding: 0px; margin-right: 1em;">
                            <select name="year" id="year" class="form-control form-control-year" onchange="getDay()">
                                <option id="yearTitle" value="{{$data->year}}">{{$data->year}}</option>
                            </select>
                        </div>
                    </div>
                    <input id="dob" name="dob" value="{{$data->dob}}" hidden>
                    @if ($errors->has('dob'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="sexual" class="col-md-3 col-form-label text-right">Giới tính:</label>
                <div class="col-md-6" style="padding-top: .5em">
                    @if($data->sexual == 'Nam')
                        <input type="radio" class="radio-inline mr-1" name="sexual" value="Nam" checked>Nam
                        <input type="radio" class="radio-inline mr-1 ml-4" name="sexual" value="Nữ">Nữ
                    @else
                        <input type="radio" class="radio-inline mr-1" name="sexual" value="Nam">Nam
                        <input type="radio" class="radio-inline mr-1 ml-4" name="sexual" value="Nữ" checked>Nữ
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="idcard" class="col-form-label col-md-3 text-right">Số CMND:</label>
                <div class="col-md-6">
                    <input id="idcard" type="text" class="form-control" name="IDcard"
                           value="{{$data->IDcard}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-form-label col-md-3 text-right">Số điện thoại:</label>
                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control" name="phone"
                           value="{{$data->phone}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-form-label col-md-3 text-right">Địa chỉ:</label>
                <div class="col-md-6">
                    <input id="address" type="text" class="form-control" value="{{$data->address}}" name="address">
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-form-label col-md-3 text-right">Tỉnh/Tp:</label>
                <div class="col-md-4">
                    <select id="cities" class="form-control" name="provinceid">
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="district" class="col-form-label col-md-3 text-right">Quận/Huyện:</label>
                <div class="col-md-4">
                    <select id="districts" class="form-control" name="districtid">
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="ward" class="col-form-label col-md-3 text-right">Xã/Phường:</label>
                <div class="col-md-4">
                    <select id="wards" class="form-control" name="wardid">
                    </select>
                </div>
            </div>
            <div class="form-group text-center">
                {!! Form::submit('Cập nhật',['class'=>'btn btn-primary btn-custom']); !!}
                <a href="{{route('profileDetail',['userid'=>$data->userid])}}"
                   class="btn btn-warning btn-custom">Quay lại</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/dateHandling.js')}}"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{route('full_address')}}",
                data: 'provinceid={{$data->provinceid}}&districtid={{$data->districtid}}&wardid={{$data->wardid}}',
                type: "get",
                success: function (res) {
                    console.log(res);
                    res.province.map(function (val) {
                        $("#cities").append('<option value="' + val.city_id + '">' + val.name + '</option>');
                    });
                    res.district.map(function (val) {
                        $("#districts").append('<option value="' + val.district_id + '">' + val.name + '</option>');
                    });
                    res.ward.map(function (val) {
                        $("#wards").append('<option value="' + val.ward_id + '">' + val.name + '</option>');
                    });
                    $('#cities').val({{$data->provinceid}});
                    $('#districts').val({{$data->districtid}});
                    $('#wards').val({{$data->wardid}});
                }
            });
            $("#cities").on('change', function () {
                var city_id = $('#cities').val();
                $("#districts").html('');
                $("#wards").html('');
                $.ajax({
                    url: "{{route('districtsList')}}",
                    type: "get",
                    data: 'city_id=' + city_id,
                    success: function (districts) {
                        console.log(districts.data);
                        districts.data.map(function (val) {
                            var district_id = val.district_id;
                            var name = val.name;
                            $("#districts").append('<option value="' + district_id + '">' + name + '</option>');
                        });
                        var district_id = $('#districts').val();
                        $.ajax({
                            url: "{{route('wardsList')}}",
                            type: "get",
                            data: 'district_id=' + district_id,
                            success: function (wards) {
                                wards.data.map(function (val) {
                                    var ward_id = val.ward_id;
                                    var name = val.name;
                                    $("#wards").append('<option value="' + ward_id + '">' + name + '</option>');
                                });
                            }
                        });
                    }
                });
            });

            $("#districts").on('change', function () {
                var district_id = $('#districts').val();
                $("#wards").html('');
                $.ajax({
                    url: "{{route('wardsList')}}",
                    type: "get",
                    data: 'district_id=' + district_id,
                    success: function (wards) {
                        wards.data.map(function (val) {
                            var ward_id = val.ward_id;
                            var name = val.name;
                            $("#wards").append('<option value="' + ward_id + '">' + name + '</option>');
                        });
                    }
                });
            });

            $('#wards').on('click', function () {
                $('#tempWard').removeAttr('selected');
                $('#tempWard').attr('disabled', 'disabled');
            })

        });
    </script>
@endsection
