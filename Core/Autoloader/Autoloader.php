<?php

  namespace Core\Autoloader;

class Autoloader {
    public static function register(): void {
        spl_autoload_register(function ($class) {
            $baseDir = __DIR__ . '/../../'; # => eComm
            $classPath = str_replace('\\', '/', $class) . '.php';
            $file = $baseDir . $classPath;

            if (file_exists($file)) {
                require_once $file;
            }
        });
    }
}


?>