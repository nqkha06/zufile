<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteLinkClick extends Model
{
    use HasFactory;
    protected $table = 'note_link_clicks';
    public $timestamps = false;
    protected $fillable = [
        'link_id',
        'clicks',
        'revenue',
        'date',
    ];
    public function link()
    {
        return $this->belongsTo(NoteLink::class, 'link_id', 'id');
    }
}
