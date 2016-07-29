<?php

	if (!defined("_WASD_")) exit;

	$template->title = T('Admin Control Panel') .' - '. T2up('Admin Logs') .' '. strtoupper($action);
	
	////////////////////////////////////////////////////////////////////////////

	// FILTERING RESULTS
	$wheres =  array(); // Where conditions for sure
	$c['per-page'] =  R(T('this-page-slug', 'perPage')) != '' ? R(T('per-page-slug', 'perPage')) : '10';
	$c['thisPage'] = R(T('this-page-slug', 'page')) != '' ? R(T('this-page-slug', 'page')) : '0';
	if(R('action') != '') $wheres['LIKE'] = array('string'=>R('action'));
	if(R('id') != '') $wheres['LIKE'] = array('adminId'=>R('id'));
	if(R('ip') != '') $wheres['LIKE'] = array('ip'=>R('ip'));
	
	// COUTING AND DO PAGINATING
	$total = WASD::$sql->count(C('app.db_prefix').'admin_log', $wheres);
	$p = paginator($total, $c['per-page'], $c['thisPage']);
	$wheres['LIMIT'] = array($p['s'], $c['per-page']);
	

	// NOW FETCH
	$template->adminLog = getAdminLog($c['per-page'], $wheres);
	$template->p = $p;
	$template->c = $c;
	$template->url = URL('admin/system/admin-log');
	$template->params = array();

	////////////////////////////////////////////////////////////////////////////


	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/admin-log.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
