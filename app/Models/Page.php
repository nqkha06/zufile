<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'summary',
        'image',
        'slug',
        'category_id',
        'tags',
        'status'
    ];

    protected $attributes = [
        'status' => 'public',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function views()
    {
        return $this->hasMany(PageView::class, 'page_id');
    }
}
