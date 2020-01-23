<?php
namespace PSFee\File;

use PSFee\File\Handler;

abstract class Reader
{
    /**
     * File handler
     * 
     * @var \PSFee\File\Handler
     */
    protected $handler;
    
    /**
     * Set handler
     * 
     * @param \PSFee\File\Handler $handler
     * @return \PSFee\File\Reader
     */
    public function setHandler(Handler $handler)
    {
        $this->handler = $handler;
        return $this;
    }
    
    /**
     * Read file
     * 
     * @return mixed
     */
    abstract public function read();
}
