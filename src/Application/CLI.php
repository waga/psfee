<?php
namespace PSFee\Application;

use DateTime;
use Exception;
use PSFee\Application;
use PSFee\File\Reader\Factory as FileReaderFactory;
use PSFee\File\Handler as FileHandlerFactory;
use PSFee\Util\CLI as CLIUtil;
use PSFee\Util\Application as AppUtil;
use PSFee\Util\File as FileUtil;
use PSFee\Util\Price as PriceUtil;
use PSFee\FeeCalculator;
use PSFee\User\Operation as UserOpration;
use PSFee\User\OperationList as UserOperationList;
use PSFee\User\Type as UserType;
use PSFee\Operation\Type as OperationType;
use PSFee\Currency;

class CLI extends Application
{
    /**
     * Main dispatcher
     * 
     * @param array $arguments Application arguments
     */
    public function run(array $arguments = array())
    {
        try {
            list($scriptFile, $inputFile) = $this->parseArguments($arguments);
            $this->validateInputFile($inputFile);
            $inputFileRows = $this->readInputFile($inputFile);
            $fees = $this->calculateFees($inputFileRows);
            $this->displayFees($fees);
        } catch (Exception $e) {
            CLIUtil::showErrorAndExit($e->getMessage());
        }
    }
    
    /**
     * Parse command line arguments
     * 
     * @param array $arguments Command line arguments
     * @return array Of script file and input file
     */
    protected function parseArguments(array $arguments)
    {
        $scriptFile = array_shift($arguments);
        
        if (count($arguments) != 1) {
            CLIUtil::showError('Invalid argument count!');
            AppUtil::showUsageAndExit($scriptFile);
        }
        
        $inputFile = array_shift($arguments);
        
        if (!$inputFile) {
            CLIUtil::showErrorAndExit('Invalid input file "'. $inputFile .'"!');
        }
        
        return [$scriptFile, $inputFile];
    }
    
    /**
     * Validate input file
     * 
     * @param string $inputFile Input file
     */
    protected function validateInputFile(string $inputFile)
    {
        $pathInfo = FileUtil::getInfo($inputFile);
        $validInputFileExtensions = $this->config->get('validInputFileExtensions');
        
        if (!in_array($pathInfo['extension'], $validInputFileExtensions)) {
            CLIUtil::showErrorAndExit('Invalid file extension "'. 
                $pathInfo['extension'] .'" (valid input file extentions: '. 
                join(', ', $validInputFileExtensions) .')!');
        }
        
        if (!file_exists($inputFile)) {
            CLIUtil::showErrorAndExit('File "'. $inputFile .'" not found!');
        }
    }
    
    /**
     * Read input file
     * 
     * @param string $inputFile
     * @return array Of file rows
     */
    protected function readInputFile(string $inputFile)
    {
        $pathInfo = FileUtil::getInfo($inputFile);
        $handler = FileHandlerFactory::create($inputFile, 'r');
        $reader = FileReaderFactory::create(
            $this->config->dot('fileReader.'. $pathInfo['extension']), 
            array(
                'handler' => $handler
            )
        );
        return $reader->read();
    }
    
    /**
     * Calculate fees
     *
     * @param array $inputFileRows
     * @return array $fees
     */
    protected function calculateFees(array $inputFileRows)
    {
        $fees = array();
        $feeCalculator = new FeeCalculator();
        $userOperations = new UserOperationList();
        
        foreach ($inputFileRows as $row) {
            
            $userOperation = UserOpration::createFromNumericArray($row);
            $userID = $userOperation->getUserID();

            $userOperations->removeExpired($userID, $userOperation->getDate());
            $userOperations->add($userID, $userOperation);
            
            $fee = $feeCalculator
                ->setUserOperation($userOperation)
                ->calculate($userOperations);
            $fee = PriceUtil::ceil($fee, 
                $userOperation->getCurrency()->getPrecision());
            $fee = number_format($fee, 
                $userOperation->getCurrency()->getPrecision(), '.', '');
            $fees[] = (string) $fee;
        }
        
        return $fees;
    }
    
    /**
     * Display fees
     *
     * @param array $fees
     */
    protected function displayFees(array $fees)
    {
        foreach ($fees as $fee) {
            CLIUtil::showMessage($fee);
        }
    }
}
