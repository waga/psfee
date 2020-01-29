<?php
namespace PSFee\User;

use Exception;
use PSFee\User\Operation as UserOperation;
use PSFee\User\OperationList as UserOperationList;
use PSFee\Currency;
use PSFee\Currency\EUR;
use PSFee\User\Type\{Legal,Natural};
use PSFee\Exception\UserException;

abstract class Type
{
    /**
     * Current user operation
     * 
     * @var \PSFee\User\Operation
     */
    protected $userOperation;
    
    /**
     * Weekly user operations (from monday)
     * 
     * @var array of \PSFee\User\Operation
     */
    protected $userOperationList;
    
    /**
     * Base currency
     * 
     * @var \PSFee\Currency
     */
    protected $baseCurrency;
    
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
     * @return \PSFee\User\Type
     */
    public function setUserOperation(UserOperation $userOperation)
    {
        $this->userOperation = $userOperation;
        return $this;
    }
    
    /**
     * Set user operation list
     * 
     * @param \PSFee\User\OperationList $userOperationList
     * @return \PSFee\User\Type
     */
    public function setUserOperationList(
        UserOperationList $userOperationList)
    {
        $this->userOperationList = $userOperationList;
        return $this;
    }
    
    /**
     * Set base currency
     * 
     * @param \PSFee\Currency $baseCurrency
     * @return \PSFee\User\Type\Natural
     */
    public function setBaseCurrency(Currency $baseCurrency)
    {
        $this->baseCurrency = $baseCurrency;
        return $this;
    }
    
    /**
     * Create new user type
     * 
     * @param string $type
     * @return \PSFee\User\Type
     */
    public static function create(string $type)
    {
        if ($type == 'legal') {
            return (new Legal())->setBaseCurrency(new EUR());
        } else if ($type == 'natural') {
            return (new Natural())->setBaseCurrency(new EUR());
        }
        throw new UserException('Invalid user type "'. $type .'"!');
    }
}
