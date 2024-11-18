<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'parent_id', 'menu_group_id', 'order'];

    public function group()
    {
        return $this->belongsTo(MenuGroup::class);
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }
    public function items()
    {
        return $this->hasMany(MenuItem::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }
}