@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>

                    <div class="panel-body">
                        {!! Form::open(['route' => ['updateProfile',$data->userid],'method' => 'post','class' => "form-horizontal"]) !!}
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="avatar" class="col-md-4 control-label">Avatar:</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="col-md-4 control-label">Fullname:</label>
                            <div class="col-md-6">
                                <input type="text" id="avatar" class="form-control" value="{{$data->fullname}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dob" class="control-label col-md-4">Date of birth:</label>
                            <div class="col-md-6" style="padding-top: .5em">
                                <select name="date" id="date" onchange="getDay()">
                                    <option id="dayTitle" value="{{$data->date}}">{{$data->date}}</option>
                                </select> -
                                <select name="month" id="month" onchange="getDay()">
                                    <option id="monthTitle" value="{{$data->month}}">{{$data->month}}</option>
                                </select> -
                                <select name="year" id="year" onchange="getDay()">
                                    <option id="yearTitle" value="{{$data->year}}">{{$data->year}}</option>
                                </select>
                                <input id="dob" name="dob" value="{{$data->dob}}" hidden>
                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="idcard" class="control-label col-md-4">ID Card:</label>
                            <div class="col-md-6">
                                <input id="idcard" type="text" class="form-control" name="IDcard" value="{{$data->IDcard}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="control-label col-md-4">Phone:</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$data->phone}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-md-4">Address:</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{$data->address}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="control-label col-md-4">Province/city:</label>
                            <div class="col-md-6" style="padding-top: .5em">
                                <select id="cities" class="form-control" name="city_id">
                                    <option id="oldData" value="{{$data->provinceid}}">{{$data->city}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="district" class="control-label col-md-4">District:</label>
                            <div class="col-md-6" style="padding-top: .5em">
                                <select id="districts" class="form-control" name="district_id"></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ward" class="control-label col-md-4">Ward:</label>
                            <div class="col-md-6" style="padding-top: .5em">
                                <select id="wards" class="form-control" name="ward_id"></select>
                            </div>
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
                }
            });
            $("#cities").on('change',function () {
                var city_id = $('#cities').val();
                $('#districts').html('');
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
                    }
                });
                $("#districts").on('change',function () {
                    var district_id = $('#districts').val();
                    $('#wards').html('');
                    $.ajax({
                        url: "{{route('wardsList')}}",
                        type: "get",
                        data: 'district_id='+district_id,
                        success: function (wards) {
                            wards.data.map(function (val) {
                                var ward_id = val.ward_id;
                                var name = val.name;
                                $("#wards").append('<option value="' + ward_id + '">' + name + '</option>');
                            });
                        }
                    });
                })
            });
        });
    </script>
@endsection
