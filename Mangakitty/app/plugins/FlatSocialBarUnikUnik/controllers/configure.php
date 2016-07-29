<?php

	if (!defined("_WASD_")) exit;

	$template->title = T('Admin Control Panel') .' - '. T('Flat Social Bar [http://unikunik.pw]');
	
	//exit(dump($_POST));
	if(R('action') != '')
		switch (R('action')) {
			case 'save_social':
				$fsbdbcon = C('app.db_prefix').'unikunik_flatsocialbar';
				$fb = R('facebook_url');
				$youtube = R('youtube_url');
				$gp = R('googleplus_url');
				$tw = R('twitter_url');
				$da = R('devianart_url');
				$array = array( 'social'=>'facebook', 'link'=>$fb );
				WASD::$sql->update($fsbdbcon, $array, array('Id'=>'1'));				
				$array = array( 'social'=>'youtube', 'link'=>$youtube );
				WASD::$sql->update($fsbdbcon, $array, array('Id'=>'2'));
				$array = array( 'social'=>'googleplus', 'link'=>$gp );
				WASD::$sql->update($fsbdbcon, $array, array('Id'=>'3'));
				$array = array( 'social'=>'twitter', 'link'=>$tw );
				WASD::$sql->update($fsbdbcon, $array, array('Id'=>'4'));
				$array = array( 'social'=>'devianart', 'link'=>$da );
				WASD::$sql->update($fsbdbcon, $array, array('Id'=>'5'));
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
	$template->content = $template->render('/app/plugins/FlatSocialBarUnikUnik/views/flatsocialbar.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
