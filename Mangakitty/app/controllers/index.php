<?php

	if (!defined("_WASD_")) exit;


	/*******************************************************
	* TEMPLATE  *
	********************************************************/

	$replace = 	array('{homeTitle}'=>C('app.title'));
	$template->title = strtr(C('app.homeTitle'), $replace);
	$template->description = strtr(C('app.homeDescription'), $replace);
	$template->keywords = strtr(C('app.homeKeywords'), $replace);

	$template->header = $template->render('header.php');
	$template->topHeader = $template->render('topheader.php');
	$template->navigator = $template->render('navigator.php');

	$template->content = $template->render('index.php');

	$template->sidebar = $template->render('sidebar.php');

	$template->footer = $template->render('footer.php');

	echo $template->render('main.php');

	
