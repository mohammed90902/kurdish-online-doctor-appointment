<?php

namespace App\Helpers;

class LocalizationHelper
{
    /**
     * Convert English digits to Kurdish/Arabic digits if the locale is not English.
     */
    public static function convertDigits($string)
    {
        if (is_null($string)) return '';
        
        $locale = app()->getLocale();
        if ($locale === 'en') return $string;

        // Eastern Arabic numerals used in Arabic and Kurdish Sorani
        $digits = [
            '0' => '٠',
            '1' => '١',
            '2' => '٢',
            '3' => '٣',
            '4' => '٤',
            '5' => '٥',
            '6' => '٦',
            '7' => '٧',
            '8' => '٨',
            '9' => '٩'
        ];

        return strtr((string) $string, $digits);
    }
}
