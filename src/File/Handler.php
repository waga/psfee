<?php
namespace PSFee\File;

class Handler
{
    /**
     * File
     * 
     * @var string
     */
    protected $file;
    
    /**
     * File open mode
     * 
     * @var string
     */
    protected $mode;
    
    /**
     * File resource
     * 
     * @var resource
     */
    protected $resource;
    
    /**
     * Set file
     * 
     * @param string $file
     * @return \PSFee\File\Handler
     */
    public function setFile(string $file)
    {
        $this->file = $file;
        return $this;
    }
    
    /**
     * Set mode
     * 
     * @param string $mode
     * @return \PSFee\File\Handler
     */
    public function setMode(string $mode)
    {
        $this->mode = $mode;
        return $this;
    }
    
    /**
     * Open file
     * 
     * @return \PSFee\File\Handler
     */
    public function open()
    {
        $this->resource = fopen($this->file, $this->mode);
        return $this;
    }
    
    /**
     * Get file resource
     * 
     * @return resource
     */
    public function getResource()
    {
        return $this->resource;
    }
    
    /**
     * Create file handler
     * 
     * @param string $file
     * @param string $mode
     * @return \PSFee\File\Handler
     */
    public static function create($file, $mode)
    {
        $instance = new static();
        $instance->setFile($file);
        $instance->setMode($mode);
        $instance->open();
        return $instance;
    }
}
