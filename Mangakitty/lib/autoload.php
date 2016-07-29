<?php

    // AUTO LOAD CLASS WITH ITS NAMESPACE\NAME

    if (!defined("_WASD_")) exit;


    function autoload($className)
    {
        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        if(!strposa($className, array('Exception','Controller','model')) ){
            require $fileName;
        }  
    }

    spl_autoload_register('autoload');