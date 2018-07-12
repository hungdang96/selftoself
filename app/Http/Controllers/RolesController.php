<?php

namespace App\Http\Controllers;

use App\RolesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{
    //Role list
    public function roles_list(){
        $data = RolesModel::all();
        return ['status' => 'sucees', 'data' => $data];
//        return view('admin.roles.list', compact($data));
    }

    //Role create
    public function role_create(Request $request){
        $validator = Validator::make($request->all(),[
            'role_name' => 'required'
        ],[
            'role_name.required' => 'Tên role không được để trống!'
        ]);
        if($validator->fails()){
            return ['status' => false, 'message' => $validator->errors()->all()];
        }

        $role_name = $request->role_name;
        RolesModel::create([
            'role_name' => $role_name
        ]);

        return ['status' => 'sucees', 'message' => 'Tạo role thành công!'];
    }
}
