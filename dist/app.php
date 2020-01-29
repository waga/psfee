<?php

error_reporting(E_ALL);

require __DIR__ .'/../autoload.php';

$config = \PSFee\Config::getInstance()
    ->set('../config/config.php');

$application = (new \PSFee\Application\CLI())
    ->configure($config)
    ->initialize()
    ->run($argv);
