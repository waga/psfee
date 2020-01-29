<?php
namespace Tests;

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use PSFee\Application\CLI;
use PSFee\Config;
use PSFee\Exception\UserException;
use PSFee\Exception\OperationException;
use PSFee\Exception\CurrencyException;

class CommissionCalculationTest extends TestCase
{
    protected function callCalculateFeesMethod($inputFileRows)
    {
        $class = new ReflectionClass(CLI::class);
        $method = $class->getMethod('calculateFees');
        $method->setAccessible(true);
        $obj = new CLI();
        return $method->invokeArgs($obj, array($inputFileRows));
    }
    
    public function testExpectedCommissions()
    {
        $inputFileRows = array(
            array(
                '2016-02-15',
                '1',
                'natural',
                'cash_out',
                '300.00',
                'EUR',
            ),
            array(
                '2016-02-19',
                '5',
                'natural',
                'cash_out',
                '3000000',
                'JPY',
            ),
        );
        
        $expectedCommissions = array(
            '0.00',
            '8612'
        );
        
        $calculatedCommissions = $this->callCalculateFeesMethod($inputFileRows);
        $this->assertEquals($calculatedCommissions, $expectedCommissions);
    }
    
    public function testInvalidFileRow()
    {
        $inputFileRows = array(
            array(
                '2016-02-15',
                '1',
                'natural',
                'cash_out',
                '300.00',
            ),
        );
        
        $expectedCommissions = array(
            '0.00',
        );
        
        $this->expectException(UserException::class);
        $calculatedCommissions = $this->callCalculateFeesMethod($inputFileRows);
        $this->assertEquals($calculatedCommissions, $expectedCommissions);
    }
    
    public function testInvalidCurrency()
    {
        $inputFileRows = array(
            array(
                '2016-02-15',
                '1',
                'natural',
                'cash_out',
                '300.00',
                'INVALID_CURRENCY'
            ),
        );
        
        $this->expectException(CurrencyException::class);
        $this->callCalculateFeesMethod($inputFileRows);
    }
    
    public function testInvalidUserType()
    {
        $inputFileRows = array(
            array(
                '2016-02-15',
                '1',
                'guest',
                'cash_out',
                '300.00',
                'EUR'
            ),
        );
        
        $this->expectException(UserException::class);
        $this->callCalculateFeesMethod($inputFileRows);
    }
    
    public function testInvalidOperationType()
    {
        $inputFileRows = array(
            array(
                '2016-02-15',
                '1',
                'natural',
                'cash_it',
                '300.00',
                'EUR'
            ),
        );
        
        $this->expectException(OperationException::class);
        $this->callCalculateFeesMethod($inputFileRows);
    }
}
