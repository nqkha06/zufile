<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadAccesses extends Model
{
    use HasFactory;
    protected $table = 'download_accesses';
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'file_id',
        'reason',
        'is_earn',
        'revenue',
        'created_at',
        'ip_address',
        'referer',
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

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    // public function level()
    // {
    //     return $this->belongsTo(Level::class, 'level_id');
    // }
}
