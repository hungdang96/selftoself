<?php

namespace App\Http\Controllers;

use App\ProfilesModel;
use Carbon\Carbon;
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
        $data = ProfilesModel::select('profile.*','cities.name as city','districts.name as district','wards.name as ward')
                ->where('userid', $userid)
                ->leftjoin('cities','city_id','=','profile.provinceid')
                ->leftjoin('districts','district_id', '=', 'profile.districtid')
                ->leftjoin('wards','ward_id', '=', 'profile.wardid')
                ->first();
        $data = json_decode($data);
        $collection = collect([
            'date'=>Carbon::parse($data->dob)->format('d'),
            'month'=>Carbon::parse($data->dob)->format('m'),
            'year'=>Carbon::parse($data->dob)->format('Y')
        ]);
        $dataCollection = collect($data);
        $data = $dataCollection->merge($collection);
        $data = json_decode(json_encode($data));
        return view('content.profile.edit', compact('data',$data));
    }

    //Update profile
    public function profile_update($userid, array $data){
        $validator = Validator::make($data->all(),[
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

        $avatar = $data['avatar'];
        $fullname = $data['fullname'];
        $dob = $data['dob'];
        $sexual = $data['sexual'];
        $IDcard = $data['IDcard'];
        $phone = $data['phone'];
        $address = $data['address'];
        $provinceid = $data['provinceid'];
        $districtid = $data['districtid'];
        $wardid = $data['wardid'];

        ProfilesModel::where('userid',$userid)
            ->update([
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
