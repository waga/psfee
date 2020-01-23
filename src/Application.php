<?php
namespace PSFee;

use PSFee\Config;

abstract class Application
{
    /**
     * Application config
     * 
     * @var \PSFee\Config
     */
    protected $config;
    
    /**
     * Main dispatcher
     * 
     * @param array $arguments Application arguments
     */
    abstract public function run(array $arguments = array());
    
    /**
     * Configure application
     * 
     * @param \PSFee\Config $config
     */
    public function configure(Config $config)
    {
        $this->config = $config;
        return $this;
    }
}
