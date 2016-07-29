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
        if(file_exists(LIB_PATH.'/'.$fileName)){
            require $fileName;
        }else if(file_exists(MODELS_PATH.'/'.$fileName)){
            require MODELS_PATH.'/'.$fileName;
        }else if(file_exists(APP_DIR.'/models/'.$fileName)){
            require APP_DIR.'/models/'.$fileName;
        }else{
            exit(dump($fileName));
        }
    }

    spl_autoload_register('autoload');