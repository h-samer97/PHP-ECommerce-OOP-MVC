<?php


    namespace Middleware;

use Services\CSRFToken;

    class VerifyCsrfToken {


         protected array $except = [
        // '/webhook/provider-x',
        // '/api/public/*',
        ];


        public function handle(callable $next)
    {
        $csrf = new CSRFToken();
        $csrf->ensureToken();

        $server = $_SERVER;
        $post = $_POST;
        $headers = $this->getHeaders();

        $uri = parse_url($server['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
        if ($this->isExcept($uri)) {
            return $next();
        }

        if (!$csrf->validateRequest($server, $post, $headers)) {
            http_response_code(419);
            echo $this->expiredPage();
            return null;
        }

        return $next();
    }

    protected function isExcept(string $uri): bool
    {
        foreach ($this->except as $pattern) {
            // دعم wildcards البسيط
            $regex = '#^' . str_replace(['*'], ['.*'], $pattern) . '$#';
            if (preg_match($regex, $uri)) {
                return true;
            }
        }
        return false;
    }

    protected function getHeaders(): array
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (str_starts_with($key, 'HTTP_')) {
                $name = str_replace('_', '-', substr($key, 5));
                $headers[$name] = $value;
            }
        }
        return $headers;
    }

    protected function expiredPage(): string
    {
        return '<!doctype html><html lang="ar"><head><meta charset="utf-8"><title>419 - انتهت الصفحة</title></head><body style="font-family:sans-serif;padding:2rem"><h1>419 - انتهت الجلسة</h1><p>انتهت صلاحية الطلب أو فشل التحقق من CSRF. يرجى إعادة تحميل الصفحة والمحاولة مجددًا.</p></body></html>';
    }
}















?>