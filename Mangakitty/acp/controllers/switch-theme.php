<?php

	$theme = new model_Theme();
	$template->themes = $theme->all();

	WASD::writeConfig(array('theme'=>$pparams['code']),'app');		
	adminLog(sprintf(T('Activated a theme (%1s)'), $pparams['code']));
	$template->noty = array('info',T('Theme successfully activated'));
	
	// HEADER 

	$template->title = T('ADMIN CP') .' - '. T('Themes: Management');

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/manage-theme.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
