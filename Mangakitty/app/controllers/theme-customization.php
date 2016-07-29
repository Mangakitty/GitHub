<?php

	$template->title = T('ADMIN CP') .' - '. T('Theme customization');

	if(R('action') == 'update'){
		WASD::writeConfig($_POST);
	}

	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('theme-customization.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
