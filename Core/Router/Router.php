<?php
namespace Core\Router;

use Core\Helper\URL;

class Router {
    protected array $routes = [];

    /**
     * تسجيل مسار مع إمكانية وجود بارامترات ديناميكية
     * مثال: members/{id}/edit
     */
    public function add(string $pattern, callable $callback): void {
        // استبدال {param} بـ Regex يلتقط القيمة
        $regex = preg_replace(
            '#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#',
            '(?P<$1>[^/]+)',
            $pattern
        );

        // بناء Regex كامل مع حدود البداية والنهاية
        $regex = '#^' . trim($regex, '/') . '$#i';

        // تخزين المسار
        $this->routes[] = [
            'regex'    => $regex,
            'callback' => $callback
        ];
    }

    /**
     * استخراج المسار المطلوب من الرابط
     * يتجاهل أي Query String أو Fragment
     */
    public function resolvePath(): string {
        $uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
        return trim($uriPath, '/');
    }

    /**
     * تنفيذ التوجيه
     */
    public function dispatch(): void {
        $requested = $this->resolvePath();

        foreach ($this->routes as $route) {
            if (preg_match($route['regex'], $requested, $matches)) {
                // استخراج البارامترات المسماة فقط
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // تنفيذ الكولباك مع البارامترات
                call_user_func_array($route['callback'], $params);
                return;
            }
        }

        // إذا لم يوجد تطابق → 404
        http_response_code(404);
        URL::redirect('404');
    }
}
