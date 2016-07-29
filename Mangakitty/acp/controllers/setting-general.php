<?php
	
	if (!defined("_WASD_")) exit;

	$template->title = T('ADMIN CP') .' - '. T('SETTINGS: General');

	if(R('action') == 'update'){
		if($_POST['dateFormat'] == 'custom'){ $_POST['dateFormat'] = $_POST['dateFormatCustom']; unset($_POST['dateFormatCustom']);}
		if($_POST['timeFormat'] == 'custom'){ $_POST['timeFormat'] = $_POST['timeFormatCustom']; unset($_POST['timeFormatCustom']);}
		WASD::writeConfig($_POST);
		event('setting-general-updated' , '');
	}

	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/setting-general.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
