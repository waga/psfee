<?php
namespace PSFee\Util;

class File
{
    /**
     * Get file info
     * 
     * @param string $file
     * @return array File info
     */
    public static function getInfo($file)
    {
        return pathinfo($file);
    }
}
