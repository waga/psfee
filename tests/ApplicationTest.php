<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use PSFee\Application\CLI;
use PSFee\Config;

class ApplicationTest extends TestCase
{
    public function testRun()
    {
        $this->expectOutputString('0.60'. PHP_EOL);
        $application = (new CLI())
            ->configure(Config::getInstance()
                ->set('./config/config.php'))
            ->run(array(
                'app.php',
                'input/input_single_row.csv'
            ));
    }
}
