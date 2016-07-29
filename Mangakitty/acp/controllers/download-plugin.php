<?php
	
	if (!defined("_WASD_")) exit;

	$template->title = T('ADMIN CP') .' - '. T('Plugin: Management');

	$plugin = new model_Plugin();
	$template->plugins = $plugin->all();

	if(R('action') == 'update'){
		
	}

	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/download-plugin.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
