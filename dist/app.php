<?php

error_reporting(E_ALL);

require __DIR__ .'/../autoload.php';
require __DIR__ .'/../util.php';

$config = \PSFee\Config::getInstance()
    ->set('../config/config.php');

$application = (new \PSFee\Application\CLI())
    ->configure($config)
    ->run($argv);
