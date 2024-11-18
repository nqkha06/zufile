<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuLinkClick extends Model
{
    use HasFactory, QueryScopes;
    
    public $timestamps = false;

    protected $fillable = [
        'link_id',
        'clicks',
        'revenue',
        'date',
    ];
    public function link()
    {
        return $this->belongsTo(StuLink::class, 'link_id', 'id');
    }
    public function user()
    {
        return $this->hasManyThrough(StuLinkClick::class,
        StuLink::class,
        'user_id',
        'link_id',);
    }
}
