@extends('layouts.app')

@section('content')
    <div class="container border container-radius">
        <div class="row border-bottom">
            <span class="m-2 ml-3 text-muted"><i class="fa fa-user-plus"></i> Đăng ký tài khoản</span>
        </div>
        <div class="row p-5">
            {{ Form::open(['route' => ['register'],'method' => 'post','class'=>'w-100']) }}
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                <label for="email" class="col-md-3 col-form-label text-right">E-Mail:</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                <label for="password" class="col-md-3 col-form-label text-right">Mật khẩu:</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-3 col-form-label text-right control-label">Xác nhận mật
                    khẩu:</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control"
                           name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group {{ $errors->has('fullname') ? ' has-error' : '' }} row">
                <label for="email" class="col-md-3 col-form-label text-right control-label">Họ và tên:</label>

                <div class="col-md-6">
                    <input id="fullname" type="text" class="form-control" name="fullname"
                           value="{{ old('fullname') }}" required>

                    @if ($errors->has('fullname'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="sexual" class="col-md-3 col-form-label text-right control-label">Giới tính:</label>
                <div class="col-md-6" style="padding-top: .5em">
                    <input type="radio" class="radio-inline mr-1" name="sexual" value="Nam">Nam
                    <input type="radio" class="radio-inline mr-1 ml-4" name="sexual" value="Nữ">Nữ
                </div>
            </div>

            <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }} row">
                <label for="dob" class="col-md-3 col-form-label text-right">Ngày sinh:</label>
                <div class="col-md-9" style="margin-bottom: 2em">
                    <div class="row pl-3">
                        <div class="col-md-2 form" style="padding: 0px; margin-right: 1em;">
                            <select name="date" id="date" onchange="getDay()"
                                    class="form-control form-control-custom">
                                <option id="dayTitle" value="">Ngày</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding: 0px; margin-right: 1em;">

                            <select name="month" id="month" onchange="getDay()"
                                    class="form-control form-control-custom">
                                <option id="monthTitle" value="">Tháng</option>
                            </select>
                        </div>
                        <div class="col-md-2" style="padding: 0px; margin-right: 1em;">

                            <select name="year" id="year" onchange="getDay()"
                                    class="form-control form-control-custom">
                                <option id="yearTitle" value="">Năm</option>
                            </select>
                        </div>
                        <input id="dob" type="text" name="dob" hidden>
                        @if ($errors->has('dob'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <button type="submit" class="btn btn-success btn-custom">
                    Đăng ký
                </button>
            </div>
            {{Form::close()}}
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        for (var d = 1; d <= 31; d++) {
            var dsub = '';
            dstr = d.toString();
            if (dstr.length < 2) {
                dsub = dstr.substring(0);
                dstr = '0' + dsub;
            }
            $("#date").append('<option value="' + dstr + '">' + dstr + '</option>');
        }
        $("#date").click(function () {
            $("#dayTitle").remove();
        });

        for (var m = 1; m <= 12; m++) {
            var msub = '';
            mstr = m.toString();
            if (mstr.length < 2) {
                msub = mstr.substring(0);
                mstr = '0' + msub;
            }
            $("#month").append('<option value="' + mstr + '">' + mstr + '</option>');
        }
        $("#month").click(function () {
            $("#monthTitle").remove();
        });
        var yearCurrent = new Date().getFullYear();
        for (var y = 1970; y <= yearCurrent; y++) {
            var ysub = '';
            ystr = y.toString();
            if (ystr.length < 2) {
                ysub = ystr.substring(0);
                ystr = '0' + ysub;
            }
            $("#year").append('<option value="' + ystr + '">' + ystr + '</option>');
        }
        $("#year").click(function () {
            $("#yearTitle").remove();
        });

        function getDay() {
            var dayVal = $("#date").val();
            var monthVal = $("#month").val() + '-';
            var yearVal = $("#year").val() + '-';
            $("#dob").attr('value', yearVal + monthVal + dayVal);
        }
    </script>
@endsection
