<?php 

	if (!defined("_WASD_")) exit;

	function update_view($id, $type = NULL){
		$type = (isset($type) && in_array($type, array('manga', 'chapter'))) ? $type : 'manga';
		$views = is_array(cookie('views')) ? cookie('views') : array();
		if(!isset($views[$type][$id])){
			$views[$type][$id] = '1';
			cookie('views', $views);
			WASD::$sql->update(C('app.db_prefix').$type, array('views[+]'=>'1'), array($type.'Id'=>$id));
		}
	}

?>