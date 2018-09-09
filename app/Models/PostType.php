<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostType
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PostType whereUpdatedAt($value)
 */
class PostType extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    //
}
