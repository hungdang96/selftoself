@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

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

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Your full name:</label>

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

                            <div class="form-group">
                                <label for="sexual" class="col-md-4 control-label">Sexual:</label>
                                <div class="col-md-6" style="padding-top: .5em">
                                    <input type="radio" class="radio-inline" name="sexual" value="Nam" checked>Male
                                    <input type="radio" class="radio-inline" name="sexual" value="Nữ">Female
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                                <label for="dob" class="col-md-4 control-label">Date of birth:</label>
                                <div class="col-md-6" style="padding-top: .5em">
                                    <select name="date" id="date" onchange="getDay()">
                                        <option id="dayTitle" value="">-Date-</option>
                                    </select> -
                                    <select name="month" id="month" onchange="getDay()">
                                        <option id="monthTitle" value="">-Month-</option>
                                    </select> -
                                    <select name="year" id="year" onchange="getDay()">
                                        <option id="yearTitle" value="">-Year-</option>
                                    </select>
                                    <input id="dob" type="text" class="form-control" name="dob" hidden>
                                    @if ($errors->has('dob'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        for (var d = 1; d <= 31; d++){
            var dsub = '';
            dstr = d.toString();
            if(dstr.length < 2){
                dsub = dstr.substring(0);
                dstr = '0'+dsub;
            }
            $("#date").append('<option value="'+dstr+'">' + dstr + '</option>');
        }
        $("#date").click(function () {
            $("#dayTitle").remove();
        });

        for (var m = 1; m <= 12; m++){
            var msub = '';
            mstr = m.toString();
            if(mstr.length < 2){
                msub = mstr.substring(0);
                mstr = '0'+msub;
            }
            $("#month").append('<option value="'+mstr+'">' + mstr + '</option>');
        }
        $("#month").click(function () {
            $("#monthTitle").remove();
        });
        var yearCurrent = new Date().getFullYear();
        for (var y = 1970; y <= yearCurrent; y++){
            var ysub = '';
            ystr = y.toString();
            if(ystr.length < 2){
                ysub = ystr.substring(0);
                ystr = '0'+ysub;
            }
            $("#year").append('<option value="'+ystr+'">' + ystr + '</option>');
        }
        $("#year").click(function () {
            $("#yearTitle").remove();
        });
        function getDay() {
            var dayVal = $("#date").val();
            var monthVal = $("#month").val()+'-';
            var yearVal = $("#year").val()+'-';
            $("#dob").attr('value',yearVal+monthVal+dayVal);
        }
    </script>
@endsection
