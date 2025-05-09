<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\BaseStatusEnum;
use App\Builders\BaseQueryBuilder;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'description',
        'image',
        'slug',
        'status'
    ];

    protected $attributes = [
        'status' => BaseStatusEnum::DRAFT,
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }
    
    public function views()
    {
        return $this->hasMany(PostView::class, 'post_id');
    }

    public function newEloquentBuilder($query): BaseQueryBuilder
    {
        return new BaseQueryBuilder($query);
    }
}
