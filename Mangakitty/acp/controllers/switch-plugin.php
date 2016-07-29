<?php

	$plugin = new model_Plugin();
	$template->plugins = $plugin->all();
	$pluginName = $pparams['code'];

	if(in_array($pluginName, C('app.enabledPlugins'))){
		$enabledPlugins = C('app.enabledPlugins');
		if(($key = array_search($pluginName, $enabledPlugins)) !== false) $enabledPlugins = array_diff($enabledPlugins, [$pluginName]); 
		WASD::writeConfig(array("enabledPlugins"=>$enabledPlugins),'app');
		$template->noty = array('info',T('Plugin successfully disabled'));		
		adminLog(sprintf(T('Disabled a plugin (%1s)'), $pluginName));
	}else{
		$enabledPlugins = C('app.enabledPlugins');
		$enabledPlugins[] = $pluginName;
		WASD::writeConfig(array("enabledPlugins"=>$enabledPlugins),'app');
		$template->noty = array('info',T('Plugin successfully enabled'));		
		adminLog(sprintf(T('Enabled a plugin (%1s)'), $pluginName));
	}

	// REDECLARE
	
	$plugin = new model_Plugin();
	$template->plugins = $plugin->all();

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

	
