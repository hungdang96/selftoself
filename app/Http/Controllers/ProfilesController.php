<?php

namespace App\Http\Controllers;

use App\ProfilesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfilesController extends Controller
{
    //Show profile details
    public function profile_detail($userid){
        $profile = ProfilesModel::where('userid', $userid)
                ->first();
//        return view('content.profile.show_info',compact($profile));
        return ['status' => true, 'data' => $profile];
    }

    //create profile
    public static function profile_create($userid, array $data){
        $avatar = $IDcard = $phone  = $address = $provinceid = $districtid = $wardid = '';
        $fullname = $data['fullname'];
        $dob = $data['dob'];
        $sexual = $data['sexual'];

        ProfilesModel::create([
            'avatar' => $avatar,
            'fullname' => $fullname,
            'dob' => $dob,
            'sexual' => $sexual,
            'userid' => $userid,
            'IDcard' => $IDcard,
            'phone' => $phone,
            'address' => $address,
            'provinceid' => $provinceid,
            'districtid' => $districtid,
            'wardid' => $wardid,
        ]);
        return ['status' => true, 'message' => 'Success!!!'];
    }

    //Edit profile
    public function profile_edit($userid){
        $data = ProfilesModel::where('userid', $userid)
                ->first();
        return view('content.profile.edit', compact($data));
    }

    //Update profile
    public function profile_update($userid, Request $request){
        $validator = Validator::make($request->all(),[
            'fullname' => 'required',
            'dob' => 'required',
            'sexual' => 'required',
            'IDcard' => 'required | unique:profile',
            'phone' => 'required | unique:profile'
        ],[
            'fullname.required' => 'Họ tên không được để trống!',
            'dob.required' => 'Vui lòng chọn ngày/tháng/năm sinh!',
            'sexual.required' => 'Vui lòng chọn giới tính!',
            'IDcard.required' => 'Vui lòng nhập số CMND!',
            'IDcard.unique' => 'Số CMND bị trùng!',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại!'
        ]);
        if($validator->fails()){
            return ['status' => false, 'message' => $validator->errors()->all()];
        }

        $avatar = $request->avatar;
        $fullname = $request->fullname;
        $dob = $request->dob;
        $sexual = $request->sexual;
        $userid = $request->userid;
        $IDcard = $request->IDcard;
        $phone = $request->phone;
        $address = $request->address;
        $provinceid = $request->provinceid;
        $districtid = $request->districtid;
        $wardid = $request->wardid;

        ProfilesModel::create([
            'avatar' => $avatar,
            'fullname' => $fullname,
            'dob' => $dob,
            'sexual' => $sexual,
            'IDcard' => $IDcard,
            'phone' => $phone,
            'address' => $address,
            'provinceid' => $provinceid,
            'districtid' => $districtid,
            'wardid' => $wardid,
        ]);
        return ['status' => true, 'message' => 'Success!!!'];
    }
}
