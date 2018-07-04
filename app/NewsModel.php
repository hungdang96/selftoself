<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $fillable = [
        'id',
        'title',
        'content',
        'news_link',
        'status',
        'created_at',
        'updated_at'
    ];
    protected $guarded = 'id';
    protected $primaryKey = 'id';
}
