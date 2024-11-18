<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NOTEStatistics extends Model
{
    use HasFactory;
    protected $table = 'note_statistics';
    public $timestamps = false;
    protected $fillable = [
        'link_id',
        'clicks',
        'revenue',
        'date',
    ];
    public function link()
    {
        return $this->belongsTo(NOTELink::class, 'link_id', 'id');
    }
    public function accesses()
    {
        return $this->hasMany(NoteAnalysis::class, 'link_id');
    }

}
