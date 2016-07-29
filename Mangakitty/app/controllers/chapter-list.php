<?php

	if (!defined("_WASD_")) exit;

	$template->title = T('Admin Control Panel') .' - '. T('Chapter List');

	if($pparams['manga'] == '') redirect(URL('admin/management/manga'));
	$thisManga = WASD::$sql->select(C('app.db_prefix').'manga', 
									array('mangaId', 'name', 'slug', 'cover'), 
									array('slug'=>$pparams['manga']));
	$thisManga = $thisManga[0];
	$template->thisManga = $thisManga;

	switch ($pparams['action']) {
		case 'new':

			if(!empty($_POST)){
				$array['manga'] = $thisManga['mangaId'];
				$array['chapter'] = R('chapter');
				$array['name'] = R('name');
				$array['content'] = R('content');
				$array['thetime'] = time();

				$chapterCheck = WASD::$sql->select(C('app.db_prefix').'chapter', array('chapterId'), array('AND'=>array('chapter'=>$array['chapter'], 'manga'=>$thisManga['mangaId']), 'LIMIT'=>'1'));
				if(is_array($chapterCheck) && count($chapterCheck) == '1'){
					$template->content = $template->render('chapter-new.php');
					$template->noty = array('danger',T('This chapter nchapterumber is already exist, please change it'));
				}else{
					WASD::$sql->insert(C('app.db_prefix').'chapter', $array);
					WASD::$sql->update(C('app.db_prefix').'manga', array('lastChapter'=>$array['chapter'], 'lastUpdate'=>time()), array('mangaId'=>$thisManga['mangaId'], 'LIMIT'=>'1'));
					redirect(URL('admin/management/chapter/'.$thisManga['slug']));
				}

			}else{
				$template->content = $template->render('chapter-new.php');
			}
			break;
		
		case 'edit':

			$thisChapterNumber = $pparams['chapter'];
			$thisChapter = WASD::$sql->select(C('app.db_prefix').'chapter', '*', array('AND'=>array('chapter'=>$thisChapterNumber, 'manga'=>$thisManga['mangaId'])));
			$thisChapter = $thisChapter[0];
			$template->thisChapter = $thisChapter;

			if(!empty($_POST)){
				$array['manga'] = $thisManga['mangaId'];
				$array['chapter'] = R('chapter');
				$array['name'] = R('name');
				$array['content'] = R('content');

				$chapterCheck = WASD::$sql->select(C('app.db_prefix').'chapter', array('chapterId'), array('AND'=>array('chapter'=>$array['chapter'], 'manga'=>$thisManga['mangaId']), 'LIMIT'=>'1'));			
				if(($array['chapter'] != $thisChapterNumber) && is_array($chapterCheck) && count($chapterCheck) == '1'){
					$template->content = $template->render('chapter-edit.php');
					$template->noty = array('danger',T('This chapter number is already exist, please change it'));
				}else{
					WASD::$sql->update(C('app.db_prefix').'chapter', $array, array('AND'=>array('chapter'=>$thisChapterNumber, 'manga'=>$thisManga['mangaId'])));
					redirect(URL('admin/management/chapter/'.$thisManga['slug']));
				}

			}else{
				$template->content = $template->render('chapter-edit.php');
			}

			break;
		case 'delete':
			$thisChapterNumber = $pparams['chapter'];
			$thisChapter = WASD::$sql->select(C('app.db_prefix').'chapter', '*', array('AND'=>array('chapter'=>$thisChapterNumber, 'manga'=>$thisManga['mangaId'])));
			$thisChapter = $thisChapter[0];

			deleteDir(ROOT_DIR.'/upload/manga/'.$thisManga['slug'].'/'.$thisChapterNumber.'/');
			WASD::$sql->delete(C('app.db_prefix').'comment', array('chapter'=>$thisChapter['chapterId']));
			WASD::$sql->delete(C('app.db_prefix').'chapter', array('chapterId'=>$thisChapter['chapterId']));
			redirect(URL('admin/management/chapter/'.$thisManga['slug']));

			break;
		default:
			break;
	}

	
	/*******************************************************
	* FILTERING AND PAGINATING *
	********************************************************/

	$wheres =  array(); // Where conditions for sure
	$wheres['AND']['manga'] = $thisManga['mangaId'];

	// IF CATEGORY ISSET

	$c['per-page'] = isset($pparams['perPage']) ? $pparams['perPage'] : C('app.mangaPerPage', '20');
	$c['thisPage'] = isset($pparams['thisPage']) ? $pparams['thisPage'] : '0';

	if(R('q') != '') $wheres['LIKE'] = array('name'=>R('q'));

	// COUTING AND DO PAGINATING
	$orderType = R('orderType') == '' ? 'DESC' : R('orderType');
	$wheres['ORDER'] = (R('order') == 'chapter' OR R('order') == '') ? 'CAST(chapter AS DECIMAL(10,6)) '.$orderType : R('order').' '.$orderType;

	// NOW FETCH
	$template->chapters = $chapters = WASD::$sql->query("SELECT manga, chapter, name, thetime, customFields, comments FROM ".C('app.db_prefix')."chapter WHERE manga = '".$thisManga['mangaId']."' ORDER BY ".$wheres['ORDER'])->fetchAll();
	

	/*******************************************************
	* TEMPLATING  *
	********************************************************/
	

	$template->customJs .= '$("#chapterNumber").on("keyup", function(){
								$("#chapterInfoDiv").show();
								var chapter = $("#chapterNumber").val();
								
								$("#fileupload").fileupload({
									formData: [ { name: "phpmanga", value: phpmanga }, { name: "mangadir", value: dir+chapter }]
								});
	   
							});


							function readImage(input) {
								for(var i=0,file; file = input.files[i]; i++) {
								 	var FR = new FileReader();
							        FR.onload = function(e) {
							        	var base64 = e.target.result,
							        		h = $("#inputUploader").data("href"),
							        		d = $("#inputUploader").data("dir")+$("#chapterNumber").val(),
									        options = {
									            type: "POST",
									            url: h,
									            data: { base64 : base64 , dir : d },
									            dataType: "json",
									            success: function(response) {
									                if(response.s == "ko"){
									                  alert(response.m);
									                }else if(response.s == "ok"){
									                  $("textarea#inputContent").val($("textarea#inputContent").val()+""+response.m+";");
									                }
									            }
									        };
									      $.ajax(options);
							        };       
							        FR.readAsDataURL( input.files[i] );
								}
							}

							$("#inputUploader").change(function(){
							    readImage( this );
							});

    						';

	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');


	// CONTENT
	if(!isset($template->content))
		$template->content = $template->render('chapter-list.php');


	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
