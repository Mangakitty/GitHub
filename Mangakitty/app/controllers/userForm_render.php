<?php if (!defined("_WASD_")) exit;

	$template->customCss = 'label{font-weight: unset}';
	$template->header = $template->render('header.php');
	$template->topHeader = $template->render('topheader.php');
	$template->navigator = $template->render('navigator.php');

	$template->sidebar = $template->render('sidebar.php');
	
	if(!isset($template->content)){
		if(R('page') == 'register'){
			$template->content = $template->render('register.php');
		}elseif(R('page') == 'login'){
			$template->content = $template->render('login.php');
		}
	}

	$template->footer = $template->render('footer.php');

	echo $template->render('main.php');

