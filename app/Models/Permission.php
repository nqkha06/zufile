<?php
namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    // protected $fillable = ['group_id'];

    public function group()
    {
        return $this->belongsTo(PermissionGroup::class, 'group_id');
    }
}
