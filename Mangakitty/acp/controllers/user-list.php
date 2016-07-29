<?php

	if (!defined("_WASD_")) exit;

	$template->title = T('Admin Control Panel') .' - '. T2up('User') .' '. strtoupper($action);
		$user = new model_User();



	////////////////////////////////////////////////////////////////////////////

	// FILTERING RESULTS
	$wheres =  array(); // Where conditions for sure
	
	$c['per-page'] =  R(T('this-page-slug', 'perPage')) != '' ? R(T('per-page-slug', 'perPage')) : '10';
	$c['thisPage'] = R(T('this-page-slug', 'page')) != '' ? R(T('this-page-slug', 'page')) : '0';
	
	if(R('username') != '') $wheres['LIKE'] = array('username'=>R('username'));
	if(R('email') != '') $wheres['LIKE'] = array('email'=>R('email'));
	if(R('ip') != '') $wheres['LIKE'] = array('joinIP'=>R('ip'));
	if(R('role') != '') $wheres['AND'] = array('role'=>R('role'));
	
	// COUTING AND DO PAGINATING
	$total = $user->userCount($wheres);
	$p = paginator($total, $c['per-page'], $c['thisPage']);
	$wheres['LIMIT'] = array($p['s'],$c['per-page']);

	// NOW FETCH
	$uList = $user->userList($wheres);
	$template->users = $uList;
	$template->p = $p;
	$template->c = $c;
	$template->url = URL('admin/user/list');
	$template->params = array();

	////////////////////////////////////////////////////////////////////////////


	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('/acp/views/user-list.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
