<?php
namespace Core\Helper;

use Services\SessionsServices;

class FlashMessage {

    private static SessionsServices $session;

    public static function init(): void {
        self::$session = new SessionsServices();
    }

    public static function success(string $message): void {
        self::$session->set('flash_message', Alert::Print($message, 'success'));
    }

    public static function error(string $message): void {
        self::$session->set('flash_message', Alert::Print($message, 'error'));
    }

    public static function warning(string $message): void {
        self::$session->set('flash_message', Alert::Print($message, 'warning'));
    }

    public static function info(string $message): void {
        self::$session->set('flash_message', Alert::Print($message, 'info'));
    }

    public static function display(): void {
        if (self::$session->has('flash_message')) {
            echo self::$session->get('flash_message');
            self::$session->remove('flash_message'); // حتى لا تتكرر الرسالة
        }
    }
}
