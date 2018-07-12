@extends('layouts.app')

@section('content')
    @guest
        <h1 class="text-center text-danger title"><i class="fa fa-minus-circle"></i></h1>
        <h3 class="text-danger text-center mb-5">Oops! Có vẻ bạn chưa đăng nhập để có thể thực thi tác vụ này!</h3>
        <div class="d-flex justify-content-center">
            <a class="btn btn-warning" href="{{route('login')}}"><i class="fa fa-sign-in"></i> Đăng nhập</a>
        </div>
    @else
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
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên ví</th>
                        <th class="text-center">Loại ví</th>
                        <th class="text-center">Số tiền</th>
                        <th class="text-center">Thời điểm tạo</th>
                        <th class="text-center">Trạng thái</th>
                        </thead>
                        <tbody>
                        <?php $i = 1 ?>
                        @foreach($data as $item)
                            <tr>
                                <td class="text-center">{{$i}} <?php $i++ ?></td>
                                <td class="text-center">
                                    <a class="wallet-name" href="{{route('detailWallet',['wallet_id' => $item->wallet_id])}}">{{$item->name}}</a>
                                </td>
                                <td class="text-center">{{$item->wallet_type}}</td>
                                <td class="text-center">
                                    {{number_format($item->money,0,',','.')}}
                                </td>
                                <td class="text-center">{{$item->date_created}}</td>
                                <td class="text-center">
                                    @if($item->status == '1')
                                        <span><i class="fas fa-check-circle text-success"></i></span>
                                    @elseif($item->status == '2')
                                        <span><i class="fas fa-exclamation-triangle text-warning"></i></span>
                                    @else
                                        <span><i class="fas fa-exclamation-triangle text-danger"></i></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endguest
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{route('profileDetail',['user_id' => Auth::user()->userid,'webView' => 0])}}",
                data: "webView = 1",
                type: "get",
                success: function (res) {
                    console.log(res);
                    var pathSys = "{{asset('upload/')}}";
                    var fullPath = pathSys + "/" + res.profileDetail['avatar'];
                    $('#image').attr('src', fullPath);
                    $('#fullname').append('<i class="fas fa-user mr-2"></i>' + res.profileDetail['fullname']);
                    $('#dob').append('<i class="fas fa-birthday-cake mr-2"></i>' + res.profileDetail['dob']);
                    $('#phone').append('<i class="fas fa-phone mr-2"></i>' + res.profileDetail['phone']);
                }
            });
        })
    </script>
@endsection