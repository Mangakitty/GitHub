<?php
	
	if (!defined("_WASD_")) exit;

	if(!session('is_admin') && $the_page['name'] != 'admin_login'){
		redirect(URL('admin/login'));
		exit;
	}

	// ADD EVENTS

	include ACP_DIR . '/events.php';
	include APP_DIR . '/acp.events.php';
	foreach (C("app.enabledPlugins") as $plugin) {
		if (file_exists($file = PLUGINS_DIR .'/'.sanitizeFileName($plugin). "/acp.events.php"))
			include $file;
	}
