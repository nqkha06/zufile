<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'parent_id',
        'alias',
        'name',
    ];

    // Người tạo folder
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Folder cha
    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    // Các folder con
    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    // File trong folder
    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function hasDeletedAncestor(): bool
    {
        $folder = $this;

        while ($folder->parent_id !== null) {
            $folder = $folder->parent;

            if (!$folder) {
                return true;
            }

            if ($folder->trashed()) {
                return true;
            }
        }

        return false;
    }

    public function allDescendants()
    {
        return $this->children()->with('allDescendants');
    }
}
