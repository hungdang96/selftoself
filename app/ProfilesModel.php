<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilesModel extends Model
{
    protected $table = 'profile';
    protected $fillable = [
        'id',
        'avatar',
        'fullname',
        'dob',
        'sexual',
        'userid',
        'IDcard',
        'phone',
        'address',
        'provinceid',
        'districtid',
        'wardid',
        'created_at',
        'updated_at'
    ];

    protected $guarded = 'id';
    protected $primaryKey = 'id';
}
