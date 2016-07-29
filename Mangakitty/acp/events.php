<?php

	if (!defined("_WASD_")) exit;
	
	if(!function_exists('acp_liMatch')){
		function acp_liMatch($request){
			$webPath = ltrim(str_replace(WASD::$webPath, '', $_SERVER['REQUEST_URI']),'/');
			if($request == '') return false;
			$request = explode('|', $request);
			if(count($request) > 1){
				foreach ($request as &$r) {
					if(0 === strpos($webPath, $r)) return true;
				}
			}else{
				if(0 === strpos($webPath, $request[0])) return true;
			}
			return false;
		}
	}

	if(!function_exists('acp_li')){
		function acp_li($title, $id, $request, $class = ''){
			$active = acp_liMatch($request) ? 'active' : '';
			return '<li class="to-top '.$active.' '.$class.'"><a href="#'.$id.'" role="tab" data-toggle="tab">'.$title.'</a></li>';
		}
	}
	if(!function_exists('acp_liGroup')){
		function acp_liGroup($title, $description, $url, $request, $class = ''){
			$active = acp_liMatch($request) ? 'active' : '';
			return 	  '<a href="'.URL($url).'" class="list-group-item '.$active.' '.$class.'">
			            <h4 class="list-group-item-heading">'.$title.'</h4>
			            <p class="list-group-item-text">'.$description.'</p>
			          </a>';
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	event('acp_get_header', NULL, function(){
		include 'header.php';
	});	
	event('acp_get_footer', NULL, function(){
		include 'header.php';
	});

	event('acp_left_menu', NULL, function($menu){
		$request = ltrim(str_replace(WASD::$webPath, '', $_SERVER['REQUEST_URI']),'/');
		return $menu . '<li class="to-top '.($request == 'admin' ? 'active' : '').'"><a href="#system" role="tab" data-toggle="tab"><i class="icon-globe-3"></i> <span class="acp-md-text">'. T('Dashboard') .'</a></li>'
					 . acp_li('<i class="icon-cog-1"></i> <span class="acp-md-text">'.T('Settings').'</span>', 'setting', 'admin/settings')
					 . acp_li('<i class="icon-user"></i> <span class="acp-md-text">'.T('User').'</span>', 'user', 'admin/user');
	});

	event('acp_left_menu2', NULL, function($menu){
		$request = ltrim(str_replace(WASD::$webPath, '', $_SERVER['REQUEST_URI']),'/');
		return $menu . acp_li('<i class="icon-plug"></i> <span class="acp-md-text">'.T('Plugins').'</span>', 'plugin', 'admin/plugin')
					 . acp_li('<i class="icon-picture"></i> <span class="acp-md-text">'.T('Themes').'</span>', 'theme', 'admin/theme')
					 . acp_li('<i class="icon-language"></i> <span class="acp-md-text">'.T('Language').'</span>', 'language', 'admin/language');
	});

	event('acp_left_menu_detail', NULL, function($menu){

		$request = ltrim(str_replace(WASD::$webPath, '', $_SERVER['REQUEST_URI']),'/');
		return $menu . 
			'<div class="tab-pane fade '.(($request == 'admin' OR 0 === strpos($request, 'admin/system')) ? 'active in' : '').'" id="system">
		  		<div id="acp-list">
			        <div class="list-group">'.
			          acp_liGroup(T('Dashboard home'), T('Analytic & Statistics'), 'admin/system/dashboard-home', 'admin/system/home').
			          acp_liGroup(T('Maintainace'), T('Resynchronise or reset statistics'), 'admin/system/maintenance', 'admin/system/maintenance').
			          acp_liGroup(T('Version check'), T('Check for updates'), 'admin/system/version-checker', 'admin/system/version-checker').
			          event('acp_system_submenu', $submenu).'
		         	</div>
		        </div>
		    </div>'
		 .'<div class="tab-pane fade '.(0 === strpos($request, 'admin/settings') ? 'active in' : '').'" id="setting">
		  		<div id="acp-list">
			        <div class="list-group">'.
			          acp_liGroup(T('General'), T('General setting explain','Site title, Timezone, etc.'), 'admin/settings/general', 'admin/settings/general').
			          acp_liGroup(T('Mailer'), T('Sending options, template, etc.'), 'admin/settings/mailer', 'admin/settings/mailer').
			          event('acp_setting_submenu', $submenu).'
		         	</div>
		        </div>
		    </div>'
		 . '<div class="tab-pane fade '.(0 === strpos($request, 'admin/user') ? 'active in' : '').'" id="user">
			  	<div id="acp-list">
			        <div class="list-group">'.
			          acp_liGroup('<i class="icon-user-add"></i> '.T('Add User'), '', 'admin/user/add', 'admin/user/add').
			          acp_liGroup('<i class="icon-users"></i> '.T('User list'), '', 'admin/user/list', 'admin/user/list').
			          acp_liGroup('<i class="icon-user-5"></i> '.T('User role'), '', 'admin/user/role', 'admin/user/role').
			          acp_liGroup('<i class="icon-cog-2"></i> '.T('User settings'), '', 'admin/user/settings', 'admin/user/settings').
			          event('acp_user_submenu', $submenu).'
			        </div>
			    </div>
		    </div>'
		 . '<div class="tab-pane fade '.(0 === strpos($request, 'admin/plugin') ? 'active in' : '').'" id="plugin">
			  	<div id="acp-list">
			        <div class="list-group">'.
			          acp_liGroup('<i class=" icon-th-list-4"></i> '.T('Manage Plugins'), '', 'admin/plugin/management', 'admin/plugin/management|admin/plugin/switch|admin/plugin/install').
			          acp_liGroup('<i class="icon-download-outline"></i> '.T('Download Plugins'), '', C('link.plugins'), '" target="_blank"').
			          event('acp_plugin_submenu', $submenu).'
			        </div>
			    </div>
		    </div>'
		 . '<div class="tab-pane fade '.(0 === strpos($request, 'admin/theme') ? 'active in' : '').'" id="theme">
			  	<div id="acp-list">
			        <div class="list-group">'.
			     	  acp_liGroup('<i class=" icon-th-list-4"></i> '.T('Manage Themes'), '', 'admin/theme/management', 'admin/theme/management|admin/theme/switch|admin/theme/install').
			          acp_liGroup('<i class="icon-download-outline"></i> '.T('Download More Themes'), '', C('link.themes'), '" target="_blank"').
			          event('acp_theme_submenu', $submenu).'
			        </div>
			    </div>
		   </div>'
		 .'<div class="tab-pane fade '.(0 === strpos($request, 'admin/language') ? 'active in' : '').'" id="language">
			  	<div id="acp-list">
			        <div class="list-group">'.
			     	  acp_liGroup('<i class=" icon-th-list-4"></i> '.T('Manage Languages'), '', 'admin/language/management', 'admin/language/management').
			          acp_liGroup('<i class="icon-download-outline"></i> '.T('Download More Languages'), '', C('link.languages'), '" target="_blank"').
			          event('acp_theme_submenu', $submenu).'
			        </div>
			    </div>
		    </div>';
	});

	event('acp_navigator', NULL, function(){
		echo '<li><a href=""><i class="icon-logout"></i> Hello</a></li>';
	});

	event('user_role_form', NULL, function($array){
		return $array;
	});
