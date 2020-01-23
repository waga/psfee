<?php
namespace PSFee\User\Type;

use PSFee\User\Type;

class Legal extends Type
{
    /**
     * Calculate commission fee 
     * 
     * @return float
     */
    public function calculateCommissionFee()
    {
        $fee = 0.3 * $this->userOperation->getAmount() / 100;
        
        if ($fee < 0.5) {
            $fee = 0.5;
        }
        
        return $fee;
    }
}
