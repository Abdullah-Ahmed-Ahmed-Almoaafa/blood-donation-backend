<?php

if (!function_exists('clean_input')) {
    /**
     * تنظيف المدخلات من المسافات والعلامات الضارة
     *
     * @param string|null $input
     * @param bool $stripTags إزالة علامات HTML
     * @return string|null
     */
    function clean_input($input, $stripTags = true)
    {
        if (is_null($input)) {
            return null;
        }

        // إزالة المسافات الزائدة من البداية والنهاية
        $cleaned = trim($input);

        // إزالة علامات HTML إذا طلب
        if ($stripTags) {
            $cleaned = strip_tags($cleaned);
        }

        return $cleaned;
    }
}