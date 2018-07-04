<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportsModel extends Model
{
    protected $table = 'reports';
    protected $fillable = [
        'id',
        'name',
        'content',
        'userid',
        'total_income',
        'total_paid',
        'remaining_amount',
        'ischecked',
        'datechecked',
        'created_at',
        'updated_at'
    ];

    protected $guarded = 'id';
    protected $primaryKey = 'id';
}
