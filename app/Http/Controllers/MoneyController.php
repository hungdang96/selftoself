<?php

namespace App\Http\Controllers;

use App\MoneyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MoneyController extends Controller
{
    //List of finance
    public function finance_list(Request $request){
        $where = ['userid','=',$request->userid];
        if($request->monthcheck){
            $where[] = ['monthcheck', '=', $request->monthcheck];
        }
        if($request->yearcheck){
            $where[] = ['yearcheck', '=', $request->yearcheck];
        }
        if($request->type){
            $where[] = ['type', '=', $request->type];
        }

        $financeList = MoneyModel::select('reason','money','created_at','updated_at')
                        ->where($where)->get();
//        return view('content.finance.list',compact($financeList));
        return ['status' => true, 'data' => $financeList];
    }

    //Add money
    public function money_create(Request $request){
        $validator = Validator::make($request->all(),[
            'reason' => 'required',
            'money' => 'required',
            'type' => 'required',
            'wallet_id' => 'required'
        ],[
            'reason.required' => 'Vui lòng nhập lí do!',
            'money.required' => 'Vui lòng nhập số tiền!',
            'type.required' => 'Vui lòng chọn hình thức tiền!',
            'wallet_id.required' => 'Vui lòng chọn ví!'
        ]);
        if($validator->fails()){
            return ['status' => false, 'message' => $validator->errors()->all()];
        }
        $userid = $request->userid;
        $reason = $request->reason;
        $money = $request->money;
        $type = $request->type;
        $monthcheck = Controller::getMonthYear()['month'];
        $yearcheck = Controller::getMonthYear()['year'];
        MoneyModel::create([
           'userid' => $userid,
           'reason' => $reason,
           'money' => $money,
           'type' => $type,
           'monthcheck' => $monthcheck,
           'yearcheck' => $yearcheck
        ]);
        $wallet_id = $request->wallet_id;
        WalletsController::handle_money_wallet($wallet_id, $request);
        return ['status' => true, 'message' => 'Xử lý thành công!'];
    }
}
