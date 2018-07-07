<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WardModel extends Model
{
    public $incrementing = false;
    protected $table = 'wards';
    protected $fillable = [
        'ward_id',
        'name',
        'type',
        'district_id'
    ];
    protected $guarded = 'ward_id';

    public $timestamps = false;
}
