<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WalletTypeModel extends Model
{
    public $timestamps = false;
    protected $table = 'wallet_type';
    protected $fillable = [
        'id',
        'wallet_type_name'
    ];
    protected $guarded = 'id';
}
