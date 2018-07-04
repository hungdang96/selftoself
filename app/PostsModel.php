<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostsModel extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'id',
        'title',
        'post_avatar',
        'content',
        'userid',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $guarded = 'id';
    protected $primaryKey = 'id';
}
