<?php
namespace PSFee;

class Config
{
    /**
     * Singleton instance
     * 
     * @var \PSFee\Config
     */
    protected static $instance = null;
    
    /**
     * Config data
     * 
     * @var array
     */
    protected $config = array();
    
    /**
     * Class constructor
     * 
     */
    private function __construct()
    {
    }
    
    /**
     * Magic method __clone
     * 
     */
    private function __clone()
    {
    }
    
    /**
     * Get config instance
     * 
     * 
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    
    /**
     * Set config
     * 
     * @param mixed $config Config data, could be:
     *   - file path to config
     *   - array of data
     *   - object of data
     * @return \PSFee\Config
     */
    public function set($config)
    {
        switch (gettype($config)) {
            case 'string':
                $this->config = (array) require $config;
                break;
            case 'array':
                $this->config = $config;
                break;
            case 'object':
                $this->config = (array) $config;
                break;
            default:
                break;
        }
        return $this;
    }
    
    /**
     * Get config
     * 
     * @param mixed $key Config key 
     *   if key is null all config data is returned
     * @param mixed $defaultReturnValue Default value
     *   used in case if key is not found
     * @return mixed Config data
     */
    public function get($key = null, $defaultReturnValue = null)
    {
        if (null !== $key) {
            if (isset($this->config[$key])) {
                return $this->config[$key];
            }
            return $defaultReturnValue;
        }
        return $this->config;
    }
    
    /**
     * Get config using dot notation key
     * 
     * @param mixed $key Config key
     *   if key is null all config data is returned
     * @param mixed $defaultReturnValue Default value
     *   used in case if key is not found
     * @return mixed Config data
     */
    public function dot($key = null, $defaultReturnValue = null)
    {
        if (null !== $key && strpos($key, '.') !== false) {
            $config = $this->config;
            foreach (explode('.', $key) as $segment) {
                if (is_array($config) && isset($config[$segment])) {
                    $config = $config[$segment];
                }
            }
            return $config;
        }
        return $this->config;
    }
}
