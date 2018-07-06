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
    
}
