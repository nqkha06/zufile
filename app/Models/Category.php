<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function publishedPosts()
    {
        return $this->hasMany(Post::class)->where('status', 'public');
    }
}
