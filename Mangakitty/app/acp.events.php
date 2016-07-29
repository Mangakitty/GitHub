<?php if (!defined("_WASD_")) exit;
	
	
	event('acp_left_menu2', NULL, function($menu){
		return $menu .= '<li><a href="#management" role="tab" data-toggle="tab"><i class="icon-popup"></i> <span class="acp-md-text">'.T('Management').'</span></a></li>';
		
	});
	
	event('acp_left_menu_detail', NULL, function($menu){		
		$request = ltrim(str_replace(WASD::$webPath, '', $_SERVER['REQUEST_URI']),'/');
		return $menu . 
			'<div class="tab-pane fade '.((0 === strpos($request, 'admin/management')) ? 'active in' : '').'" id="management">
		  		<div id="acp-list">
			        <div class="list-group">
			          <a href="'.URL('admin/management/manga').'" class="list-group-item '.(0 === strpos($request, 'admin/management/manga') ? 'active' : '').'">
			            <h4 class="list-group-item-heading">'.T('Manga & Chapters').'</h4>
			            <p class="list-group-item-text">'.T('Manage All Manga Series and its chapters').'</p>
			          </a>
			          <a href="'.URL('admin/management/comment').'" class="list-group-item '.(0 === strpos($request, 'admin/management/comment') ? 'active' : '').'">
			            <h4 class="list-group-item-heading">'.T('Comments').'</h4>
			            <p class="list-group-item-text">'.T('All comments here').'</p>
			          </a>
			          '.event('acp_management_submenu', $submenu).'
		         	</div>
		        </div>
		    </div>';
	});

	event('acp_setting_submenu', NULL, function($submenu){
		$request = ltrim(str_replace(WASD::$webPath, '', $_SERVER['REQUEST_URI']),'/');
		return $submenu.'
			          <a href="'.URL('admin/settings/manga').'" class="list-group-item '.(0 === strpos($request, 'admin/settings/manga') ? 'active' : '').'">
			            <h4 class="list-group-item-heading">'.T('PHP Manga').'</h4>
			            <p class="list-group-item-text">'.T('General Settings').'</p>
			          </a>
			          <a href="'.URL('admin/settings/seo').'" class="list-group-item '.(0 === strpos($request, 'admin/settings/seo') ? 'active' : '').'">
			            <h4 class="list-group-item-heading">'.T('SEO Settings').'</h4>
			            <p class="list-group-item-text">'.T('Title tag, SEO Tag, etc.').'</p>
			          </a>
			          <a href="'.URL('admin/settings/customization').'" class="list-group-item '.(0 === strpos($request, 'admin/settings/customization') ? 'active' : '').'">
			            <h4 class="list-group-item-heading">'.T('Customization').'</h4>
			            <p class="list-group-item-text">'.T('Ad space, Menu, Widget, etc.').'</p>
			          </a>

			          <hr>';
	});

	
	event('maintenance', NULL, function($return){
		return $return.'
        	<tr>
	        	<td>
					<strong>'.T('Delete all mangas').'</strong><br />
				</td>
				<td>
					<form method="POST" action="'.URL("admin/system/maintenance/phpmanga").'">
						<input type="hidden" name="action" value="truncate_manga">
						<button class="btn btn-yellow btn-small" type="submit">'.T('RUN NOW').'</button>
					</form>
				</td>
			</tr>
			<tr>
	        	<td>
					<strong>'.T('Delete all chapters').'</strong><br />
				</td>
				<td>
					<form method="POST" action="'.URL("admin/system/maintenance/phpmanga").'">
						<input type="hidden" name="action" value="truncate_chapter">
						<button class="btn btn-yellow btn-small" type="submit">'.T('RUN NOW').'</button>
					</form>
				</td>
			</tr>
			<tr>
	        	<td>
					<strong>'.T('Clear image folder').'</strong><br />'.T('All images (cover, chapter content) will be deleted all)').'
				</td>
				<td>
					<form method="POST" action="'.URL("admin/system/maintenance/phpmanga").'">
						<input type="hidden" name="action" value="clear_img_folder">
						<button class="btn btn-yellow btn-small" type="submit">'.T('RUN NOW').'</button>
					</form>
				</td>
			</tr>';
	});

 ?>