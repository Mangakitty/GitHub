<?php

	if (!defined("_WASD_")) exit;

	if($_POST){
		if(@getimagesize($_FILES["avatar"]["tmp_name"]) !== false){
		// IF AVATAR SELECTED
			directory_is_writable(ROOT_DIR.'/upload/avatar');
			$upload = secure_img_upload($_FILES["avatar"], ROOT_DIR.'/upload/avatar');
			if(is_array($upload)){
				$template->message = array('danger', $upload['m'], 'avatar');
			}else{
        		$img = new Vendor\SimpleImage();
        		$img->load($upload)->adaptive_resize(80, 80)->save($upload); // RESIZE
        		$preferences = array_merge( session('preferences'), array('avatar'=>str_replace(ROOT_DIR, '', $upload)) );
        		if(session_get('preferences', 'avatar') != C('app.defaultAvatar')) unlink(ROOT_DIR.'/'.ltrim(session_get('preferences', 'avatar'), '/'));
        		session('preferences', $preferences);
        		WASD::$sql->update(C('app.db_prefix').'user', array('(JSON) preferences' => $preferences), array('userId'=>session_get('thisUser', 'userId'), 'LIMIT'=>'1'));
			}
		}
		if($_POST['password'] != ''){
			if($_POST['password'] != $_POST['repassword']){
				$template->message2 = array('danger', T('Password does not match the confirm password'), 'password');
			}else{
				$template->message2 = array('info', T('Password successfully changed'));
			}
		}
	}

	$template->title = C('app.title') .' &middot; '. T('Settings');

	$template->header = $template->render('header.php');
	$template->topHeader = $template->render('topheader.php');
	$template->navigator = $template->render('navigator.php');

	$template->sidebar = $template->render('sidebar.php');
	$template->content = $template->render('usercp.setting.php');

	$template->footer = $template->render('footer.php');

	echo $template->render('main.php');