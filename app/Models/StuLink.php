<?php

namespace App\Models;

use App\Enums\STUSourceTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuLink extends Model
{
    use HasFactory;
    protected $table = 'stu_links';

    protected $fillable = [
        'user_id',
        'alias',
        'data',
        'status',
        'level_id',
        'source_type'
    ];

    protected $casts = [
        'source_type' => STUSourceTypeEnum::class,
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
