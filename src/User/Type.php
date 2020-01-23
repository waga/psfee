<?php
namespace PSFee\User;

use Exception;
use PSFee\User\Operation as UserOperation;
use PSFee\User\OperationList as UserOperationList;
use PSFee\Currency;
use PSFee\Currency\EUR;

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
        $class = __NAMESPACE__ .'\Type\\'. ucfirst($type);
        
        if (!class_exists($class)) {
            throw new Exception('User type "'. $class .'" not found!');
        }
        
        $instance = new $class;
        $instance->setBaseCurrency(new EUR());
        return $instance;
    }
}
