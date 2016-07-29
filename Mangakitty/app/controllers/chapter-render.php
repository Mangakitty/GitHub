<?php if (!defined("_WASD_")) exit;

	$replace = 	array('{homeTitle}'=>C('app.title'), 
					  '{name}'=>$thisManga['name'], 
					  '{alternativeName}'=>$thisManga['alternativeName'], 
					  '{author}'=>$thisManga['author'], 
					  '{artist}'=>$thisManga['artist'], 
					  '{genre}'=>$thisManga['genre'],
					  '{released}'=>$thisManga['released'], 
					  '{mangaType}'=>$thisManga['mangaType'],
					  '{lastChapter}'=>$thisManga['lastChapter'],
					  '{chapterNumber}'=>$thisChapter['chapter'],
					  '{chapterName}'=>$thisChapter['name'],
					  );	

	$template->title = strtr(C('app.chapterTitle'), $replace);
	$template->description = strtr(C('app.chapterDescription'), $replace);
	$template->keywords = strtr(C('app.chapterKeywords'), $replace);
	
	
	$template->header = $template->render('header.php');
	$template->navigator = $template->render('navigator-chapter.php');
	$template->footer = $template->render('footer-chapter.php');

	echo $template->render('main-chapter.php');