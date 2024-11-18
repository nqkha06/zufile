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
        'created_at',
        'ip_address',
        'referral',
        'country',
        'browser',
        'platform',
        'device',
        'detection'
    ];
}
