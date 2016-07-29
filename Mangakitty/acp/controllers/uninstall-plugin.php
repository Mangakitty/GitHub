<?php

	$plugin = new model_Plugin();
	$template->plugins = $plugin->all();
	$pluginName = $pparams['code'];

	if(C('installed.'.$pluginName) == '1'){
		if(file_exists($file = PLUGINS_DIR . "/$pluginName/uninstall.php")) include PLUGINS_DIR . "/$pluginName/uninstall.php";
	
		// SAVE CONFIG -> installed.$pluginName = 1
		WASD::writeConfig(array("$pluginName"=>'0'),'installed');
	
		// REDECLARE
	
		$plugin = new model_Plugin();
		$template->plugins = $plugin->all();
		$template->noty = array('info',T('Plugin successfully uninstalled'));
		adminLog(sprintf(T('Uninstalled a plugin (%1s)'), $pluginName));
	}else{
		$template->noty = array('danger',T('This plugin has not been installed'));
	}

	// HEADER 

	$template->title = T('ADMIN CP') .' - '. T('Install plugin') . ' ' . $template->plugins[$pluginName]['name'] ;

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/manage-plugin.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
