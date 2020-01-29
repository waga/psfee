<?php
namespace PSFee;

use ErrorException;
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
    
    /**
     * Initialize application
     * 
     */
    public function initialize()
    {
        set_error_handler('static::errorHandler');
        return $this;
    }
    
    /**
     * Error handler
     * 
     */
    protected function errorHandler($errno, $errstr, $errfile, $errline)
    {
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
}
