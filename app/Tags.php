<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToManyTags;

/**
 * Class Tags
 * @package App
 */
class Tags extends Model
{
    /** @var string[] */
    protected $fillable = ['id', 'name'];

    public function posts(): BelongsToManyTags
    {
        return $this->belongsToMany(Posts::class, 'post__tags');
    }
}
