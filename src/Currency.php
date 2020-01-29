<?php
namespace PSFee;

use PSFee\Currency\Converter;
use PSFee\Currency\EUR;
use PSFee\Currency\USD;
use PSFee\Currency\JPY;
use PSFee\Exception\CurrencyException;

class Currency
{
    /**
     * Precision
     * 
     * @var int
     */
    protected $precision = 2;
    
    /**
     * Get precision
     * 
     * @return int
     */
    public function getPrecision()
    {
        return $this->precision;
    }
    
    /**
     * Standalone class name
     * 
     * @return string
     */
    public function __toString()
    {
        $class = get_called_class();
        $segments = explode('\\', $class);
        return array_pop($segments);
    }
    
    /**
     * Convert
     * 
     * @param \PSFee\Currency $currency
     * @param float $amount
     * @return float
     */
    public function convert(Currency $currency, $amount)
    {
        $currencyClass = get_class($currency);
        if (!$this instanceof $currencyClass) {
            $amount = Converter::convert(
                (string) $this,
                (string) $currency,
                $amount
            );
        }
        return $amount;
    }
    
    /**
     * Create currency
     * 
     * @param string $currency
     * @return \PSFee\Currency
     */
    public static function create(string $currency)
    {
        if ($currency == 'EUR') {
            return new EUR();
        } else if ($currency == 'USD') {
            return new USD();
        } else if ($currency == 'JPY') {
            return new JPY();
        }
        throw new CurrencyException('Currency "'. $currency .'" not found!');
    }
}
