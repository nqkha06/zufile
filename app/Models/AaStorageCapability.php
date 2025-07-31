<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AaStorageCapability extends Model
{
    public $timestamps = false;

    protected $table = 'aa_storage_capabilities';
    protected $primaryKey = 'fingerprint_id';
    public $incrementing = false;

    protected $fillable = [
        'fingerprint_id',
        'localStorage',
        'sessionStorage',
        'indexedDB',
        'localStorageWrite',
    ];

    protected $casts = [
        'fingerprint_id' => 'integer',
        'localStorage' => 'boolean',
        'sessionStorage' => 'boolean',
        'indexedDB' => 'boolean',
        'localStorageWrite' => 'boolean',
    ];

    public function fingerprint()
    {
        return $this->belongsTo(AaDeviceFingerprint::class, 'fingerprint_id');
    }
}
