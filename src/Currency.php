<?php
namespace PSFee;

use Exception;
use PSFee\Currency\Converter;

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
        $class = strtoupper($currency);
        $class = __NAMESPACE__ .'\Currency\\'. $class;
        
        if (!class_exists($class)) {
            throw new Exception('Currency "'. $class .'" not found!');
        }
        
        $instance = new $class;
        return $instance;
    }
}
