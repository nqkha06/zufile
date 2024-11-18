<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\QueryScopes;

class Level extends Model
{
    use HasFactory, QueryScopes;
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
        return $this->hasMany(StuLink::class);
    }

}
