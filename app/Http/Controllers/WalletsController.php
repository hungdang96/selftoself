<?php

namespace App\Http\Controllers;

use App\WalletsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalletsController extends Controller
{
    //List wallets
    public function wallet_list($userid){
        $wallets = WalletsModel::select('wallet_id','name','money','created_at')
                    ->where('userid', $userid)
                    ->where('status', 1)
                    ->get();
//        return view('content.wallet.list',compact($wallets));
        return ['status' => true, 'data' => $wallets];
    }

    //Wallet detail
    public function wallet_detail($wallet_id){
        $walletDetail = WalletsModel::find($wallet_id);
//        return view('content.wallet.detail', compact($walletDetail));
        return ['status' => true, 'data' => $walletDetail];
    }

    //Create wallet
    public function wallet_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lowest_level' => 'required',
            'wallet_type' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập vào tên ví',
            'lowest_level.required' => 'Vui lòng nhập định mức tiền thấp nhất!',
            'wallet_type.required' => 'Vui lòng chọn loại ví!'
        ]);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->all()];
        }
        $wallet_id = Controller::GUID();
        $name = $request->name;
        $userid = $request->userid;
        $money = $request->money;
        $lowest_level = $request->lowest_level;
        $wallet_type = $request->wallet_type;
        $status = 1;

        WalletsModel::create([
           'wallet_id' => $wallet_id,
           'name' => $name,
           'userid' => $userid,
           'money' => $money,
           'lowest_level' => $lowest_level,
           'wallet_type' => $wallet_type,
           'status' => $status
        ]);
        return ['status' => true, 'message' => 'Tạo ví thành công!'];
    }

    //Add money to wallet
    public static function handle_money_wallet($wallet_id, Request $request){
        $userid = $request->userid;
        $money_old = WalletsModel::select('money')
                        ->where('wallet_id',$wallet_id)
                        ->where('userid', $userid)
                        ->first();
        $money_new = $request->money;
        if($request->type = 2){
            $money_new = -$request->money;
        }
        $total_money = $money_old + $money_new;
        WalletsModel::where('wallet_id', $wallet_id)
            ->where('userid', $userid)
            ->update([
                'money' => $total_money
            ]);
        return ['status' => true, 'message' => 'Đã cập nhật số tiền trong ví!'];
    }

    //Edit wallet
    public function wallet_edit($wallet_id){
        $data = WalletsModel::find($wallet_id);
        return view('content.wallet.edit',compact($data));
    }

    //Update wallet
    public function wallet_upate($wallet_id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lowest_level' => 'required',
            'wallet_type' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập vào tên ví',
            'lowest_level.required' => 'Vui lòng nhập định mức tiền thấp nhất!',
            'wallet_type.required' => 'Vui lòng chọn loại ví!'
        ]);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->all()];
        }
        $userid = $request->userid;
        $name = $request->name;
        $money = $request->money;
        $lowest_level = $request->lowest_level;
        $wallet_type = $request->wallet_type;
        $status = 1;

        WalletsModel::where('wallet_id', $wallet_id)
        ->where('userid',$userid)
        ->update([
            'name' => $name,
            'money' => $money,
            'lowest_level' => $lowest_level,
            'wallet_type' => $wallet_type,
            'status' => $status
        ]);
        return ['status' => true, 'message' => 'Cập nhật ví thành công!'];
    }

    public function wallet_delete($wallet_id){
        $data = WalletsModel::find($wallet_id);
        if(isset($data)){
            $data->update([
                'status' => 0
            ]);
            return ['status' => true, 'message' => 'Đã xóa ví '.$data->name];
        }
        else{
            return ['status' => false, 'message' => 'Không tìm thấy ví '.$data->name];
        }
    }
}
