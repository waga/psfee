<?php
namespace PSFee\Operation;

use Exception;
use PSFee\User\Operation as UserOperation;
use PSFee\User\OperationList as UserOperationList;
use PSFee\Operation\Type\{CashIn, CashOut};
use PSFee\Exception\OperationException;

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
        if ($type == 'cash_in') {
            return new CashIn();
        } else if ($type == 'cash_out') {
            return new CashOut();
        }
        throw new OperationException('Invalid operation type "'. $type .'"!');
    }
}
