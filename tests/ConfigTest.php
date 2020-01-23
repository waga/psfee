<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use PSFee\Config;
use ReflectionClass;
use stdClass;

class ConfigTest extends TestCase
{
    public function testConstructor()
    {
        $reflection = new ReflectionClass(Config::class);
        $constructor = $reflection->getConstructor();
        $this->assertFalse($constructor->isPublic());
    }
    
    public function testClone()
    {
        $reflection = new ReflectionClass(Config::class);
        $constructor = $reflection->getMethod('__clone');
        $this->assertFalse($constructor->isPublic());
    }
    
    public function testSingleton()
    {
        $config1 = Config::getInstance();
        $config2 = Config::getInstance();
        $this->assertEquals($config1, $config2);
    }
    
    public function testSetString()
    {
        $configFile = 'config/config.php';
        $configFileContent = include $configFile;
        $config = Config::getInstance();
        $config->set($configFile);
        $loadedConfig = $config->get();
        $this->assertEquals($loadedConfig, $configFileContent);
    }
    
    public function testSetArray()
    {
        $configArray = array(
            'db' => array(
                'host' => ''
            )
        );
        $config = Config::getInstance();
        $config->set($configArray);
        $loadedConfig = $config->get();
        $this->assertEquals($loadedConfig, $configArray);
    }
    
    public function testSetObject()
    {
        $configObject = new stdClass();
        $configObject->setting = array(
            'key' => 'value'
        );
        $config = Config::getInstance();
        $config->set($configObject);
        $loadedConfig = $config->get();
        $this->assertEquals($loadedConfig, (array) $configObject);
    }
    
    public function testDot()
    {
        $configArray = array(
            'db' => array(
                'host' => 'localhost'
            )
        );
        $config = Config::getInstance();
        $config->set($configArray);
        $loadedConfig = $config->dot('db.host');
        $this->assertEquals($loadedConfig, $configArray['db']['host']);
    }
}
