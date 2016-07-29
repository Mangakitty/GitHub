<?php 
	if (!defined("_WASD_")) exit; 

	$router->addMatchTypes(array('chapter' => '(?:\d+|\d*\.\d+)'));

	$router->map('GET', '/', array('c'=>'/app/init|/app/index'), 'home');
	$router->map('GET|POST', '/'.T('manga-slug', 'manga').'/[*:slug]/[chapter:chapter]', array('c'=>'/app/init|/app/chapter|/app/comment|/app/chapter-render'), 'chapter-single');
	$router->map('GET|POST', '/'.T('manga-slug', 'manga').'/[*:slug]', array('c'=>'/app/init|/app/manga|/app/comment|/app/manga-render'), 'manga-single');


	$router->map('GET', '/'.T('directory-slug', 'directory').'/[i:perPage]/[i:thisPage]', array('c'=>'/app/init|/app/directory'), 'directory-paging');
	$router->map('GET', '/'.T('directory-slug', 'directory'), array('c'=>'/app/init|/app/directory'), 'directory');

	// CUSTOMIZATION AND SETTINGS
	$router->map('GET|POST', '/admin/settings/manga', array('c'=>'/admin/init|/app/init|/app/settings'), 'general-setting');
	$router->map('GET|POST', '/admin/settings/seo', array('c'=>'/admin/init|/app/init|/app/seo'), 'seo-setting');
	$router->map('GET|POST', '/admin/settings/customization', array('c'=>'/admin/init|/app/init|/app/theme-customization'), 'theme-customization');
	

	// USER

	$router->map('POST|GET', '/'.T('setting-slug', 'settings'), array('c'=>'/app/init|/app/usercp.setting'), 'user_settings');
	$router->map('POST|GET', '/['.T('register-slug', 'register').'|'.T('login-slug', 'login').':page]', array('c'=>'/app/init|/admin/userForm|/app/userForm_render'), 'register-login-page');
	$router->map('POST|GET', '/['.T('logout-slug', 'logout').':action]', array('c'=>'/app/init|/admin/userForm|/app/userForm_render'), 'log-out-page');
	$router->map('POST|GET', '/['.T('confirm-slug', 'confirm').':action]/[*:code1]/[*:code2]', array('c'=>'/app/init|/admin/userForm|/app/userForm_render'), 'Confirmation');


	// ADMIN MANAGEMENT

	$router->map('GET|POST','/admin/management/manga', array('c'=>'/admin/init|/app/manga-list'), 'manga-list');
	$router->map('GET|POST','/admin/management/manga/[i:perPage]/[i:thisPage]', array('c'=>'/admin/init|/app/manga-list'), 'manga-list-paging');
	$router->map('GET|POST','/admin/management/manga/[new:action]', array('c'=>'/admin/init|/app/manga-control'), 'manga-new');
	$router->map('GET|POST','/admin/management/manga/[edit|delete:action]/[*:slug]', array('c'=>'/admin/init|/app/manga-control'), 'manga-edit-delete');

	$router->map('GET|POST','/admin/management/chapter/[*:manga]/[i:perPage]/[i:thisPage]', array('c'=>'/admin/init|/app/chapter-list'), 'chapter-list-paging');
	$router->map('GET|POST','/admin/management/chapter/[*:manga]/[new:action]', array('c'=>'/admin/init|/app/chapter-list'), 'chapter-new');
	$router->map('GET|POST','/admin/management/chapter/[*:manga]/[edit|delete:action]/[chapter:chapter]', array('c'=>'/admin/init|/app/chapter-list'), 'chapter-control');
	$router->map('GET|POST','/admin/management/chapter/[*:manga]', array('c'=>'/admin/init|/app/chapter-list'), 'chapter-list');

	$router->map('GET|POST','/admin/management/comment', array('c'=>'/admin/init|/app/comment-list'), 'comment-list');
	$router->map('GET|POST','/admin/management/comment/[i:perPage]/[i:thisPage]', array('c'=>'/admin/init|/app/comment-list'), 'comment-list-paging');
	$router->map('GET|POST','/admin/management/comment/edit/[i:id]', array('c'=>'/admin/init|/app/edit-comment'), 'comment-edit');

	// HELPER

	$router->map('POST', '/popover', array('c'=>'/app/init|/app/manga-pop'), 'get_manga_pop_info');
	$router->map('POST','/admin/base64', array('c'=>'/admin/init|/app/base64'), 'save-base64-img');

	// MAINTENANCE

	$router->map('GET|POST', '/admin/system/maintenance/phpmanga', array('c'=>'/admin/init|/app/init|/app/maintenance'), 'phpmanga-maintenance');