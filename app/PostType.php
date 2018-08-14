<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\PostType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PostType whereUpdatedAt($value)
 */
class PostType extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    //
}
