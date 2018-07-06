<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    ////********************** Hàm tạo guid **********************////
    public static function GUID(){
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    public static function getMonthYear(){
        $now = Carbon::now(new DateTimeZone('Asia/Ho_Chi_Minh'));
        $month = $now->format('m');
        $year = $now->year;
        return ['month' => $month, 'year' => $year];
    }
}
