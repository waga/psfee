<?php
namespace PSFee;

use DateTime;
use PSFee\User\OperationList as UserOperationList;
use PSFee\User\Operation as UserOperation;

class FeeCalculator
{
    /**
     * User operations
     * 
     * @var array
     */
    protected $userOperation;
    
    /**
     * Set user operation
     * 
     * @param \PSFee\User\Operation $userOperation
     * @return \PSFee\FeeCalculator
     */
    public function setUserOperation(UserOperation $userOperation)
    {
        $this->userOperation = $userOperation;
        return $this;
    }
    
    /**
     * Calculate fees
     * 
     * @param \PSFee\User\OperationList $userOperations
     * @return float
     */
    public function calculate(UserOperationList $userOperations)
    {
        return $this->userOperation
            ->getOperationType()
            ->setUserOperation($this->userOperation)
            ->setUserOperationList($userOperations)
            ->calculateCommissionFee();
    }
}
