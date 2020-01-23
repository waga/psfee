<?php

if (!defined('PHP_SAPI_IS_WEB'))
{
    define('PHP_SAPI_IS_WEB', in_array(PHP_SAPI, array('aolserver',
        'apache', 'apache2filter', 'apache2handler', 'caudium', 'cgi',
        'cgi-fcgi', 'fpm-fcgi', 'phttpd', 'pi3web', 'thttpd', 'webjames')));
}

if (!defined('PRE_OPEN'))
{
    define('PRE_OPEN', (PHP_SAPI_IS_WEB ? '<pre>' : ''));
}

if (!defined('PRE_CLOSE'))
{
    define('PRE_CLOSE', PHP_SAPI_IS_WEB ? '</pre>' : '');
}

if (!function_exists('d'))
{
    function d()
    {
        echo PRE_OPEN;
        foreach (func_get_args() as $a)
        {
            print_r($a);
            echo PHP_EOL;
        }
        echo PRE_CLOSE;
    }
}

if (!function_exists('v'))
{
    function v()
    {
        echo PRE_OPEN;
        foreach (func_get_args() as $a)
        {
            var_dump($a);
            echo PHP_EOL;
        }
        echo PRE_CLOSE;
    }
}
