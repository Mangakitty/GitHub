<?php

	$template->title = T('ADMIN CP') .' - '. T('USER') .' '. strtoupper($action);

	$user = new model_User();

	if($user->delete('userId',$pparams['userId']) == 0){
		$template->noty = array('danger',T('Unexpected error has occurred'));
	}else{
		adminLog(sprintf(T('Deleted a user (#%1s)'), $pparams['userId']));
		$template->noty = array('info',T('This user has been successfully deleted'));
	}


	// FILTERING RESULTS
	$wheres =  array(); // Where conditions for sure
	
	$c['per-page'] =  R(T('this-page-slug', 'perPage')) != '' ? R(T('per-page-slug', 'perPage')) : '10';
	$c['thisPage'] = R(T('this-page-slug', 'page')) != '' ? R(T('this-page-slug', 'page')) : '0';
	
	// COUTING AND DO PAGINATING
	$total = $user->userCount($wheres);
	$p = paginator($total, $c['per-page'], $c['thisPage']);
	$wheres['LIMIT'] = array($p['s'],$c['per-page']);

	// NOW FETCH
	$uList = $user->userList($wheres);
	$template->users = $uList;

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
