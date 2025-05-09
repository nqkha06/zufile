<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class NOTELink extends Model
{
    use HasFactory, QueryScopes;
    protected $table = 'note_links';

    protected $fillable = [
        'user_id',
        'alias',
        'title',
        'content',
        'password',
        'status',
        'level_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function stats()
    {
        return $this->hasMany(NOTEStatistics::class, 'link_id');
    }
    public function level()
    {
        return $this->hasOne(NOTELevel::class, 'id', 'level_id');
    }
}
