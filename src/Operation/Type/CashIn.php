<?php
namespace PSFee\Operation\Type;

use PSFee\Operation\Type;
use PSFee\Config;

class CashIn extends Type
{
    /**
     * Calculate commission fee
     * 
     * @return float $fee
     */
    public function calculateCommissionFee()
    {
        $config = Config::getInstance();
        $feePercentage = $config->dot('commission.cash_in.fee_percentage');
        $maxFee = $config->dot('commission.cash_in.max_fee');
        $fee = $feePercentage * $this->userOperation->getAmount() / 100;
        
        if ($fee > $maxFee) {
            $fee = $maxFee;
        }
        
        return $fee;
    }
}
