<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class StuLink extends Model
{
    use HasFactory, QueryScopes;
    protected $table = 'stu_links';
    protected $fillable = [
        'user_id',
        'alias',
        'data',
        'status',
        'level_id',
        'seo_meta'
    ];
    protected $casts = [
        'seo_meta' => 'array'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function stats()
    {
        return $this->hasMany(StuAnalysis::class, 'link_id');
    }
    public function statistics()
    {
        return $this->hasMany(StuAnalysis::class, 'link_id');
    }
    public function view()
    {
        return $this->hasMany(StuAnalysis::class, 'link_id')->count();
    }
    public function revenue()
    {
        return $this->hasMany(StuAnalysis::class, 'link_id')->sum('revenue');
    }
    public function access()
    {
        return $this->hasMany(StuAnalysis::class, 'parent_id');
    }
    public function level()
    {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }
}
