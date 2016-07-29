<?php

	$template->title = T('ADMIN CP') .' - '. T('USER') .' '. strtoupper($action);

	$user = new model_User();


	if(R('action') != NULL & R('action') == 'add'){
		if(!$user->validateUsername(R('username'))){
			$template->error = T('Invalid Username', 'Username must between 3 to 16 characters and only contains characters, number, underscore or hyphen');
			$_POST['username'] = '';
		}else if(!filter_var(R('email'), FILTER_VALIDATE_EMAIL)){
			$template->error = T('Invalid Email Address');
			$_POST['email'] = '';
		}else if(count($user->search( array('username'=>R('username'),'LIMIT'=>'1') ))){
			$template->error = T('User-name-exist');
			$_POST['username'] = '';
		}else if(count($user->search( array('email'=>R('email'),'LIMIT'=>'1') ))){
			$template->error = T('Email-exist');
			$_POST['email'] = '';
		}else{
			adminLog(sprintf(T('Added a user (%1s)'), R('username')));
			$array = array( 'username'=>R('username'),
							'email'=>R('email'),
							'password'=>pw(R('password')),
							'role'=>R('role'),
							'confirmedEmail'=>'1',
							'preferences'=>json_encode(array('avatar'=>C('app.defaultAvatar')))
						);
			$userId = $user->add($array);
			event('acp_user_added', $userId);
			$template->info = sprintf(T('ad-add-user-success', 'User "%1$s" (ID: %2$s) successfully added'), R('username'), $userId);
			$_POST['username'] = $_POST['email'] = '';
		}

	}


	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->roles = $user->roles;
	$template->content = $template->render('/acp/views/user-add.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
