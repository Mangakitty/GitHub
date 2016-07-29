<?php

	if (!defined("_WASD_")) exit;

	$template->title = T('Admin Control Panel') .' - '. T2up('Manga List');
	
	/*******************************************************
	* FILTERING AND PAGINATING *
	********************************************************/

	$wheres =  array(); // Where conditions for sure

	// IF CATEGORY ISSET

	$c['per-page'] = isset($pparams['perPage']) ? $pparams['perPage'] : C('app.mangaPerPage', '20');
	$c['thisPage'] = isset($pparams['thisPage']) ? $pparams['thisPage'] : '0';

	if(R('q') != '') $wheres['LIKE'] = array('name'=>R('q'));

	// COUTING AND DO PAGINATING
	$total = WASD::$sql->count(C('app.db_prefix').'manga', $wheres);
	$p = paginator($total, $c['per-page'], $c['thisPage']);
	$wheres['LIMIT'] = array($p['s'], $c['per-page']);
	$orderType = R('orderType') == '' ? 'DESC' : R('orderType');
	$wheres['ORDER'] = R('order') != '' ? R('order').' '.$orderType : 'lastUpdate DESC, thetime DESC';

	// NOW FETCH
	$template->mangas = WASD::$sql->select(C('app.db_prefix').'manga', 
									array('mangaId', 'name', 'slug', 'cover', 'comments'), 
									$wheres);

	$template->p = $p;
	$template->c = $c;
	$template->url = URL('admin/management/manga');
	$template->params = array();


	/*******************************************************
	* TEMPLATING  *
	********************************************************/

	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('manga-list.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
