<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'content',
        'user_id',
        'photo',
        'name',
        'email',
        'phone',
        'review',
    ];

    public function post()
{
    return $this->belongsTo(Post::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}

