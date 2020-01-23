<?php
namespace PSFee\Currency;

class Converter
{
    /**
     * Rates
     * 
     * @var array
     */
    protected static $rates = array(
        'EUR' => array(
            'JPY' => 129.53,
            'USD' => 1.1497
        )
    );
    
    /**
     * Convert 
     * 
     * @param string $from
     * @param string $to
     * @param float $amount
     * @return float|null
     */
    public static function convert(string $from, string $to, float $amount)
    {
        if (array_key_exists($from, static::$rates) && 
            array_key_exists($to, static::$rates[$from])) {
            return $amount * static::$rates[$from][$to];
        } elseif (array_key_exists($to, static::$rates) && 
            array_key_exists($from, static::$rates[$to])) {
            return $amount / static::$rates[$to][$from];
        }
        return null;
    }
}
