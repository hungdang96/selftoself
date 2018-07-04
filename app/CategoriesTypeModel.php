<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriesTypeModel extends Model
{
    public $timestamps = false;
    protected $table = 'categories_type';
    protected $fillable = [
        'id',
        'type_name'
    ];

    protected $guarded = 'id';
    public $primaryKey = 'id';
}
