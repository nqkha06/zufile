<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AaJsError extends Model
{
    public $timestamps = false;

    protected $table = 'aa_js_errors';

    protected $fillable = [
        'fingerprint_id',
        'error_message',
    ];

    protected $casts = [
        'fingerprint_id' => 'integer',
        'error_message' => 'string',
    ];

    public function fingerprint()
    {
        return $this->belongsTo(AaDeviceFingerprint::class, 'fingerprint_id');
    }
}
