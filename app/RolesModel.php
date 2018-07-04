<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'role_id',
        'role_name',
        'created_at',
        'updated_at'
    ];
    protected $guarded = 'role_id';
    public $primaryKey = 'role_id';
}
