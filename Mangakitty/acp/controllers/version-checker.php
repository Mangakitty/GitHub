<?php 
	if (!defined("_WASD_")) exit; 

	$template->title = T('ADMIN CP') .' - '. T('Check for update') .' '. strtoupper($action);

	$version_check = versionChecker();
	if($version_check){
		$template->color = T('Yellow');
		$template->message = T('There is a newer version available for update').'<br />';
		$template->message .= sprintf(T('Current version: %1s'), '<strong>'.C('app.version').'</strong>').'<br />'.sprintf(T('Lastest version: %1s'), '<strong>'.trim(file_get_contents(C('app.remoteVersion'))).'</strong>');
	}else if(!$version_check){
		$template->color = T('Green');
		$template->message = T('Your version is up-to-date').'<br />';
		$template->message .= sprintf(T('Current version: %1s'), '<strong>'.C('app.version').'</strong>').'<br />'.sprintf(T('Lastest version: %1s'), '<strong>'.trim(file_get_contents(C('app.remoteVersion'))).'</strong>');
	}else{
		$template->color = T('Red');
		$template->message = T('Unable to check for new version');
	}


	// HEADER 
	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/version-check.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

?>