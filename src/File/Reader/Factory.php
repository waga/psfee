<?php
namespace PSFee\File\Reader;

use PSFee\Exception\FileReaderException;

class Factory
{
    /**
     * Create file reader
     * 
     * @throw \Exception
     * @param string $type
     * @return \PSFee\File\Reader
     */
    public static function create(string $type, array $params = array())
    {
        if (!class_exists($type)) {
            throw new FileReaderException('File reader "'. $type .'" not found!');
        }
        
        if (!is_subclass_of($type, __NAMESPACE__)) {
            throw new FileReaderException('File reader "'. $type 
                .'" must inherit "'. __NAMESPACE__ .'"!');
        }
        
        if (!array_key_exists('handler', $params) || !$params['handler']) {
            throw new FileReaderException('Missing handler parameter!');
        }
        
        $reader = new $type();
        $reader->setHandler($params['handler']);
        return $reader;
    }
}
