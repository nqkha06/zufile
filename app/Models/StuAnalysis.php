<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StuAnalysis extends Model
{
    use HasFactory;
    protected $table = 'stu_link_accesses';
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'parent_id',
        'link_id',
        'level_id',
        'revenue',
        'created_at',
        'ip_address',
        'referral',
        'country',
        'browser',
        'platform',
        'device',
        'detection'
    ];
    protected $hidden = [
        'laravel_through_key'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'id' => 0,
            'username' => 'Anonymous',
        ])->where('id', '>', 0);
    }

    public function link()
    {
        return $this->belongsTo(StuLink::class, 'link_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}
