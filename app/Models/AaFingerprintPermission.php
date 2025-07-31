<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AaFingerprintPermission extends Model
{
    public $timestamps = false;

    protected $table = 'aa_fingerprint_permissions';
    protected $primaryKey = 'fingerprint_id';
    public $incrementing = false;

    protected $fillable = [
        'fingerprint_id',
        'notifications',
        'geolocation',
        'camera',
        'microphone',
    ];

    protected $casts = [
        'fingerprint_id' => 'integer',
        'notifications' => 'string',
        'geolocation' => 'string',
        'camera' => 'string',
        'microphone' => 'string',
    ];

    public function fingerprint()
    {
        return $this->belongsTo(AaDeviceFingerprint::class, 'fingerprint_id');
    }
}
