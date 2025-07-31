<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AaFingerprintFont extends Model
{
    public $timestamps = false;

    protected $table = 'aa_fingerprint_fonts';

    protected $fillable = [
        'fingerprint_id',
        'font_name',
    ];

    protected $casts = [
        'fingerprint_id' => 'integer',
        'font_name' => 'string',
    ];

    public function fingerprint()
    {
        return $this->belongsTo(AaDeviceFingerprint::class, 'fingerprint_id');
    }
}
