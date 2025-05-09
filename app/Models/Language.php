<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    public $timestamps = false;

    protected $table = 'languages';

    protected $fillable = [
        'name',
        'locale',
        'is_default',
        'code',
        'is_rtl',
        'flag',
        'order',
    ];

    protected $casts = [
        // 'name' => SafeContent::class,
        // 'locale' => SafeContent::class,
        // 'code' => SafeContent::class,
        'is_rtl' => 'bool',
        'is_default' => 'bool',
        'order' => 'int',
    ];

    // protected static function booted(): void
    // {
    //     self::deleted(function (Language $language) {
    //         if (! self::query()->where('is_default', 1)->exists() && self::query()->exists()) {
    //             self::query()->limit(1)->update(['is_default' => 1]);
    //         }

    //         $language->meta()->each(fn (LanguageMeta $item) => $item->delete());

    //         Setting::newQuery()->where('key', 'LIKE', ThemeOption::getOptionKey('%', $language->code))->delete();
    //         Widget::query()->where('theme', 'LIKE', Widget::getThemeName($language->code))->delete();
    //     });
    // }

    // public function meta(): HasMany
    // {
    //     return $this->hasMany(LanguageMeta::class, 'meta_code', 'code');
    // }
}
