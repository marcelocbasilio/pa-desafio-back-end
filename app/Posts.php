<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToManyPosts;

/**
 * Class Posts
 * @package App
 */
class Posts extends Model
{
    /** @var string[] */
    protected $fillable = [
        'id', 'title', 'author',
        'content'
    ];

    /**
     * @return BelongsToManyPosts
     */
    public function tags(): BelongsToManyPosts
    {
        return $this->belongsToMany(Tags::class, 'post__tags');
    }
}
