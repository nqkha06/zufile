<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteAnalysis extends Model
{
    use HasFactory;
    protected $table = 'note_link_accesses';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'parent_id',
        'revenue',
        'link_id',
        'level_id',
        'created_at',
        'ip_address',
        'referral',
        'country',
        'browser',
        'platform',
        'device',
        'detection'
    ];

    public function level()
    {
        return $this->belongsTo(NoteLevel::class, 'level_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function link()
    {
        return $this->belongsTo(NoteLink::class, 'link_id');
    }
}
