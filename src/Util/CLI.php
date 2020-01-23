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
        fwrite(STDOUT, $message . PHP_EOL);
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
    
    /**
     * Show command line message and exit
     * 
     * @param string $message Message to show
     */
    public static function showMessageAndExit(string $message)
    {
        static::showMessage($message);
        exit;
    }
    
    
    /**
     * Show command line error message and exit
     * 
     * @param string $error Error message to show
     */
    public static function showErrorAndExit(string $error)
    {
        static::showError($error);
        exit;
    }
}
