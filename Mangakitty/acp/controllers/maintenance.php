<?php 
	if (!defined("_WASD_")) exit; 

	$template->title = T('ADMIN CP') .' - '. T('Resynchronise or reset statistics') .' '. strtoupper($action);

	if(R('action') != ''){
		switch (R('action')) {
			case 'delete-user':
				require MODELS_DIR.'/User.php'; 
				$user = new model_User;
				$first = $user->getBy('userId', '1', '1');
				unset($first['0']['userId']);
				$query = WASD::$sql->query("TRUNCATE TABLE ".C('app.db_prefix')."user");
				$insert = $user->add($first['0']);
				$template->noty = array('info',T('All users have been deleted'));
				adminLog(T('Deleted all users'));
				break;
			case 'clear-session':
				$query = WASD::$sql->delete(C('app.db_prefix')."session", array('sessionId[>]'=>'0'));
				$template->noty = array('info',T('All sessions have been purged'));
				adminLog(T('Purged session table'));
				break;
			case 'start-date':
				WASD::writeConfig(array('startDate'=>date("r")));
				$template->noty = array('info',T('Start date has been reset'));
				adminLog(T('Reset website start date'));
				break;
			default:
				# code...
				break;
		}
	}


	// HEADER 
	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/maintenance.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

?>