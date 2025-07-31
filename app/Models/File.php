<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'folder_id',
        'alias',
        'name',
        'extension',
        'name_original',
        'mime_type',
        'size',
        'path',
        'is_public',
        'download_count',
    ];

    // Người upload
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Folder chứa file
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
