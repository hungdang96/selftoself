@extends('layouts.app')

@section('content')
    <div class="container border container-radius mt-3">
        <div class="row border-bottom bg-info text-white elem-radius">
            <div class="col-md-10 pl-4 p-3 pr-0">
                <span class="text-white" style="font-size: 20px;"><i class="fas fa-wallet"></i> Ví của tôi</span>
            </div>
            <div class="col-md-2 p-2 pl-0 align-items-center">
                <a class="btn text-info btn-lg btn-hover bg-light" href="{{route('createWallet')}}"><i
                            class="fas fa-plus-circle"></i> Tạo ví</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 pt-3 mb-3">
                <div class="row border-bottom">
                    <div class="col-md-12">
                        <img src="" id="image" class="img-thumbnail rounded mb-3">
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-12">
                        <span id="fullname"></span>
                    </div>
                </div>
                <div class="row p-3 mt-2">
                    <div class="col-md-12">
                        <span id="dob"></span>
                    </div>
                </div>
                <div class="row p-3 mt-2">
                    <div class="col-md-12">
                        <span id="phone"></span>
                    </div>
                </div>
                <div class="row p-3 mt-2">
                    <div class="col-md-12">
                        <span id="email"><i class="fas fa-envelope mr-2"></i>{{Auth::user()->email}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-9 border-left">
                <table class="table table-striped">
                    <thead>
                    <th>STT</th>
                    <th>Tên ví</th>
                    <th>Tên ví</th>
                    <th>Tên ví</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection