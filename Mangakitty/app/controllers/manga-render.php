<?php if (!defined("_WASD_")) exit;

	$replace = 	array('{homeTitle}'=>C('app.title'), 
					  '{name}'=>$thisManga['name'], 
					  '{alternativeName}'=>$thisManga['alternativeName'], 
					  '{author}'=>$thisManga['author'], 
					  '{artist}'=>$thisManga['artist'], 
					  '{genre}'=>$thisManga['genre'],
					  '{released}'=>$thisManga['released'], 
					  '{mangaType}'=>$thisManga['mangaType'],
					  '{lastChapter}'=>$thisManga['lastChapter'] 
					  );	

	$template->title = strtr(C('app.mangaTitle'), $replace);
	$template->description = strtr(C('app.mangaDescription'), $replace);
	$template->keywords = strtr(C('app.mangaKeywords'), $replace);
	
	$template->header = $template->render('header.php');
	$template->topHeader = $template->render('topheader.php');
	$template->navigator = $template->render('navigator.php');

	$template->content = $template->render('manga.php');

	$template->sidebar = $template->render('sidebar.php');

	$template->footer = $template->render('footer.php');

	echo $template->render('main.php');