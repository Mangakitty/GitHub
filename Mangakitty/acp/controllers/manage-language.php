<?php
	
	if (!defined("_WASD_")) exit;

	$template->title = T('ADMIN CP') .' - '. T('Language Management');


	/*******************************************************
	* HANDLE POST ACTION  *
	********************************************************/
	if(R('action') != ''){
		switch (R('action')) {
			case 'duplicate':
				copy_directory(LANG_PATH.'/'.R('language'), LANG_PATH.'/'.R('language').'copy');	
				$template->noty = array('info',T('Language pack successfully duplicated')); 
				adminLog(sprintf(T('Duplicated %1s language pack'), R('language')));
				break;

			case 'set':
				WASD::writeConfig(array('language'=>R('language')));	
				$template->noty = array('info',T('Successful')); 
				adminLog(sprintf(T('Set %1s as default language'), R('language')));
				break;
			
			case 'rename':
				rename(LANG_PATH.'/'.R('language'), LANG_PATH.'/'.R('new_name')); 
				$template->noty = array('info', sprintf(T('%1s was renamed %2s'), R('language'), R('new_name'))); 
				adminLog(sprintf(T('Renamed %1s to %2s'), R('language'), R('new_name')));
				break;
			
			case 'delete':
				deleteDir(LANG_PATH.'/'.R('language')); 
				$template->noty = array('info', sprintf(T('%1s was removed'), R('language'))); 
				adminLog(sprintf(T('Remove %1s language pack'), R('language')));
				break;
			
			case 'toggle_translation':
				if(C('developer.translate') == '1'){
					WASD::writeConfig(array('translate'=>0),'developer');
					$template->noty = array('info', sprintf(T('String logger OFF'), R('language'))); 
					adminLog(sprintf(T('Turned off string logger'), R('language')));
				}else{
					WASD::writeConfig(array('translate'=>1),'developer');
					$template->noty = array('info', sprintf(T('String logger ON'), R('language'))); 
					adminLog(sprintf(T('Turned on string logger'), R('language')));
				}
				
				break;
			
			default:
				# code...
				break;
		}
	}


	if ($handle = opendir(LANG_PATH)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") { $locales[] = $entry; }
            }
    }

	$template->languages = $locales;

	if(R('action') == 'update'){
		
	}

	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/manage-language.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
