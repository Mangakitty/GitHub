<?php

	if (!defined("_WASD_")) exit;

	$template->title = T('Admin Control Panel') .' - Comment list';

	switch (R('action')) {
		case 'delete-selected':
			$comment = explode(';', rtrim($_POST['comment'], ';'));
			foreach ($comment as &$commentId) {
				Comment::field(array('manga', 'chapter'));
				$commentInfo = Comment::findFirst();
				if($commentInfo['chapter'] != '')
					$query1 = WASD::$sql->update(C('app.db_prefix').'chapter', array('comments[-]'=>'1'),
										array('AND'=>array('mangaId'=>$commentInfo['manga'], 'chapterId'=>$commentInfo['chapter'])));

					$query1 = WASD::$sql->update(C('app.db_prefix').'manga', array('comments[-]'=>'1'),
											array('AND'=>array('mangaId'=>$commentInfo['manga'])));

					$query3 = WASD::$sql->delete(C('app.db_prefix').'comment', 
												array('commentId'=>$commentId));
					
				if($commentId != end($comment)){ $log .= $commentId.', '; }else{ $log = rtrim($log, ', ').' and '.$commentId; }
			}
			$template->noty = array('info',T('Comment(s) removed'));
			adminLog(sprintf(T('Removed comment(s) (#%1s)'), $log));
			break;

		case 'delete':
			$commentId = R('commentId');
			Comment::field(array('manga', 'chapter'));
			$commentInfo = Comment::findFirst();
			if($commentInfo['chapter'] != '')
				$query1 = WASD::$sql->update(C('app.db_prefix').'chapter', array('comments[-]'=>'1'),
										array('AND'=>array('mangaId'=>$commentInfo['manga'], 'chapterId'=>$commentInfo['chapter'])));

				$query1 = WASD::$sql->update(C('app.db_prefix').'manga', array('comments[-]'=>'1'),
										array('AND'=>array('mangaId'=>$commentInfo['manga'])));

				$query3 = WASD::$sql->delete(C('app.db_prefix').'comment', 
											array('commentId'=>$commentId));
			
			$template->noty = array('info',T('Comment removed'));
			adminLog(sprintf(T('Removed a comment (#%1s)'), $commentId));
			break;
		
		case 'approve':
			$commentId = R('commentId');
			$query = WASD::$sql->update(C('app.db_prefix').'comment', 
										array('moderated'=>'1'),
										array('commentId'=>$commentId));
			$template->noty = array('info',T('Comment approved'));
			adminLog(sprintf(T('Approved a comment (#%1s)'), $commentId));
			break;
		case 'update':
			$thisComment = Comment::findFirst(array('commentId'=>R('commentId')));
			$thisComment = array_merge($thisComment, array('content'=>R('content')));
			$thisComment = event('do_comment_info', $thisComment);
			WASD::$sql->update(C('app.db_prefix').'comment', $thisComment, array('commentId'=>R('commentId')));
			$template->noty = array('info',T('Comment successfully edited'));
			adminLog(sprintf(T('Edited a comment (#%1s)'), R('commentId')));

			break;
		default:
			break;
	}

	
	/*******************************************************
	* FILTERING AND PAGINATING *
	********************************************************/

	$wheres =  array(); // Where conditions for sure

	// IF CATEGORY ISSET
	$c['per-page'] = '20';
	$c['thisPage'] = isset($pparams['thisPage']) ? $pparams['thisPage'] : '0';

	if(R('q') != '') $wheres['LIKE'] = array('content'=>substr(strip_tags(R('q')), 0, 15));
	$wheres['AND'] = array();
	if(R('manga') != '') $wheres['AND'] = array_merge($wheres['AND'], array('manga'=>R('manga')));
	if(R('chapter') != '') $wheres['AND'] = array_merge($wheres['AND'], array('chapter'=>R('chapter')));
	if(R('author') != '') $wheres['AND'] = array_merge($wheres['AND'], array('author'=>R('author')));
	if(count($wheres['AND']) == 0) unset($wheres['AND']);

	// COUTING AND DO PAGINATING
	$total = WASD::$sql->count(C('app.db_prefix').'comment', $wheres);
	$p = paginator($total, $c['per-page'], $c['thisPage']);
	$wheres['LIMIT'] = array($p['s'], $c['per-page']);
	$wheres['ORDER'] = R('order') != '' ? R('order').' desc' : 'moderated ASC, thetime DESC';

	// NOW FETCH

	$template->comments = Comment::find($wheres);
	

	$template->p = $p;
	$template->c = $c;
	$template->url = URL('admin/management/comment');
	$template->params = array();


	/*******************************************************
	* TEMPLATING  *
	********************************************************/
	$template->customJs .= '$(".btn-delete").on("click", function(){
								$(this).hide();
								$(this).nextAll(".btn-confirm").show();
							});
							$("input:checkbox.cbox").change(function(){
								$(".btn-delete-selected").removeClass("disabled");	
							});
							$(".btn-delete-selected").on("click", function(){
								var vl = "";
								$("input:checkbox.cbox").each(function () {
							       vl += (this.checked ? $(this).val()+";" : "");
							    });
								$("input.comment-selected").val(vl);
								$("#delete-selected").submit();
							});
							
							

			
	';	
	


	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	$template->content = $template->render('comment-list.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
