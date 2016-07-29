<?php
	
	if (!defined("_WASD_")) exit;

	$template->title = T('ADMIN CP') .' - '. T('SETTINGS: Mailer');

	if(R('action') == 'update'){
		WASD::writeConfig($_POST, 'email');
		event('setting-mailer-updated', '');
	}

	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/setting-mailer.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
