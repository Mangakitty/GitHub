<?php

	if (!defined("_WASD_")) exit;

	$template->title = T('Admin Control Panel') .' - '. T2up('Manga');

	switch ($pparams['action']) {
		case 'new':
			if(!empty($_POST)){

				$insert['name'] = trim($_POST['name']);
			    $insert['slug'] = trim($_POST['slug']);
			    $insert['alternativeName'] = $_POST['alternativeName'];
			    $insert['description'] = nl2br($_POST['description']);
			    $insert['released'] = $_POST['released'];
			    $insert['mangaType'] = $_POST['mangaType'];
			    $insert['author'] = $_POST['author'];
			    $insert['artist'] = $_POST['artist'];
			    $insert['genre'] = $_POST['genre'];
			    $insert['mangaStatus'] = $_POST['mangaStatus'];

				$slugSelect = WASD::$sql->select(C('app.db_prefix').'manga', array('mangaId'), array('slug'=>$insert['slug'], 'LIMIT'=>'1'));
				if(is_array($slugSelect) && count($slugSelect) == '1'){
					$template->content = $template->render('manga-new.php');
					$template->noty = array('danger',T('This slug is already exist, please modify it a little bit'));
				}else{

					// DO SAVE COVER
					$cover = $_POST['cover'];
					$img = new Vendor\SimpleImage();
					directory_is_writable(ROOT_DIR.'/upload/cover');
					$insert['cover'] = '/upload/cover/'.uniqid().'.png';
					$img->load_base64($cover)->fit_to_width(200)->save(ROOT_DIR.$insert['cover']);

					WASD::$sql->insert(C('app.db_prefix').'manga', $insert);
					redirect(URL('admin/management/manga'));
				}

			}else{
				$template->content = $template->render('manga-new.php');
			}
			break;

		case 'edit':
			$slug = $pparams['slug'];
			if($slug == '') redirect(URL('admin/management/manga'));

			$thisManga = WASD::$sql->select(C('app.db_prefix').'manga', '*', array('slug'=>trim($slug), 'LIMIT'=>'1'));
			$thisManga = $thisManga[0];
			$template->thisManga = $thisManga;

			if(!empty($_POST)){

				$insert['name'] = trim($_POST['name']);
			    $insert['slug'] = trim($_POST['slug']);
			    $insert['alternativeName'] = $_POST['alternativeName'];
			    $insert['description'] = nl2br($_POST['description']);
			    $insert['released'] = $_POST['released'];
			    $insert['mangaType'] = $_POST['mangaType'];
			    $insert['author'] = $_POST['author'];
			    $insert['artist'] = $_POST['artist'];
			    $insert['genre'] = $_POST['genre'];
			    $insert['mangaStatus'] = $_POST['mangaStatus'];

			    $slugSelect = WASD::$sql->select(C('app.db_prefix').'manga', array('mangaId'), array('slug'=>$insert['slug'], 'LIMIT'=>'1'));
				if($insert['slug'] != $slug && is_array($slugSelect) && count($slugSelect) == '1'){
					$template->content = $template->render('manga-edit.php');
					$template->noty = array('danger',T('This slug is already exist, please modify it a little bit'));
				}else{

					// DO SAVE COVER
					$cover = $_POST['cover'];
					if($cover != ''){
						unlink(ROOT_DIR.$thisManga['cover']);
						$img = new Vendor\SimpleImage();
						directory_is_writable(ROOT_DIR.'/upload/cover');
						$insert['cover'] = '/upload/cover/'.uniqid().'.png';
						$img->load_base64($cover)->fit_to_width(200)->save(ROOT_DIR.$insert['cover']);
					}

					WASD::$sql->update(C('app.db_prefix').'manga', $insert, array('slug'=>$slug));
					redirect(URL('admin/management/manga'));
				}

			}else{
				$template->content = $template->render('manga-edit.php');
			}
			
			break;

		case 'delete':
			$slug = P('slug');
			if($slug == '') redirect(URL('admin/management/manga'));
			$thisManga = WASD::$sql->select(C('app.db_prefix').'manga', '*', array('slug'=>trim($slug), 'LIMIT'=>'1'));
			$thisManga = $thisManga[0];
			unlink(ROOT_DIR.$thisManga['cover']);
			deleteDir(ROOT_DIR.'/upload/manga/'.$thisManga['slug']);
			WASD::$sql->delete(C('app.db_prefix').'chapter', array('manga'=>$thisManga['mangaId']));
			WASD::$sql->delete(C('app.db_prefix').'comment', array('manga'=>$thisManga['mangaId']));
			WASD::$sql->delete(C('app.db_prefix').'manga', array('slug'=>$slug, 'LIMIT'=>'1'));
			redirect(URL('admin/management/manga'));
			break;
			
		default:
			break;
	}

	/*******************************************************
	* TEMPLATING  *
	********************************************************/
	

	$template->customJs .= '
							$("#inputName").on("keyup", function(){
								var n = $("#inputName").val(),
									s = n.replace(/\ /g, "-").replace(/[!@#$%^&*]/g, "");
								$("#inputSlug").val(s);
							});	
							
							function readImage(input) {
							    if ( input.files && input.files[0] ) {
							        var FR = new FileReader();
							        FR.onload = function(e) {
							             //$("#img").attr( "src", e.target.result );
							             $("#cover64").val( e.target.result );
							        };       
							        FR.readAsDataURL( input.files[0] );
							    }
							}

							$("#cover").change(function(){
							    readImage( this );
							});

							';

	// HEADER 

	$template->navigator = $template->render('/acp/views/navigator.php');
	$template->header = $template->render('/acp/views/header.php');

	// FOOTER
	$template->footer = $template->render('/acp/views/footer.php');
	

	// DONE, RENDERING
	echo $template->render('/acp/views/main.php');

	
