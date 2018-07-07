<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    public $incrementing = false;

    protected $table = 'cities';
    protected $fillable = [
        'city_id',
        'name',
        'type'
    ];
    protected $guarded = 'city_id';
    public $timestamps = false;
}
