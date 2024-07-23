<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title','description'];
    public function forums()
    {
        return $this->hasMany(Forum::class);
    }
}
