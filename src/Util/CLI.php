<?php
namespace PSFee\Util;

class CLI
{
    /**
     * Show command line message
     * 
     * @param string $message Message to show
     */
    public static function showMessage(string $message)
    {
        echo $message . PHP_EOL;
    }
    
    /**
     * Show command line error message
     * 
     * @param string $error Error message to show
     */
    public static function showError(string $error)
    {
        static::showMessage('Error: '. $error);
    }
}
