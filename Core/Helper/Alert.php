<?php
namespace Core\Helper;

class Alert {

    /**
     * طباعة رسالة خطأ/تحذير/معلومة
     *
     * @param string $message  نص الرسالة
     * @param string $type     نوع الرسالة: error | warning | info | success
     * @return string          HTML جاهز للطباعة
     */
    public static function Print(string $message, string $type = 'info'): string {
        // تحديد الكلاس المناسب
        $classMap = [
            'error'      => 'alert alert-error',
            'warning'    => 'alert alert-warning',
            'info'       => 'alert alert-info',
            'success'    => 'alert alert-success'
        ];

        $cssClass = $classMap[$type] ?? $classMap['info'];

        return <<<HTML
        <div class="{$cssClass}">
            {$message}
        </div>
        HTML;
    }
}
