<?php
	
	if (!defined("_WASD_")) exit;

	$template->title = T('ADMIN CP') .' - '. T('Plugin: Management');

	$theme = new model_Theme();
	$template->themes = $theme->all();

	if(R('action') == 'update'){
		
	}

	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/download-theme.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
