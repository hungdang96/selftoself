<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistrictModel extends Model
{
    public $incrementing = false;
    protected $table = 'districts';
    protected $fillable = [
        'district_id',
        'name',
        'type',
        'city_id'
    ];
    protected $guarded = 'district_id';

    public $timestamps = false;
}
