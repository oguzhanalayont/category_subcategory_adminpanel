<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id', 'content'];

    // User ile ilişki
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Post ile ilişki
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}