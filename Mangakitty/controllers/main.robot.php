<?php

	if (!defined("_WASD_")) exit;

	$router->setBasePath(WASD::$webPath);

	/*******************************************************
	* INCLUDE ROUTER AND SHORTCODES  *
	********************************************************/
	include 'main.router.php';
	include APP_DIR.'/router.php';
	include APP_DIR.'/shortcodes.php';

	// INCLUDE ROUTING & SHORTCODES FROM PLUGINS IF EXIST
	foreach (C("app.enabledPlugins") as $plugin) {
		if (file_exists($file = PLUGINS_DIR .'/'.sanitizeFileName($plugin). "/router.php"))
			include $file;
		if (file_exists($shotcodes = PLUGINS_DIR .'/'.sanitizeFileName($plugin). "/shortcodes.php"))
			include $shotcodes;
	}

	// FROM THEMES
	if (file_exists($file = THEMES_DIR .'/'.sanitizeFileName(C('app.theme')). "/router.php"))
		include $file;
	if (file_exists($shotcodes = THEMES_DIR .'/'.sanitizeFileName(C('app.theme')). "/shortcodes.php"))
		include $shotcodes;

			
	/*******************************************************
	* LOAD CONTROLLERS AND MODEL FROM ROUTER DATA  *
	********************************************************/
	

	$the_page = $router->match();
	$pparams = $the_page['params'];
	if(is_array($pparams)) WASD::set_pparams($pparams);

	if(is_array($the_page['target'])){
		// LOAD MODELS
		$models = WASD::load_models($the_page['target']);
		foreach ($models as &$file) {
			include $file;
		}
		// LOAD CONTROLLERS
		$controllers = WASD::load_controllers($the_page['target']);
		foreach ($controllers as &$file) {
			include $file;
		}
	}else{
		event('render_404', '');
	}
