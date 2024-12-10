<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','content','forum_id'];
    
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
    
    public function comments()
    {
    return $this->hasMany(Comment::class);
    }
}
