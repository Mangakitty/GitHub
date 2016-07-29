<?php 

	if (!defined("_WASD_")) exit;

	if(!empty($_POST) && R('action') == 'comment'){
	
		if(R('token') == ''){ event('render_tokenMismatch', $text); exit; }

		if(!isLoggedIn()) exit(event('render_404', ''));
		if(!Manga::isExist(array('slug'=>P('slug')))) exit(event('render_404', ''));
		if(P('chapter') != '')
			if(!Chapter::isExist(array('chapter'=>P('chapter')))) exit(event('render_404', ''));

		$moderated = C('app.commentModerate', '1') ? '0' : '1';
		$commentInfo = array('manga'=>$thisManga['mangaId'],
							'chapter'=>$thisChapter['chapter'],
							'author'=>session_get('thisUser', 'userId'),
							'content'=>R('content'),
							'ip'=>ip2long(ip()),
							'field'=>R('field'),
							'thetime'=>time(),
							'moderated'=>$moderated
							);

		$f = time()-C('app.commentLimitTime', '300'); // From y seconds back from now
		$t = time(); // This is now
		$spamCheck = Comment::count(array(
										'AND'=>array('author'=>session_get('thisUser', 'userId'), 
													'thetime[<>]'=>array($f, $t)
													)
										)
									);
		if($spamCheck >= C('app.commentLimit', '3')){
			$message = array('danger', sprintf(T('You can only comment %1s times in %2s seconds'), C('app.commentLimit', '3'), C('app.commentLimitTime', '300')) );
		}else if(strlen($commentInfo['content']) > C('app.commentLMax', '140') OR strlen($commentInfo['content']) < C('app.commentLMin', '10')){
			$template->message = array('danger', sprintf(T('Your comment must between %1s and %2s characters'), C('app.commentLMin', '10'), C('app.commentLMax', '140')), 'comment');
		}else{			
			$cmId = Comment::add($commentInfo);
			event('comment_posted', $cmId);
			$m = C('app.commentModerate', '1') ? T('Your comment was successfully submitted but is waiting for moderation!') : T('Comment was successfully submitted');
			$template->message = array('info', $m, 'comment');
		}

		


	}
