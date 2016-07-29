<?php

	ob_start();
	//session_start();
	//session_regenerate_id(true);
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

	if (!defined("_WASD_")) exit;

	/* DEFINE DIR FOR SHORTER CODING*/
	define( 'ROOT_DIR', realpath( dirname(__FILE__) . '/..' ) );
	define( 'APP_DIR', realpath( ROOT_DIR . '/app'  ) );
	define( 'CONT_DIR', realpath( ROOT_DIR . '/controllers'  ) );
	define( 'MODELS_DIR', realpath( ROOT_DIR . '/models'  ) );
	define( 'ACP_DIR', realpath( ROOT_DIR . '/acp'  ) );
	define( 'VIEWS_DIR', realpath( APP_DIR . '/views'  ) );
	define( 'THEMES_DIR', realpath( APP_DIR . '/themes'  ) );
	define( 'PLUGINS_DIR', realpath( APP_DIR . '/plugins'  ) );
	define( 'LIB_PATH', realpath( ROOT_DIR . '/lib' ) );
	define( 'LANG_PATH', realpath( ROOT_DIR . '/languages' ) );

	/* SPECIFIC ERROR LOG FILE */
	@ini_set("log_errors" , "1");
	@ini_set("error_log" , ROOT_DIR.'/error-log.txt');
	@ini_set("display_errors" , "0");

	///////////////////// INCLUDES ///////////////////////
	///////////////////// HELPER ///////////////////////
	require 'helper.php';
	require APP_DIR.'/helper.php';
	///////////////////// EVENTS ///////////////////////
	require 'events.php';
	require APP_DIR.'/events.php';

	///////////////////// OTHERS ///////////////////////
	require ROOT_DIR . '/lib/autoload.php';
	require ROOT_DIR . '/models/Session.php';
	include LIB_PATH. '/Vendor/shortcodes.php';
	
	WASD::loadConfig(ROOT_DIR."/config.php");
	WASD::setDB();
	
	$session = new model_Session;

	/*  Calling object */
	$router = new Vendor\AltoRouter();

	// DECLARE GLOBAL TEMPLATE
	$template = new Template();
	WASD::loadLanguage( C('app.language', 'English') );

	/* WEB PATH AND WEB URL */

	$parts = explode("/", $_SERVER["PHP_SELF"]);
	$key = array_search("index.php", $parts);
	if ($key !== false) WASD::$webPath = implode("/", array_slice($parts, 0, $key));
	WASD::$webURL = WASD::webURL();

	/* PLUGINS */
	foreach (C("app.enabledPlugins") as $k=>$plugin) {
		if (file_exists($file = PLUGINS_DIR .'/'. sanitizeFileName($plugin). "/events.php")) 
			include $file;
	}

	/* OTHERS */

	date_default_timezone_set(C('app.timezone'));
	$now = date("Y-m-d H:i:s");

	undoRegisterGlobals();

	if (get_magic_quotes_gpc()) {
	    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
	    while (list($key, $val) = each($process)) {
	        foreach ($val as $k => $v) {
	            unset($process[$key][$k]);
	            if (is_array($v)) {
	                $process[$key][stripslashes($k)] = $v;
	                $process[] = &$process[$key][stripslashes($k)];
	            } else {
	                $process[$key][stripslashes($k)] = stripslashes($v);
	            }
	        }
	    }
	    unset($process);
	}

	