<?php

	if (!defined("_WASD_")) exit;

	$template->title = T('ADMIN CP') .' - '. T('Edit');

	$commentId = $pparams['id'];
	$thisComment = Comment::findFirst(array('commentId'=>$commentId));

	$template->cm = $thisComment;


	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('edit-comment.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
