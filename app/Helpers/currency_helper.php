<?php

if (!function_exists('format_currency')) {
    function format_currency($amount, $currency = 'IDR')
    {
        $formattedAmount = number_format($amount, 0, ',', '.');
        return $currency . ' ' . $formattedAmount;
    }
}
