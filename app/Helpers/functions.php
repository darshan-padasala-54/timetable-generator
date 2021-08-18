<?php
if (! function_exists('calculate_monthly_emi')) {
    function calculate_monthly_emi($principal_amount, $rate_of_interest, $durations)
    {
        $temp = pow(1 + $rate_of_interest, $durations);
        $monthly = ($principal_amount * $temp * $rate_of_interest)/($temp-1);
        return $monthly;
    }
}

if (! function_exists('amount_format')) {
    function amount_format($amount, $currency = '₹')
    {
        return $currency.number_format($amount);
    }
}
