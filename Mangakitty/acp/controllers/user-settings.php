<?php
	
	if (!defined("_WASD_")) exit;

	$template->title = T('ADMIN CP') .' - '. T('User settings');


	$user = new model_User();

	if(R('action') == 'update'){

		if(@getimagesize($_FILES["avatar"]["tmp_name"]) !== false){
		// IF AVATAR SELECTED
			directory_is_writable(ROOT_DIR.'/upload/avatar');
			$upload = secure_img_upload($_FILES["avatar"], ROOT_DIR.'/upload/avatar');
			if(is_array($upload)){
				$template->message = array('danger', $upload['m'], 'avatar');
			}else{
        		$img = new Vendor\SimpleImage();
        		$img->load($upload)->adaptive_resize(80, 80)->save($upload); // RESIZE
        		WASD::writeConfig(array('defaultAvatar'=>str_replace(ROOT_DIR, '', $upload)));
			}
		}else{
			$template->message = array('danger', T('Invalid image extension or filesize are too big'), 'avatar');
		}	
		

		WASD::writeConfig($_POST);
		redirect(currentUrl());
	}

	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->roles = $user->roles;
	$template->content = $template->render('/acp/views/user-settings.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
