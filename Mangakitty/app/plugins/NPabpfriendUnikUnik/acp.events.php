<?php 
	event('acp_management_submenu', NULL, function($submenu){
		$request = ltrim(str_replace(WASD::$webPath, '', $_SERVER['REQUEST_URI']),'/');
		return $submenu.
			'
			<hr>
			<a href="'.URL('admin/management/abpfriend/settings').'" class="list-group-item '.(0 === strpos($request, 'admin/management/abpfriend/settings') ? 'active' : '').'">
	            <h4 class="list-group-item-heading">'.T('AdBlockPlus-Friend Settings').'</h4>
	            <p class="list-group-item-text">'.T('Configure your AdBlockPlus-Friend. http://unikunik.pw').'</p>
	          </a>
			 ';
	});