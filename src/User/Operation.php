<?php
namespace PSFee\User;

use DateTime;
use PSFee\Currency;
use PSFee\User\Type as UserType;
use PSFee\Operation\Type as OperationType;

class Operation
{
    /**
     * Date
     * 
     * @var \DateTime
     */
    protected $date = null;
    
    /**
     * User ID
     * 
     * @var int
     */
    protected $userID = -1;
    
    /**
     * User type
     * 
     * @var \PSFee\User\Type
     */
    protected $userType = null;
    
    /**
     * Operation type
     * 
     * @var \PSFee\Operation\Type
     */
    protected $operationType = null;
    
    /**
     * Amount
     * 
     * @var float
     */
    protected $amount = 0;
    
    /**
     * Currency
     * 
     * @var \PSFee\Currency
     */
    protected $currency = null;
    
    /**
     * Set date
     * 
     * @param DateTime $date
     * @return \PSFee\User\Operation
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;
        return $this;
    }
    
    /**
     * Get date
     * 
     * @return DateTime $date
     */
    public function getDate()
    {
        return $this->date;
    }
    
    /**
     * Set user id
     * 
     * @param int $userID
     * @return \PSFee\User\Operation
     */
    public function setUserID(int $userID)
    {
        $this->userID = $userID;
        return $this;
    }
    
    /**
     * Get user id
     * 
     * @return int
     */
    public function getUserID()
    {
        return $this->userID;
    }
    
    /**
     * Set user id
     * 
     * @param \PSFee\User\Type $userType
     * @return \PSFee\User\Operation
     */
    public function setUserType(UserType $userType)
    {
        $this->userType = $userType;
        return $this;
    }
    
    /**
     * Get user type
     * 
     * @return \PSFee\User\Type
     */
    public function getUserType()
    {
        return $this->userType;
    }
    
    /**
     * Set operation type
     * 
     * @param \PSFee\Operation\Type $operationType
     * @return \PSFee\User\Operation
     */
    public function setOperationType(OperationType $operationType)
    {
        $this->operationType = $operationType;
        return $this;
    }
    
    /**
     * Get operation type
     * 
     * @return \PSFee\Operation\Type
     */
    public function getOperationType()
    {
        return $this->operationType;
    }
    
    /**
     * Set amount
     * 
     * @param float $amount
     * @return \PSFee\User\Operation
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;
        return $this;
    }
    
    /**
     * Get amount
     * 
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }
    
    /**
     * Set currency
     * 
     * @param \PSFee\Currency $currency
     * @return \PSFee\User\Operation
     */
    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
        return $this;
    }
    
    /**
     * Get currency
     * 
     * @return \PSFee\Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }
    
    /**
     * Create user operation from numeric array
     * 
     * @param array $data
     * @return \PSFee\User\Operation
     */
    public static function createFromNumericArray(array $data)
    {
        $instance = (new static())
            ->setDate(new DateTime($data[0]))
            ->setUserID((int) $data[1])
            ->setUserType(UserType::create($data[2]))
            ->setOperationType(OperationType::create($data[3]))
            ->setAmount((float) $data[4])
            ->setCurrency(Currency::create($data[5]));
        return $instance;
    }
}
