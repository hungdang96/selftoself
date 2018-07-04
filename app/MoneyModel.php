<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyModel extends Model
{
    protected $table = 'money';

    protected $fillable = [
        'id',
        'userid',
        'reason',
        'money',
        'type',
        'monthcheck',
        'yearcheck',
        'created_at',
        'updated_at'
    ];
    protected $guarded = 'id';

    protected $primaryKey = 'id';
}
