<?php
namespace PSFee\Operation\Type;

use PSFee\Operation\Type;

class CashOut extends Type
{
    /**
     * Calculate commission fee
     * 
     * @return float
     */
    public function calculateCommissionFee()
    {
        return $this->userOperation
            ->getUserType()
            ->setUserOperation($this->userOperation)
            ->setUserOperationList($this->userOperationList)
            ->calculateCommissionFee();
    }
}
