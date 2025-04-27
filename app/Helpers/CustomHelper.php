<?php

if (!function_exists('convertToArabic')) {
    function convertToArabic($number)
    {
        $arabicNumbers = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        return str_replace(range(0, 9), $arabicNumbers, $number);
    }
}
