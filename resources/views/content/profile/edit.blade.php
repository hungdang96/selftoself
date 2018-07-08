@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Cập nhật hồ sơ</div>

                    <div class="panel-body">
                        {{ Form::open(['route' => ['updateProfile',$data->userid],'method' => 'post','class' => "form-horizontal"]) }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="avatar" class="col-md-4 control-label">Ảnh đại diện:</label>
                            <div class="col-md-6">
                                <img src="{{asset('upload/'.$data->avatar)}}" class="img-circle avatar" alt="avatar">
                                <input type="text" class="form-control" value="{{$data->avatar}}" name="avatar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="col-md-4 control-label">Họ và tên:</label>
                            <div class="col-md-6">
                                <input type="text" id="fullname" class="form-control" value="{{$data->fullname}}"
                                       name="fullname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="control-label col-md-4">Ngày sinh:</label>
                            <div class="col-md-6">
                                <div class="col-md-3" style="padding: 0px; margin-right: 1em;">
                                    <select name="date" id="date" class="form-control" onchange="getDay()">
                                        <option id="dayTitle" value="{{$data->date}}">{{$data->date}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="padding: 0px; margin-right: 1em;">
                                    <select name="month" id="month" class="form-control" onchange="getDay()">
                                        <option id="monthTitle" value="{{$data->month}}">{{$data->month}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="padding: 0px; margin-right: 1em;">
                                    <select name="year" id="year" class="form-control" onchange="getDay()">
                                        <option id="yearTitle" value="{{$data->year}}">{{$data->year}}</option>
                                    </select>
                                </div>
                                <input id="dob" name="dob" value="{{$data->dob}}" hidden>
                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sexual" class="col-md-4 control-label">Giới tính:</label>
                            <div class="col-md-6" style="padding-top: .5em">
                                @if($data->sexual == 'Nam')
                                    <input type="radio" class="radio-inline" name="sexual" value="Nam" checked>Nam
                                    <input type="radio" class="radio-inline" name="sexual" value="Nữ">Nữ
                                @else
                                    <input type="radio" class="radio-inline" name="sexual" value="Nam">Nam
                                    <input type="radio" class="radio-inline" name="sexual" value="Nữ" checked>Nữ
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="idcard" class="control-label col-md-4">Số CMND:</label>
                            <div class="col-md-6">
                                <input id="idcard" type="text" class="form-control" name="IDcard"
                                       value="{{$data->IDcard}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="control-label col-md-4">Số điện thoại:</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone"
                                       value="{{$data->phone}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-md-4">Địa chỉ:</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" value="{{$data->address}}" name="address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="control-label col-md-4">Tỉnh/Tp:</label>
                            <div class="col-md-4">
                                <select id="cities" class="form-control" name="provinceid">
                                    <option id="tempProvince" selected>-- Tỉnh/Tp --</option>
                                    <option hidden></option>
                                </select><span class="text-muted">Hiện tại: {{$data->city}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="district" class="control-label col-md-4">Quận/Huyện:</label>
                            <div class="col-md-4">
                                <select id="districts" class="form-control" name="districtid">
                                    <option id="tempDistrict">-- Quận/Huyện --</option>
                                </select><span class="text-muted">Hiện tại: {{$data->district}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ward" class="control-label col-md-4">Xã/Phường:</label>
                            <div class="col-md-4">
                                <select id="wards" class="form-control" name="wardid">
                                    <option id="tempWard">-- Xã/Phường --</option>
                                </select><span class="text-muted">Hiện tại: {{$data->ward}}</span>
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
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/dateHandling.js')}}"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{route('citiesList')}}",
                type: "get",
                success: function (cities) {
                    cities.data.map(function (val) {
                        var city_id = val.city_id;
                        var name = val.name;
                        $("#cities").append('<option value="' + city_id + '">' + name + '</option>');
                    });
                    $('#cities').on('click', function () {
                        $('#tempProvince').removeAttr('selected');
                        $('#tempProvince').attr('disabled', 'disabled');
                    })
                }
            });
            $("#cities").on('change', function () {
                var city_id = $('#cities').val();
                $("#districts").html('');
                $("#districts").append('<option id="tempDistrict">-- Quận/Huyện --</option>');
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
                        $('#districts').on('click', function () {
                            $('#tempDistrict').removeAttr('selected');
                            $('#tempDistrict').attr('disabled', 'disabled');
                        })
                    }
                });
                $("#districts").on('change', function () {
                    var district_id = $('#districts').val();
                    $("#wards").html('');
                    $("#wards").append('<option id="tempWard">-- Phường/Xã --</option>');
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
                            $('#wards').on('click', function () {
                                $('#tempWard').removeAttr('selected');
                                $('#tempWard').attr('disabled', 'disabled');
                            })
                        }
                    });
                })
            });
        });
    </script>
@endsection
