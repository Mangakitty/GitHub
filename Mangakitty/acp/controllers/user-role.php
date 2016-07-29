<?php
	
	if (!defined("_WASD_")) exit;

	$template->title = T('ADMIN CP') .' - '. T('USER') .' '. T('Role management');
	$user = new model_User();

	////////////////////////////////////////////////////////////////////////////
	////////////////////// NEW ROLE ///////////////////////
	if(R('action') == 'new_role'){
		if(!is_array(R('permissions'))) $_POST['permissions'] = array(); 
		$user->addRole(R('name'),$_POST['permissions']);
		adminLog(sprintf(T('Added a new role (%1s)'), R('name')));
		$template->noty = array('info', T('User Role Successfully Added'));
	}elseif(R('action') == 'edit_role'){
		if(!is_array(R('permissions'))) $_POST['permissions'] = array(); 
		$user->updateRole(R('roleId'), R('name'),$_POST['permissions']);
		adminLog(sprintf(T('Update a role (%1s)'), R('name')));
		$template->noty = array('info', T('User Role Successfully Updated'));
	}else if(R('action') == 'delete'){
		adminLog(sprintf(T('Deleted a role (%1s)'), $user->roles[R('roleId')]['name']));
		$user->deleteRole(R('roleId'));
		redirect(URL('admin/user/role'));
	}

	////////////////////////////////////////////////////////////////////////////


	// HEADER 
	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');
	// CONTENT
	$template->roles = $user->getRoles();
	$template->content = $template->render('/acp/views/user-role.php');
	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
