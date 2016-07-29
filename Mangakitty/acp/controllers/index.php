<?php
	
	if (!defined("_WASD_")) exit;

	// USER MODEL
	require MODELS_DIR .'/User.php';
	$user = new model_User;
	$template->adminLog =  getAdminLog();

	$template->title = T('ADMIN CP');
	
	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');

	$template->content = $template->render('/acp/views/dashboard.php');

	$template->footer = $template->render('/acp/views/footer.php');

	echo $template->render('/acp/views/main.php');

	
