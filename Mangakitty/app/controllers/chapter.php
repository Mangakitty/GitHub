<?php if (!defined("_WASD_")) exit;

	$slug = P('slug');
	$chapter = P('chapter');

	$thisManga = WASD::$sql->select(C('app.db_prefix').'manga', '*', array('slug'=>$slug, 'LIMIT'=>'1'));
	$thisManga = $thisManga[0];

	$thisChapter = WASD::$sql->select(C('app.db_prefix').'chapter', 
										array('chapterId', 'chapter', 'name'),
										array('AND'=>
											array('manga'=>$thisManga['mangaId'], 'chapter'=>$chapter),
											'LIMIT'=>'1'
										)
									);
	
	if(!is_array($thisChapter) || count($thisChapter) < 1) redirect(event('print_manga_url', $thisManga));

	$thisChapter = $thisChapter[0];
	
	update_view($thisManga['mangaId'], 'manga');
	update_view($thisChapter['chapterId'], 'chapter');



	$template->thisManga = $thisManga;
	$template->thisChapter = $thisChapter;