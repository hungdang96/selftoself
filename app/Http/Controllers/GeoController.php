<?php

namespace App\Http\Controllers;

use App\CityModel;
use App\DistrictModel;
use App\WardModel;
use Illuminate\Http\Request;

class GeoController extends Controller
{
    //List of cities
    public function cities_list(){
        $cities = CityModel::select('city_id','name')->get();
        return ['status' => true, 'cities' => $cities];
    }

    //List of districts
    public function districts_list($city_id){
        $districts = DistrictModel::select('district_id','name')
                        ->where('city_id', $city_id)
                        ->get();
        return ['status' => true, 'districts' => $districts];
    }

    //List of wards
    public function wards_list($district_id){
        $wards = WardModel::select('ward_id','name')
                ->where('district_id', $district_id)
                ->get();
        return ['status' => true, 'wards' => $wards];
    }
}
