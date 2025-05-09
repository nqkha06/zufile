<?php
namespace App\Services;
use App\Models\Language;

class LanguageService {
    public function getSupportedLanguages() {
        return Language::get();
    }

    public function getLanguege($code) {
        return Language::where("code", "=", $code)->first();
    }
}