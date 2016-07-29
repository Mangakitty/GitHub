<?php

	if (!defined("_WASD_")) exit;
	
	// mapping routes
	$router->map('GET|POST','/admin', array('c'=>'/admin/init|/admin/index'), 'admin');
	$router->map('GET|POST','/admin/login', array('c'=>'/admin/init|/admin/login','m'=>'User'), 'admin_login');
	$router->map('GET','/admin/logout', array('c'=>'/admin/init|/admin/logout'), 'admin_logout');

	///////////////////// USER ///////////////////////

	$router->map('GET|POST','/admin/user/add', array('c'=>'/admin/init|/admin/user-add','m'=>'User'), 'admin_user_add');
	$router->map('GET|POST','/admin/user/settings', array('c'=>'/admin/init|/admin/user-settings','m'=>'User'), 'admin_user_settings');
	$router->map('GET|POST','/admin/user/edit/[i:userId]', array('c'=>'/admin/init|/admin/user-edit','m'=>'User'), 'admin_user_edit');
	$router->map('GET|POST','/admin/user/delete/[i:userId]', array('c'=>'/admin/init|/admin/user-delete','m'=>'User'), 'admin_user_delete');
	$router->map('GET','/admin/user/list', array('c'=>'/admin/init|/admin/user-list','m'=>'User'), 'admin_user_list');
	$router->map('GET|POST','/admin/user/role', array('c'=>'/admin/init|/admin/user-role','m'=>'User'), 'admin_user_role');
	$router->map('GET','/admin/user/list/[i:perPage]/[i:thisPage]', array('c'=>'/admin/init|/admin/user-list','m'=>'User'), 'admin_user_list_paging');
	$router->map('GET|POST','/admin/user/custom-field', array('c'=>'/admin/init|/admin/user-custom-fields','m'=>'User'), 'admin_user_custom_fields');

	///////////////////// PLUGIN ///////////////////////
	$router->map('GET|POST','/admin/plugin/management', array('c'=>'/admin/init|/admin/manage-plugin','m'=>'Plugin'), 'admin-manage-plugin');
	$router->map('GET|POST','/admin/plugin/download', array('c'=>'/admin/init|/admin/download-plugin','m'=>'Plugin'), 'admin-download-plugin');
	$router->map('GET|POST','/admin/plugin/install/[a:code]', array('c'=>'/admin/init|/admin/install-plugin','m'=>'Plugin'), 'admin-install-plugin');
	$router->map('GET|POST','/admin/plugin/uninstall/[a:code]', array('c'=>'/admin/init|/admin/uninstall-plugin','m'=>'Plugin'), 'admin-uninstall-plugin');
	$router->map('GET|POST','/admin/plugin/switch/[a:code]', array('c'=>'/admin/init|/admin/switch-plugin','m'=>'Plugin'), 'admin-switch-plugin');
	
	///////////////////// PLUGIN ///////////////////////
	$router->map('GET|POST','/admin/theme/management', array('c'=>'/admin/init|/admin/manage-theme','m'=>'Theme'), 'admin-manage-theme');
	$router->map('GET|POST','/admin/theme/download', array('c'=>'/admin/init|/admin/download-theme','m'=>'Theme'), 'admin-download-theme');
	$router->map('GET|POST','/admin/theme/switch/[a:code]', array('c'=>'/admin/init|/admin/switch-theme','m'=>'Theme'), 'admin-switch-theme');

	///////////////////// LANGUAGE ///////////////////////
	$router->map('GET|POST','/admin/language/management', array('c'=>'/admin/init|/admin/manage-language'), 'admin-manage-lang');
	$router->map('GET|POST','/admin/language/download', array('c'=>'/admin/init|/admin/download-language'), 'admin-download-lang');
	$router->map('GET|POST','/admin/language/edit/[a:code]', array('c'=>'/admin/init|/admin/language-edit'), 'admin-edit-lang');


	///////////////////// SETTING ///////////////////////

	$router->map('GET|POST','/admin/settings/general', array('c'=>'/admin/init|/admin/setting-general'), 'setting-general');
	$router->map('GET|POST','/admin/settings/mailer', array('c'=>'/admin/init|/admin/setting-mailer'), 'setting-mailer');

	///////////////////// ADMIN SYSTEM ///////////////////////

	$router->map('GET','/admin/system/dashboard-home', array('c'=>'/admin/init|/admin/index'), 'admin-dashboard-home');
	$router->map('GET|POST','/admin/system/maintenance', array('c'=>'/admin/init|/admin/maintenance'), 'admin-dashboard-maintenance');
	$router->map('GET','/admin/system/version-checker', array('c'=>'/admin/init|/admin/version-checker'), 'admin-dashboard-version-check');
	$router->map('GET','/admin/system/admin-log', array('c'=>'/admin/init|/admin/admin-log'), 'admin-log');
	$router->map('GET','/admin/system/admin-log/[i:perPage]/[i:thisPage]', array('c'=>'/admin/init|/admin/admin-log'), 'admin-log-paging');



/*	$router->map('GET','/users', array('c' => 'UserController', 'a' => 'ListAction'));
	$router->map('GET','/users/[i:id]', 'users#show', 'users_show');
	$router->map('POST','/users/[i:id]/[delete|update:action]', 'usersController#doAction', 'users_do');*/

