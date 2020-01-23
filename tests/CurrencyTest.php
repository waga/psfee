<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use PSFee\Currency;
use PSFee\Currency\EUR;
use PSFee\Currency\USD;
use PSFee\Currency\JPY;
use PSFee\Currency\Converter;

class CurrencyTest extends TestCase
{
    public function testCreateCurrency()
    {
        $currency = Currency::create('EUR');
        $this->assertInstanceOf(EUR::class, $currency);
    }
    
    public function testCurrencyConvertion()
    {
        $amount = 100;// eur
        $eur = Currency::create('EUR');
        $jpy = Currency::create('JPY');
        $jpyAmount = $eur->convert($jpy, $amount);
        $this->assertEquals($amount, $jpy->convert($eur, $jpyAmount));
    }
}
