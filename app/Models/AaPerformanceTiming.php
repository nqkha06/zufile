<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AaPerformanceTiming extends Model
{
    public $timestamps = false;

    protected $table = 'aa_performance_timing';
    protected $primaryKey = 'fingerprint_id';
    public $incrementing = false;

    protected $fillable = [
        'fingerprint_id',
        'load_time',
        'dom_ready_time',
        'network_time',
    ];

    protected $casts = [
        'fingerprint_id' => 'integer',
        'load_time' => 'integer',
        'dom_ready_time' => 'integer',
        'network_time' => 'integer',
    ];

    public function fingerprint()
    {
        return $this->belongsTo(AaDeviceFingerprint::class, 'fingerprint_id');
    }
}
