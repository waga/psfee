<?php
namespace PSFee\User;

use DateTime;
use PSFee\User\Operation;

class OperationList
{
    /**
     * User operations
     * 
     * @var array
     */
    protected $userOperations = array();
    
    /**
     * Remove expired
     * 
     * @param int $userID
     * @param DateTime $date
     * @return \PSFee\User\OperationList
     */
    public function removeExpired($userID, DateTime $date)
    {
        if (!($userOperations = $this->get($userID))) {
            return $this;
        }
        
        $expirationDateTime = $this->getExpirationDate($date);
        
        foreach ($userOperations as $key => $userOperation) {
            if ($userOperation->getDate()->getTimestamp() < $expirationDateTime) {
                unset($this->userOperations[$userID][$key]);
            }
        }
        
        return $this;
    }
    
    /**
     * Add
     * 
     * @param int $userID
     * @param \PSFee\User\Operation $operation
     * @return \PSFee\User\OperationList
     */
    public function add($userID, Operation $operation)
    {
        $this->userOperations[$userID][] = $operation;
        return $this;
    }
    
    /**
     * Get
     * 
     * @param int $userID
     * @return array of \PSFee\User\OperationList|null
     */
    public function get($userID)
    {
        if (array_key_exists($userID, $this->userOperations)) {
            return $this->userOperations[$userID];
        }
        return null;
    }
    
    /**
     * Get expiration date
     * 
     * @param DateTime $date
     * @return int
     */
    public function getExpirationDate(DateTime $date)
    {
        return strtotime('last monday', $date->getTimestamp());
    }
    
    /**
     * Get operations
     * 
     * @param int $userID
     * @param int $length
     * @param int $offset
     * @return array
     */
    public function getOperations($userID, $length, $offset = 0)
    {
        if (!($userOperations = $this->get($userID))) {
            return array();
        }
        return array_slice($userOperations, $offset, $length);
    }
}
