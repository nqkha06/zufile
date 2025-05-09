<?php

namespace App\Models;

use App\Enums\BaseStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];
    
    protected $casts = [
        'status' => BaseStatusEnum::class
    ];
    protected $attributes = [
        'status' => BaseStatusEnum::DRAFT
    ];
    
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags', 'tag_id', 'post_id');
    }
}
