<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'name',
        'email',
        'message',
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
