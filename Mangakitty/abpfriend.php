<?php

	if (!defined("_WASD_")) exit;

	$template->title = T('Admin Control Panel') .' - '. T2up('Flat Social Bar');
	


	/*******************************************************
	* TEMPLATING  *
	********************************************************/

	// HEADER 

	// $template->customJs .= ""

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/app/plugins/FlatSocialBarUnikUnik/views/flatsocialbar.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
