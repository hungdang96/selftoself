<?php

namespace App\Http\Controllers;

use App\ProfilesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProfilesController extends Controller
{
    //Show profile details
    public function profile_detail($userid, $webView){
        $profileDetail = ProfilesModel::select('profile.*','cities.name as province','districts.name as district','wards.name as ward')
            ->where('userid', $userid)
            ->leftjoin('cities','city_id','=','profile.provinceid')
            ->leftjoin('districts','district_id', '=', 'profile.districtid')
            ->leftjoin('wards','ward_id', '=', 'profile.wardid')
            ->first();
        $collection = collect($profileDetail);
        $date = Carbon::parse($collection['dob'])->format('d/m/Y');
        $collection['dob'] = $date;
        $profileDetail = json_decode(json_encode($collection));
        if($webView == 1){
            return view('content.profile.detail',compact('profileDetail',$profileDetail));
        }
        else{
            return ['status' => 'sucees', 'profileDetail' => $profileDetail];
        }
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
        return ['status' => 'sucees', 'message' => 'Success!!!'];
    }

    //Edit profile
    public function profile_edit($userid){
        $data = ProfilesModel::select('profile.*','cities.name as city','districts.name as district','wards.name as ward')
                ->where('userid', $userid)
                ->leftjoin('cities','city_id','=','profile.provinceid')
                ->leftjoin('districts','district_id', '=', 'profile.districtid')
                ->leftjoin('wards','ward_id', '=', 'profile.wardid')
                ->first();
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
    public function profile_update($userid, Request $request){
        $validator = Validator::make($request->all(),[
            'fullname' => 'required',
            'dob' => 'required',
            'sexual' => 'required',
            'IDcard' => 'required',
            'phone' => 'required'
        ],[
            'fullname.required' => 'Họ tên không được để trống!',
            'dob.required' => 'Vui lòng chọn ngày/tháng/năm sinh!',
            'sexual.required' => 'Vui lòng chọn giới tính!',
            'IDcard.required' => 'Vui lòng nhập số CMND!',
            'phone.required' => 'Vui lòng nhập số điện thoại',
        ]);
        if($validator->fails()){
            return ['status' => false, 'message' => $validator->errors()->all()];
        }

        $avatar = $request->avatar;
        $fullname = $request->fullname;
        $dob = $request->dob;
        $sexual = $request->sexual;
        $IDcard = $request->IDcard;
        $phone = $request->phone;
        $address = $request->address;
        $provinceid = $request->provinceid;
        $districtid = $request->districtid;
        $wardid = $request->wardid;

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
        return Redirect::route('profileDetail',['userid'=>$userid])->with(true,'Cập nhật thành công!');
    }
}
