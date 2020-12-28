<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_Tags extends Model
{
    protected $fillable = [
        'posts_id', 'tags_id'
    ];
}
