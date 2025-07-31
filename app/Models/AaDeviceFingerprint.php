<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AaDeviceFingerprint extends Model
{
    protected $table = 'aa_device_fingerprints';
    const UPDATED_AT = null;

    protected $casts = [
        'user_id' => 'integer',
        'link_id' => 'integer',

        'dcc' => 'string',
        'dcl' => 'string',
        'cpn' => 'integer',
        'gvd' => 'string',
        'grr' => 'string',
        'ct' => 'integer',

        'ua' => 'string',
        'webdriver' => 'boolean',
        'has_touch' => 'boolean',
        'is_mobile_ua' => 'boolean',

        'first_click_delay' => 'integer',
        'mousemove_count' => 'integer',
        'scroll_count' => 'integer',
        'keypress_count' => 'integer',
        'plugins' => 'integer',

        'canvas_fp' => 'string',
        'canvas_fp_full' => 'string',

        'tz_offset' => 'integer',
        'lang' => 'string',
        'screen' => 'string',

        'audio_fp' => 'string',
        'interaction_quality' => 'integer',
        'memory' => 'integer',
        'platform' => 'string',
        'do_not_track' => 'boolean',
        'all_langs' => 'string',

        'network_speed' => 'string',
        'network_type' => 'string',
        'network_rtt' => 'string',

        'created_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id', 'link_id',
        'dcc', 'dcl', 'cpn', 'gvd', 'grr', 'ct',
        'ua', 'webdriver', 'has_touch', 'is_mobile_ua',
        'first_click_delay', 'mousemove_count', 'scroll_count', 'keypress_count', 'plugins',
        'canvas_fp', 'canvas_fp_full',
        'tz_offset', 'lang', 'screen',
        'audio_fp', 'interaction_quality', 'memory', 'platform', 'do_not_track', 'all_langs',
        'network_speed', 'network_type', 'network_rtt',
    ];

    // Relationships
    public function vectors()
    {
        return $this->hasMany(AaDeviceVector::class, 'fingerprint_id');
    }

    public function automationFlags()
    {
        return $this->hasOne(AaAutomationFlag::class, 'fingerprint_id');
    }

    public function fonts()
    {
        return $this->hasMany(AaFingerprintFont::class, 'fingerprint_id');
    }

    public function performanceTiming()
    {
        return $this->hasOne(AaPerformanceTiming::class, 'fingerprint_id');
    }

    public function storageCapabilities()
    {
        return $this->hasOne(AaStorageCapability::class, 'fingerprint_id');
    }

    public function jsErrors()
    {
        return $this->hasMany(AaJsError::class, 'fingerprint_id');
    }

    public function permissions()
    {
        return $this->hasOne(AaFingerprintPermission::class, 'fingerprint_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function link()
    {
        return $this->belongsTo(StuLink::class, 'link_id')->withDefault();
    }
}
