<?php

  namespace Core\Helper;

class URL {
    public static function js($file): string {
        return \BASE_URL . 'js/' . $file . '.js';
    }

    public static function css($file): string {
        return \BASE_URL . 'css/' . $file . '.css';
    }

    public static function ico($file): string {
        return \BASE_URL . 'ico/' . $file . '.ico';
    }

    public static function language($lang): array {
        return [\BASE_URL . '/Language/' . $lang];
    }

    public static function redirect(string $page): void {
    header('Location: ' . BASE_URL . $page);
    exit();

}

}


?>