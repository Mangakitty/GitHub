<?php
	
	if (!defined("_WASD_")) exit;
	
	foreach (C("app.enabledPlugins") as $plugin) {
		if (file_exists($file = PLUGINS_DIR .sanitizeFileName($plugin). "/events.php"))
			include $file;
	}

	if(session('token') == NULL) doToken();
	if(R('token') != '' && session('token') != ''){
		if(!checkToken(R('token'))){
			event('render_tokenMismatch', $text);
		}
	}

	$template->customCss .= C('app.customCss');
	$template->customJs .= do_shortcode(C('app.customJs'));

	if(!in_array(P('page'), array('login', 'register')) || !in_array(P('action'), array('logout', 'confirm')) ) cookie('ref', '1', '-1');