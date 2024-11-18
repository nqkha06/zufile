<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    use HasFactory;
    protected $table = 'api_tokens';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'name',
        'token',
        'data',
        'status',
        'created_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
