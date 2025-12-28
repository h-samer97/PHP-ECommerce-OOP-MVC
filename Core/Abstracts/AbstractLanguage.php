<?php

namespace Core\Abstracts;

use Exception;

abstract class AbstractLanguage {

    private static array $language = [];

    public static function getKeyword($key) : string {
        
        if (empty(self::$language)) {
            self::loadDefaultLanguage();
        }

        return self::$language[$key] ?? $key; 
    }

    private static function loadDefaultLanguage() {

        $file = $_COOKIE['lang'] ?? 'ar'; 
        $langFilePath = BASE_PATH . '/Language/' . $file . '.php';

        if(file_exists($langFilePath)) {
            $translations = include $langFilePath;
            if(is_array($translations)) {
                self::$language = $translations;
            }
        }
    }

    public function __construct(string $file = null) {
        $file = $file ?? $_COOKIE['lang'] ?? 'ar';
        self::loadDefaultLanguage();
    }
}