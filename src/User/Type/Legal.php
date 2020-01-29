<?php
namespace PSFee\User\Type;

use PSFee\User\Type;
use PSFee\Config;

class Legal extends Type
{
    /**
     * Calculate commission fee 
     * 
     * @return float
     */
    public function calculateCommissionFee()
    {
        $config = Config::getInstance();
        $feePercentage = $config->dot('commission.legal.fee_percentage');
        $minFee = $config->dot('commission.legal.min_fee');
        $fee = $feePercentage * $this->userOperation->getAmount() / 100;
        
        if ($fee < $minFee) {
            $fee = $minFee;
        }
        
        return $fee;
    }
}
