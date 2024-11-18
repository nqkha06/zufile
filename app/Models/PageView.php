<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;    
    public $timestamps = false;

    protected $fillable = [
        'page_id',
        'views',
        'date',
    ];
    public function page()
    {
        return $this->belongsTo(Post::class, 'page_id', 'id');
    }
}
