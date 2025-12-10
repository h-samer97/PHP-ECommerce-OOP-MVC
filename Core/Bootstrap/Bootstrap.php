<?php

use Services\SessionsServices;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// BASE_PATH = Root
if (!defined('BASE_PATH')) {
    define('BASE_PATH', realpath(__DIR__ . '/../../') . DIRECTORY_SEPARATOR);
}

// BASE_URL
if (!defined('BASE_URL')) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    if (substr($scriptName, -6) === '/Public') {
        $scriptName = substr($scriptName, 0, -6);
    }
    define('BASE_URL', rtrim($protocol . "://" . $host . $scriptName, '/') . '/');
}

// Autoloader
require_once BASE_PATH . 'Core/Autoloader/Autoloader.php';
\Core\Autoloader\Autoloader::register();

(new SessionsServices())->start();





?>