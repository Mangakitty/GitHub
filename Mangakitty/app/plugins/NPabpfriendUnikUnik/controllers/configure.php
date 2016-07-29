<?php

	if (!defined("_WASD_")) exit;

	$template->title = T('Admin Control Panel') .' - '. T('AdBlockPlus-Friend [http://unikunik.pw]');
	
	//exit(dump($_POST));
	if(R('action') != '')
		switch (R('action')) {
			case 'save_abpfriend':
				$abpfrienddbcon = C('app.db_prefix').'unikunik_abpfriend';
				$abpfe = R('abpfriend_enable');
				$array = array( 'variable'=>'enable', 'function'=>$abpfe );
				WASD::$sql->update($abpfrienddbcon, $array, array('variable'=>'enable'));
				$abpfc = R('abpfriend_color');
				$array = array( 'variable'=>'color', 'function'=>$abpfc );
				WASD::$sql->update($abpfrienddbcon, $array, array('variable'=>'color'));
				$abpfm = R('abpfriend_message');
				$array = array( 'variable'=>'message', 'function'=>$abpfm );
				WASD::$sql->update($abpfrienddbcon, $array, array('variable'=>'message'));
				break;
			default:
				# code...
				break;
		}


	/*******************************************************
	* TEMPLATING  *
	********************************************************/

	// HEADER 

	$template->addJSFile('');
	$template->addCssFile('');

	$template->customJs .= "";

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/app/plugins/NPabpfriendUnikUnik/views/abpfriend.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
