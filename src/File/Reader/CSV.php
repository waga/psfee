<?php
namespace PSFee\File\Reader;

use PSFee\File\Reader;

class CSV extends Reader
{
    /**
     * Read csv file
     * 
     * @return array Rows from the file
     */
    public function read()
    {
        $rows = array();
        while (($row = fgetcsv($this->handler->getResource(), 0, ',', '\\')) !== false) {
            $rows[] = $row;
        }
        return $rows;
    }
}
