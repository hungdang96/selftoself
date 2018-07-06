<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilesModel extends Model
{
    protected $table = 'profile';
    protected $fillable = [
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

    protected $primaryKey = 'id';
}
