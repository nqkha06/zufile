<?php

namespace App\Models;

use App\Traits\QueryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NOTELevel extends Model
{
    use HasFactory;
    use QueryScopes;
    
    protected $table = 'note_levels';
    protected $fillable = [
        'name',
        'click_limit',
        'click_value',
        'description',
        'pageload_config',
        'test_link',
        'minimum_pages',
    ];
    public function links() {
        return $this->hasMany(NoteLink::class, 'level_id');
    }
}
