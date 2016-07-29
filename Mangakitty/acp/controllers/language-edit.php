<?php
	
	if (!defined("_WASD_")) exit;

	
	$language = $pparams['code'];
	if (!file_exists(LANG_PATH.'/'.$language) && !is_dir(LANG_PATH.'/'.$language)) {
	    redirect(URL('admin/language/management'));
	} 

	if(file_exists(LANG_PATH.'/'.$language.'/definitions.php'))
		include LANG_PATH.'/'.$language.'/definitions.php';


	/*******************************************************
	* HANDLE POST ACTION  *
	********************************************************/
	
	if(R('action') != NULL && $_POST['action'] == 'translate'){
		foreach($_POST['translate'] as &$string){
			$definitions_new[$string['k']] = $string['v'];
		}
		$definitions = array_merge($definitions, $definitions_new);
		WASD::saveDefinitions($definitions);

	}


	/*******************************************************
	* PAGINATING  *
	********************************************************/
	// FILTERING RESULTS
	$wheres =  array(); // Where conditions for sure
	
	$c['per-page'] =  R(T('this-page-slug', 'perPage')) != '' ? R(T('per-page-slug', 'perPage')) : '10';
	$c['thisPage'] = R(T('this-page-slug', 'page')) != '' ? R(T('this-page-slug', 'page')) : '0';
	
	// COUTING AND DO PAGINATING
	$total = count($definitions);
	$p = paginator($total, $c['per-page'], $c['thisPage']);
	

	// NOW FETCH
	$template->p = $p;
	$template->c = $c;
	$template->url = URL('admin/language/edit/'.$language);
	$template->params = array();


	/*******************************************************
	* TEMPLATE  *
	********************************************************/


	// HEADER 
	$template->definitions = $definitions;

	$template->title = T('ADMIN CP') .' - '. sprintf(T('Edit %1s'), $language);

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/edit-language.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
