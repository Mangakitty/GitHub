<?php

	$template->title = T('ADMIN CP') .' - '. T('USER') .' '. strtoupper($action);

	if(R('action') != NULL & R('action') == 'add'){
		$user = new model_User();
		if(count($user->getByName(R('username')))){
			$template->error = T('User-name-exist');
			$_POST['username'] = '';
		}else if(count($user->getByEmail(R('email')))){
			$template->error = T('Email-exist');
			$_POST['email'] = '';
		}else{
			$array = array('username'=>R('username'),
							'email'=>R('email'),
							'password'=>pw(R('password')),
							'confirmedEmail'=>'1'
						);
			$userId = $user->add($array);
			$template->info = sprintf(T('ad-add-user-success', 'User "%1$s" (ID: %2$s) successfully added'), R('username'), $userId);
			$_POST['username'] = $_POST['email'] = '';
		}

	}


	// HEADER 

	$template->navigator = $template->render('/app/admincp/views/navigator.php');
	$template->header = $template->render('/app/admincp/views/header.php');


	// CONTENT
	$template->content = $template->render('/app/admincp/views/user-custom-fields.php');


	// FOOTER
	$template->footer = $template->render('/app/admincp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/app/admincp/views/main.php');

	
