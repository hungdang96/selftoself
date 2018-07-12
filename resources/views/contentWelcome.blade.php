@extends('welcome')

@section('contentWelcome')
    <div class="jumbotron">
        <div class="title-welcome text-center text-muted">
            <span>Self2Sel</span>
        </div>
        <div class="sub-title text-center text-muted">
            Nơi kiểm soát và chia sẻ tâm trạng của bạn!
        </div>
        <div class="d-flex justify-content-center mt-3">
            <a class="btn btn-lg btn-success mr-2" href="{{route('login')}}"><i class="fa fa-sign-in"></i> Đăng nhập</a>
            <span class="pt-2" style="font-size: 15px;">hoặc</span>
            <a class="btn btn-lg btn-primary ml-2" href="{{route('register')}}"><i class="fa fa-user-plus"></i> Đăng ký</a>
        </div>
    </div>
@endsection