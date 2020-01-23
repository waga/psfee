<?php
namespace PSFee\User\Type;

use PSFee\User\Type;
use PSFee\Currency\Converter;
use PSFee\Operation\Type\CashOut;

class Natural extends Type
{
    /**
     * Calculate commission fee 
     * 
     * @return float
     */
    public function calculateCommissionFee()
    {
        $currentOperationCurrency = $this->userOperation->getCurrency();
        $currentOperationAmount = $this->userOperation->getAmount();
        
        $currentOperationAmount = $currentOperationCurrency->convert(
            $this->baseCurrency, $currentOperationAmount);
        
        $prevOperationsInfo = $this->getPreviousOperationsCalc();
        $totalSum = $currentOperationAmount + $prevOperationsInfo['amount'];
        
        if ($prevOperationsInfo['count'] < 3 && $totalSum <= 1000) {
            return 0;
        }
        
        $amount = $currentOperationAmount;
        
        if ($prevOperationsInfo['amount'] <= 1000 && $totalSum > 1000) {
            $amount = $totalSum - 1000;
        }
        
        $amount = $this->baseCurrency->convert(
            $currentOperationCurrency, $amount);
        
        $fee = 0.3 * $amount / 100;
        return $fee;
    }
    
    /**
     * Get calculations over previous operations 
     * 
     * @return array
     */
    protected function getPreviousOperationsCalc()
    {
        $userOperations = $this->userOperationList
            ->get($this->userOperation->getUserID());
        array_pop($userOperations);
        
        $operationAmountSum = 0;
        $operationCount = 0;
        
        foreach ($userOperations as $userOperation) {
            
            if (!$userOperation->getOperationType() instanceof CashOut) {
                continue;
            }
            
            $amount = $userOperation->getAmount();
            $currency = $userOperation->getCurrency();
            $amount = $currency->convert($this->baseCurrency, $amount);
            
            $operationAmountSum += $amount;
            $operationCount++;
        }
        
        return array(
            'amount' => $operationAmountSum,
            'count' => $operationCount
        );
    }
}
