<?php

namespace App\Http\Controllers;

use App\WalletTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WalletTypeController extends Controller
{
    //List Wallet type
    public function wallet_type_list($webview)
    {
        $data = WalletTypeModel::get();
        if ($webview == 1) {
            return view('admin.walletType.list', compact('data'));
        }
        else{
            return ['status' => 'success', 'data' => $data];
        }
    }

    //Wallet type create
    public function wallet_type_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wallet_type_name' => 'required | unique:wallet_type'
        ],
            [
                'wallet_type_name.required' => 'Vui lòng nhập tên loại ví!',
                'wallet_type_name.unique' => 'Tên loại ví đã tồn tại!'
            ]);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->all()];
        }
        $wallet_type_name = $request->wallet_type_name;
        WalletTypeModel::create([
            'wallet_type_name' => $wallet_type_name
        ]);
        return ['status' => 'sucees', 'message' => 'Tạo loại ví thành công!'];
    }

    //Edit wallet type
    public function wallet_type_edit($id)
    {
        $wallet_type = WalletTypeModel::find($id);
        return view('admin.walletType.edit', compact('wallet_type', $wallet_type));
    }

    //Update wallet type
    public function wallet_type_update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wallet_type_name' => [
                'required',
                Rule::unique('wallet_type')->ignore($id)]
        ], [
            'wallet_type_name.required' => 'Vui lòng nhập tên loại ví',
            'wallet_type_name.unique' => 'Tên ví đã tồn tại!'
        ]);
        if ($validator->fails()) {
            return ['status' => false, 'message' => $validator->errors()->all()];
        }
        WalletTypeModel::where('id', $request->id)
            ->update([
                'wallet_type_name' => $request->wallet_type_name
            ]);
        return ['status' => 'sucees', 'message' => 'Cập nhật thành công!'];
    }
}
