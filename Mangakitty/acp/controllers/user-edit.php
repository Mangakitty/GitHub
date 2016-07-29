<?php

	if (!defined("_WASD_")) exit;

	$template->title = T('ADMIN CP') .' - '. T('USER') .' '. strtoupper($action);

	$user = new model_User();
	$user->getBy('userId', $pparams['userId']);

	$template->username = $user->username;
	$template->email = $user->email;
	$template->role = $user->role;
	$template->confirmedEmail = $user->confirmedEmail;
	

	if(R('action') != NULL & R('action') == 'edit'){
		if(R('username') != $user->username && !$user->validateUsername(R('username'))){
			$template->noty = array('error', T('Invalid Username', 'Username must between 3 to 16 characters and only contains characters, number, underscore or hyphen'));
		}else if(R('email') != $user->email && !filter_var(R('email'), FILTER_VALIDATE_EMAIL)){
			$template->noty = array('error', T('Invalid Email Address'));
		}else if(R('username') != $user->username && count($user->search( array('username'=>R('username'),'LIMIT'=>'1') ))){
			$template->noty = array('error', T('User-name-exist'));
		}else if(R('email') != $user->email && count($user->search( array('email'=>R('email'),'LIMIT'=>'1') ))){
			$template->noty = array('error', T('Email-exist'));
		}else{
			adminLog(sprintf(T('Edited a user (#%1s - %2s)'), $pparams['userId'], R('username')));
			$array = array( 'username'=>R('username'),
							'email'=>R('email'),
							'role'=>R('role'),
							'confirmedEmail'=>R('confirmedEmail'),
						);
			if(R('password') != '') $array['password'] = pw(R('password'));
			$userId = $user->edit($pparams['userId'], $array);
			$template->noty = array('info',T('User successfully updated'));
			// RE-DECLARE VARIABLES
			$user->getBy('userId', $pparams['userId']);
			$template->username = $user->username;
			$template->email = $user->email;
			$template->role = $user->role;
			$template->confirmedEmail = $user->confirmedEmail;

		}

	}

	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->roles = $user->roles;
	$template->content = $template->render('/acp/views/user-edit.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
