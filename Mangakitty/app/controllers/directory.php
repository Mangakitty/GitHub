<?php

	if (!defined("_WASD_")) exit;





	/*******************************************************
	* TEMPLATE  *
	********************************************************/

	$page = R('page') != '' ? R('page') : '1';

	$replace = 	array('{homeTitle}'=>C('app.title'), '{page}'=>$page);
	$template->title = strtr(C('app.directoryTitle'), $replace);
	$template->description = strtr(C('app.directoryDescription'), $replace);
	$template->keywords = strtr(C('app.directoryKeywords'), $replace);
	

	$template->header = $template->render('header.php');
	$template->topHeader = $template->render('topheader.php');
	$template->navigator = $template->render('navigator.php');

	$template->content = $template->render('directory.php');
	
	$template->sidebar = $template->render('sidebar.php');
	
	$template->footer = $template->render('footer.php');

	echo $template->render('main.php');

	
