<?php
namespace PSFee\Operation;

use Exception;
use PSFee\User\Operation as UserOperation;
use PSFee\User\OperationList as UserOperationList;

abstract class Type
{
    /**
     * User operation
     * 
     * @var \PSFee\User\Operation
     */
    protected $userOperation;
    
    /**
     * User operation list
     * 
     * @var array
     */
    protected $userOperationList;
    
    /**
     * Calculate commission fee
     * 
     * @return float
     */
    abstract public function calculateCommissionFee();
    
    /**
     * Set user operation
     * 
     * @param \PSFee\User\Operation $userOperation
     * @return \PSFee\Operation\Type
     */
    public function setUserOperation(UserOperation $userOperation)
    {
        $this->userOperation = $userOperation;
        return $this;
    }
    
    /**
     * Set user operation
     * 
     * @param \PSFee\User\OperationList $userOperationList
     * @return \PSFee\Operation\Type
     */
    public function setUserOperationList(
        UserOperationList $userOperationList)
    {
        $this->userOperationList = $userOperationList;
        return $this;
    }
    
    /**
     * Create operation type
     * 
     * @param string $type
     * @return \PSFee\Operation\Type
     */
    public static function create(string $type)
    {
        $class = ucfirst(str_replace('_', '', $type));
        $class = __NAMESPACE__ .'\Type\\'. $class;
        
        if (!class_exists($class)) {
            throw new Exception('Operation type "'. $class .'" not found!');
        }
        
        $instance = new $class;
        return $instance;
    }
}
