<?php if (!defined("_WASD_")) exit;

	$slug = P('slug');

	$thisManga = WASD::$sql->select(C('app.db_prefix').'manga', '*', array('slug'=>$slug, 'LIMIT'=>'1'));
	$thisManga = event('do_manga_info', $thisManga[0]);

	update_view($thisManga['mangaId'], 'manga');

	$template->thisManga = $thisManga;
