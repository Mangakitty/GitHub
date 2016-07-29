<?php

	if (!defined("_WASD_")) exit;

	// SAVE THIS GUY'S REFERRAL SO WE CAN REDIRECT HIM BACK AFTER LOGGED IN/OUT
	if(cookie('ref') == ''){
		$ref = $_SERVER['HTTP_REFERER'];
		cookie('ref', $ref);
	}
	$ref = cookie('ref', $ref);

	//exit(dump(session('thisUser')));

	// FECTH PAGE'S PARAMS AS _GET
	foreach($pparams as $p=>$v)
		$_GET[$p] = $v;
	$template->title = T(ucfirst(R('page')));

	// KICK THIS GUY OUT IF HE ALREADY LOGGED IN
	if(is_array(session('thisUser')) && P('action') != T('logout-slug', 'logout')) redirect($ref);


	// SWITCH CASE "ACTION"

	switch (R('action')) {
		case T('register-slug', 'register'):
			if(R('token') == '' || R('page') != 'register'){
				event('render_tokenMismatch', $text);
				exit;
			} 
			// PYRAMID FILTER :D
			if(preg_match('/^[a-zA-Z0-9_-]{3,16}$/', R('username'))){
				if(!filter_var(R('email'), FILTER_VALIDATE_EMAIL)){
					// EMAIL
					$template->message = array('danger', T('Invalid Email address'), 'email');	
				}else{
					if(R('password') == ''){
					// Password NULL
						$template->message = array('danger', T('Password could not be NULL'), 'password');	
					}else{
						if(R('password') != R('password2')){
						// Password NULL
							$template->message = array('danger', T('Confirm password does not match'), 'password');	
						}else{
							if(userIsExist('username', trim(R('username')))){
								$template->message = array('danger', T('Username already exist'), 'username');	
							}else{
								if(userIsExist('email', trim(R('email')))){
									$template->message = array('danger', T('Email already exist'), 'email');	
								}else{
									$thisUser['username'] = R('username');
									$thisUser['email'] = trim(R('email'));
									$thisUser['password'] = pw(R('password'));
									$thisUser['role'] = C('app.defaultRole', '2');
									$thisUser['joinDate'] = $thisUser['lastActionTime'] = time();
									$thisUser['joinIp'] = ip2long(ip());
									$thisUser['preferences'] = json_encode(array('avatar'=>C('app.defaultAvatar')));

									if(C('app.confirmationNeed', '1') == '1'){
										$thisUser['confirmedEmail'] = '0';
										$thisUser['confirmCode'] = confirmEmail($thisUser['email']);	
										
										$confirmEmail = strtr(C('email.confirmation'), 
															  array('{link}'=>URL('/confirm/'.urlencode(base64_encode($thisUser['email'])).'/'.$thisUser['confirmCode']),
																  '{user}'=>$thisUser['username'],
																  '{siteTitle}'=>C('app.title'))
															  );
										event('sendEmail', array('to'=>$thisUser['email'], 'subject'=>T('Confirmation Instructions'), 'body'=>$confirmEmail));
										$template->message = array('info', T('Registration Successful, Please check your inbox for confirmation link'));
									}else{
										$thisUser['confirmedEmail'] = '1';
										$template->message = array('info', T('Registration Successful, you can login with registered email'));
									}
		
									WASD::$sql->insert(C('app.db_prefix').'user', $thisUser);
									
								}
							}	
						}
					}
				}
			}else{
				$template->message = array('danger', T('Username can only contains character, number and underscope, minimum is 3 and maximum is 16 characters'), 'username');
			}
			break;

		case T('login-slug', 'login'):
			if(R('token') == '' || P('page') != T('login-slug', 'login')){
				event('render_tokenMismatch', $text);
				exit;
			} 
			if(cookie('login_fail') == '5'){
				$template->message = array('danger', T('You have failed 5 times to sign in, please wait 2 minutes to try again'));
			}else{
				if(filter_var(R('username_email'), FILTER_VALIDATE_EMAIL)){ 
					$where = array('email'=> trim(R('username_email')), 'password'=>pw(trim(R('password'))) ); 
				}else{
					$where = array('username'=> trim(R('username_email')), 'password'=>pw(trim(R('password'))) ); 
				}
				$select = WASD::$sql->select(C('app.db_prefix').'user', array('userId', 'username', 'email', 'confirmedEmail', 'role', 'preferences', 'joinDate', 'joinIp', 'lastActionTime'), array('AND'=>$where, 'LIMIT'=>'1'));
				if(!is_array($select) || count($select) == 0){
					$template->message = array('danger', T('Incorrect login credentials, please try again'));
					cookie('login_fail', cookie('login_fail')+1, '120');
				}else{
					if($select[0]['confirmedEmail'] != '1'){
						$template->message = array('danger', T('This account has not activated yet, please confirm your account via confirmation link sent to your email'));
					}else{
						$role = WASD::$sql->select(C('app.db_prefix').'user_role', array("roleId","roleName","permissions"), array('AND'=>array('roleId'=>$select[0]['role']), 'LIMIT'=>'1'));
						session('preferences', json_decode($select[0]['preferences'], true));
						$select[0]['preferences'] = '';
						session('permissions', json_decode($role[0]['permissions'], true));
						session('thisUser', $select[0]);
						event('login', $select[0]['userId']);
						redirect(cookie('ref'));
					}
				}
			}

			break;

		case T('confirm-slug', 'confirm'):
			$template->title = T('Email confirmation');
			$template->status = confirmEmail(trim(base64_decode(urldecode(R('code1')))), R('code2'));
			$template->content = $template->render('confirm-email.php');
			break;


		case T('logout-slug', 'logout'):
			event('logout', session_get('thisUser', 'userId'));
			session('thisUser', 'false');
			session('permissions', 'false');
			session('preferences', 'false');
			redirect(cookie('ref'));
			break;

		default:
			# code...
			break;
	}

