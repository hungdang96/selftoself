@extends('layouts.app')

@section('content')
    <div class="container border container-radius">
        <div class="row border-bottom">
            <div class="col-md-10 pl-4 p-3 pr-0">
                <span class="m-2 ml-3 text-muted"><i class="fas fa-plus-circle"></i> Tạo ví cá nhân</span>
            </div>
            <div class="col-md-2 p-2 pl-0 align-items-end">
                <a class="btn btn-warning" href="{{route('listWallets',['userid'=> Auth::user()->userid])}}">
                    <i class="fas fa-reply"></i> Trở lại
                </a>
            </div>
        </div>
        <div class="row pt-5 pb-4">
            {!! Form::open(['route' => ['addWallet'],'method' => 'post','class' => "w-100"]) !!}
            {!! csrf_field() !!}
            <input type="text" class="form-control" value="{{Auth::user()->userid}}" hidden>
            <div class="form-group row">
                <label for="name" class="col-md-3 col-form-label text-right">Tên ví:</label>
                <div class="col-md-6">
                    <input type="text" id="name" class="form-control" name="name">
                </div>
            </div>
            <div class="form-group row">
                <label for="wallet_type" class="col-md-3 col-form-label text-right">Loại ví:</label>
                <div class="col-md-4">
                    <select id="wallet_type" name="wallet_type" class="form-control">
                        <option id="temp" value="">-- Loại ví --</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="money" class="col-md-3 col-form-label text-right">Số tiền ban đầu:</label>
                <div class="col-md-6">
                    <input type="text" id="money" class="form-control" name="money">
                </div>
            </div>
            <div class="form-group row">
                <label for="lowest_level" class="col-md-3 col-form-label text-right">Định mức thấp nhất:</label>
                <div class="col-md-6">
                    <input type="text" id="lowest_level" class="form-control" name="lowest_level">
                </div>
            </div>
            <input type="text" value="{{Auth::user()->userid}}" name="userid" hidden>
            <div class="form-group text-center mb-0">
                {!! Form::submit('Tạo ví',['class'=>'btn btn-primary mt-2']); !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/sweetalert2.js')}}"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "{{route('listWalletType',['webview' => 0])}}",
                data: '',
                type: 'get',
                success: function (res) {
                    res.data.map(function (val) {
                        console.log(res);
                        $("#wallet_type").append('<option value="' + val.id + '">' + val.wallet_type_name + '</option>');
                    });
                }
            });
            $('#wallet_type').click(function () {
                $('#temp').attr('disabled','disabled');
            });
        })
    </script>
@endsection