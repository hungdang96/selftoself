@extends('layouts.app')

@section('content')
    <div class="container border container-radius">
        <div class="row border-bottom">
            <span class="m-2 ml-3 text-muted"><i class="fa fa-sign-in"></i> Đăng nhập</span>
        </div>

        <div class="row p-5">
            {{ Form::open(['route' => ['login'],'method' => 'post','class'=>'w-100']) }}
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                <label for="email" class="col-md-3 col-form-label text-right">E-Mail:</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required
                           autofocus>

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
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
            </div>

            <div class="form-group row justify-content-center">
                    <button type="submit" class="btn btn-primary">
                        Đăng nhập
                    </button>

                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
            </div>
            {{Form::close()}}
        </div>
    </div>
@endsection
