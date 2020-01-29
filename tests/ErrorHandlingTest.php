<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use PSFee\Application\CLI;
use PSFee\Config;

class ErrorHandlingTest extends TestCase
{
    public function testScriptFileName()
    {
        $this->expectOutputString('Error: Missing script file name!'. PHP_EOL);
        $application = (new CLI())
            ->configure(Config::getInstance()
                ->set('./config/config.php'))
            ->run(array());
    }
    
    public function testArgumentCount()
    {
        $this->expectOutputString('Error: Invalid argument count!'. PHP_EOL);
        $application = (new CLI())
            ->configure(Config::getInstance()
                ->set('./config/config.php'))
            ->run(array(
                1, 2, 3
            ));
    }
    
    public function testInputFile()
    {
        $this->expectOutputString('Error: Invalid input file ""!'. PHP_EOL);
        $application = (new CLI())
            ->configure(Config::getInstance()
                ->set('./config/config.php'))
            ->run(array(
                'app.php', 
                ''
            ));
    }
    
    public function testInputFileValidity()
    {
        $this->expectOutputRegex('/^Error: Invalid file extension.*!/'. PHP_EOL);
        $application = (new CLI())
            ->configure(Config::getInstance()
                ->set('./config/config.php'))
            ->run(array(
                'app.php', 
                'input/input.invalid'
            ));
    }
    
    public function testInputFileExistence()
    {
        $this->expectOutputRegex('/^Error: File "[^"]*" not found!/'. PHP_EOL);
        $application = (new CLI())
            ->configure(Config::getInstance()
                ->set('./config/config.php'))
            ->run(array(
                'app.php', 
                'input.csv'
            ));
    }
}
