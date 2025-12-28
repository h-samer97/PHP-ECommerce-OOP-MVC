<?php

   namespace Core\Abstracts;

use Core\Interfaces\ISessions;
use Exception;

abstract class AbstractSessions implements ISessions {

    public function start(): bool
    {
        $name     = 'ecomm';
        $lifetime = 0;
        $path     = '/';
        $secure   = false;
        $httpOnly = true;

        if (session_status() === PHP_SESSION_ACTIVE) {
            return false; // Active Current Session
        }

        // Additianl Settings
        ini_set('session.use_strict_mode', '1');
        ini_set('session.use_only_cookies', '1');
        ini_set('session.use_trans_sid', '0');

        session_name($name);

        session_start([
            'cookie_lifetime' => $lifetime,
            'cookie_path'     => $path,
            'cookie_secure'   => $secure,
            'cookie_httponly' => $httpOnly,
        ]);

        return true;
    }

    public function checkIfExist() : bool {

        if(session_status() === PHP_SESSION_ACTIVE) {
            return true;
        } else {
            return false;
        }

    }

    public function set(string $key, string $value) : bool {

        if(session_status() !== PHP_SESSION_ACTIVE) $this->start();

            $_SESSION[$key] = $value;

            return isset($_SESSION[$key]) && $_SESSION[$key] === $value;

    }

    public function get(string $key) : mixed {

        if (session_status() !== PHP_SESSION_ACTIVE) {
            $this->start();
        }

        if (isset($_SESSION[$key]) && is_string($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return null;
    }

    public function has(string $key): bool {

        if (session_status() !== PHP_SESSION_ACTIVE) {
            $this->start();
        }

        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void {
            
        if (session_status() !== PHP_SESSION_ACTIVE) {
            $this->start();
        }

        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public function destroy(): bool {

        if (session_status() !== PHP_SESSION_ACTIVE) {
            $this->start();
        }

        // مسح بيانات الجلسة
        $_SESSION = [];

        // حذف الكوكيز الخاصة بالجلسة
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // تدمير الجلسة
        return session_destroy();
    }


    
}

?>