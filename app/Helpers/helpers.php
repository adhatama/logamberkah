<?php

if (!function_exists('price_format')) {
    function price_format($number, $prefix = null)
    {
        $formatted = number_format((float) $number, 0, ',', '.');

        if ($prefix) {
            $formatted = $prefix . $formatted;
        }

        return $formatted;
    }
}
