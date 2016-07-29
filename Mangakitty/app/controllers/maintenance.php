<?php 
	if (!defined("_WASD_")) exit; 

	$template->title = T('ADMIN CP') .' - '. T('Resynchronise or reset statistics') .' '. strtoupper($action);

	if(R('action') != ''){
		switch (R('action')) {
			case 'truncate_manga':
				$query = WASD::$sql->query("TRUNCATE TABLE ".C('app.db_prefix')."manga");
				$template->noty = array('info',T('All manga have been deleted'));
				adminLog(T('Deleted all mangas'));
				break;
			case 'truncate_chapter':
				$query = WASD::$sql->query("TRUNCATE TABLE ".C('app.db_prefix')."chapter");
				$template->noty = array('info',T('All chapter have been deleted'));
				adminLog(T('Deleted all chapters'));
				break;
			case 'clear_img_folder':
				deleteDir(ROOT_DIR.'/upload/cover');
				deleteDir(ROOT_DIR.'/upload/manga');
				$template->noty = array('info',T('All uploaded images have been deleted'));
				adminLog(T('Deleted all images'));
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