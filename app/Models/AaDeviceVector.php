<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AaDeviceVector extends Model
{
    public $timestamps = false;

    protected $table = 'aa_device_vectors';

    protected $fillable = [
        'fingerprint_id',
        'type',
        'value',
    ];

    protected $casts = [
        'fingerprint_id' => 'integer',
        'type' => 'string',
        'value' => 'string',
    ];

    public function fingerprint()
    {
        return $this->belongsTo(AaDeviceFingerprint::class, 'fingerprint_id');
    }
}
