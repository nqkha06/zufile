<?php

namespace App\Traits;

trait HasTranslations
{
    public function translations()
    {
        $baseName = class_basename($this);
        $translationClass = 'App\\Models\\' . $baseName . 'Translation';

        return $this->hasMany($translationClass);
    }
    public function translation($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
    
        $translations = $this->getRelationValue('translations');
    
        if ($translations) {
            return $translations->firstWhere('lang_code', $locale)
                ?? $translations->firstWhere('lang_code', 'en');
        }
    
        return $this->translations()
            ->where('lang_code', $locale)
            ->first()
            ?? $this->translations()
            ->where('lang_code', 'en')
            ->first();
    }
    
    public function hasTranslation($locale): bool
    {
        return $this->translations
            ->where('lang_code', $locale)
            ->isNotEmpty(); 
    }
}
