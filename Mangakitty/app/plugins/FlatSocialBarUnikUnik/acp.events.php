<?php 
	event('acp_management_submenu', NULL, function($submenu){
		$request = ltrim(str_replace(WASD::$webPath, '', $_SERVER['REQUEST_URI']),'/');
		return $submenu.
			'
			<hr>
			<a href="'.URL('admin/management/flatsocialbar/settings').'" class="list-group-item '.(0 === strpos($request, 'admin/management/flatsocialbar/settings') ? 'active' : '').'">
	            <h4 class="list-group-item-heading">'.T('Flat Social Bar Settings').'</h4>
	            <p class="list-group-item-text">'.T('Configure your Flat Social Bar. http://unikunik.pw').'</p>
	          </a>
			 ';
	});