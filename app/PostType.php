<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PostType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @mixin \Eloquent
 */
class PostType extends Model
{
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    //
}
