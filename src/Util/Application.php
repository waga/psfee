<?php
namespace PSFee\Util;

use PSFee\Util\CLI as CLIUtil;

class Application
{
    const DEFAULT_SCRIPT_FILE = 'app.php';
    const DEFAULT_INPUT_FILE = 'input.csv';
    
    /**
     * Show application usage
     * 
     * @param string $scriptFile Script file name
     * @param string $inputFile Input file name
     */
    public static function showUsage(
        string $scriptFile = self::DEFAULT_SCRIPT_FILE, 
        string $inputFile = self::DEFAULT_INPUT_FILE)
    {
        CLIUtil::showMessage('Usage: php '. $scriptFile .' '. $inputFile);
    }
    
    /**
     * Show application usage and exit
     * 
     * @param string $scriptFile Script file name
     * @param string $inputFile Input file name
     */
    public static function showUsageAndExit(
        string $scriptFile = self::DEFAULT_SCRIPT_FILE, 
        string $inputFile = self::DEFAULT_INPUT_FILE)
    {
        static::showUsage($scriptFile);
        exit;
    }
}
