@extends('layouts.app')

@section('content')
    @guest
        <h1 class="text-center text-danger title"><i class="fa fa-minus-circle"></i></h1>
        <h3 class="text-danger text-center mb-5">Oops! Có vẻ bạn chưa đăng nhập để có thể thực thi tác vụ này!</h3>
        <div class="d-flex justify-content-center">
            <a class="btn btn-warning" href="{{route('login')}}"><i class="fa fa-sign-in"></i> Đăng nhập</a>
        </div>
    @else
        <div class="container border container-radius mt-5">
            <div class="row border-bottom bg-info text-white elem-radius">
                <div class="col-md-9 p-3 pr-0">
                    <span class="text-white"><i class="fa fa-info-circle"></i> Thông tin cá nhân</span>
                </div>
                <div class="col-md-3 p-2 pl-0 align-items-center">
                    <a class="btn text-white btn-hover" href="{{route('editProfile',['userid'=>$profileDetail->userid])}}"><i
                                class="fa fa-edit"></i> Cập nhật</a>
                    <a class="btn text-white btn-hover" href="{{route('home')}}"><i class="fa fa-reply"></i> Quay
                        lại</a>
                </div>
            </div>
            <div class="row h-100">
                <div class="col-md-3 pt-3 border-right">
                    <img src="{{asset('upload/'.$profileDetail->avatar)}}" class="img-thumbnail rounded mb-3">
                </div>
                <div class="col-md-9 mt-3">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th>Họ và tên:</th>
                            <td>{{$profileDetail->fullname}}</td>
                        </tr>
                        <tr>
                            <th>Ngày sinh:</th>
                            <td>{{$profileDetail->dob}}</td>
                        </tr>
                        <tr>
                            <th>Giới tính:</th>
                            <td>{{$profileDetail->sexual}}</td>
                        </tr>
                        <tr>
                            <th>Số CMND:</th>
                            <td>{{$profileDetail->IDcard}}</td>
                        </tr>
                        <tr>
                            <th>Điện thoại:</th>
                            <td>{{$profileDetail->phone}}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{Auth::user()->email}}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <td>{{$profileDetail->address.', '.$profileDetail->ward.', '.$profileDetail->district.', '.$profileDetail->province}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endguest
@endsection