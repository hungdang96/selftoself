<?php

namespace App\Http\Controllers;

use App\CityModel;
use App\DistrictModel;
use App\WardModel;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    public function full_address(Request $request){
        $cities = CityModel::orderBy('name','ASC')->get();
        $districts = DistrictModel::select('district_id','name')
            ->where('city_id', $request->provinceid)
            ->get();
        $wards = WardModel::select('ward_id','name')
            ->where('district_id', $request->districtid)
            ->get();
        return ['status' => true, 'province' => $cities, 'district' => $districts, 'ward' => $wards];
    }
    //List of cities
    public function cities_list(){
        $cities = CityModel::orderBy('name','ASC')->get();
        return ['status' => true, 'data' => $cities];
    }

    //List of districts
    public function districts_list(Request $request){
        $districts = DistrictModel::select('district_id','name')
                        ->where('city_id', $request->city_id)
                        ->get();
        return ['status' => true, 'data' => $districts];
    }

    //List of wards
    public function wards_list(Request $request){
        $wards = WardModel::select('ward_id','name')
                ->where('district_id', $request->district_id)
                ->get();
        return ['status' => true, 'data' => $wards];
    }
}
