<?php
namespace PSFee\Operation\Type;

use PSFee\Operation\Type;

class CashIn extends Type
{
    /**
     * Calculate commission fee
     * 
     * @return float $fee
     */
    public function calculateCommissionFee()
    {
        $fee = 0.03 * $this->userOperation->getAmount() / 100;
        
        if ($fee > 5) {
            $fee = 5;
        }
        
        return $fee;
    }
}
