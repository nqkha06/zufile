<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AaAutomationFlag extends Model
{
    public $timestamps = false;

    protected $table = 'aa_automation_flags';
    protected $primaryKey = 'fingerprint_id';
    public $incrementing = false;

    protected $fillable = [
        'fingerprint_id',
        'webdriver',
        'chrome',
        'headless',
    ];

    protected $casts = [
        'fingerprint_id' => 'integer',
        'webdriver' => 'boolean',
        'chrome' => 'boolean',
        'headless' => 'boolean',
    ];

    public function fingerprint()
    {
        return $this->belongsTo(AaDeviceFingerprint::class, 'fingerprint_id');
    }
}
