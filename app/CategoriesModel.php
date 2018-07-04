<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriesModel extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'id',
        'category_name',
        'category_parent',
        'type_id',
        'created_at',
        'updated_at'
    ];

    protected $guarded = 'id';
    protected $primaryKey = 'id';
}
