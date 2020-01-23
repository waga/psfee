<?php
namespace PSFee\Util;

class Price
{
    /**
     * Ceil 
     * 
     * @param float $price
     * @param int $precision
     */
    public static function ceil($price, $precision = 0)
    {
        $offset = 0.5;
        if ($precision !== 0)
            $offset /= pow(10, $precision);
        return round($price + $offset, $precision, PHP_ROUND_HALF_DOWN);
    }
}
