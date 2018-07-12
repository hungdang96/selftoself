<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletsModel extends Model
{
    protected $table = 'wallets';
    protected $fillable = [
        'wallet_id',
        'name',
        'userid',
        'token',
        'money',
        'lowest_level',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $guarded = 'wallet_id';
    protected $primaryKey = 'wallet_id';
    public $incrementing = false;
}
