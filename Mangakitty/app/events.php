<?php 

if (!defined("_WASD_")) exit; 	

	event('do_comment_info', NULL, function($a){
		$a['field'] = json_encode($a['field']);
		$a['content'] = strip_tags($a['content']);
		return $a;
	});

	event('user_out', NULL, function($a){
		$a['preferences'] = json_decode($a['preferences'], true);
		return $a;
	});

	event('user_in', NULL, function($a){
		$a['preferences'] = json_encode($a['preferences']);
		return $a;
	});

	event('render_comment', NULL, function($a){
		$a['field'] = json_decode($a['field'], true);
		$a['content'] = nl2br($a['content']);
		return $a;
	});
	
	event('do_manga_info', NULL, function($array){
		return $array;
	});
	
	event('do_chapter_info', NULL, function($array){
		return $array;
	});

	event('do_author', NULL, function($string){
		$authors = explode(",", $string);
		foreach ($authors as &$author) {    
			$author = trim($author);
			$return .= "<a href='".URL(T('manga-directory', 'directory').'?author='.$author)."' title='".T('Author')." ".$author."'>".$author."</a>, ";
		}
		return rtrim($return, ', '); 
	});

	event('do_artist', NULL, function($string){
		$artists = explode(",", $string);
		foreach ($artists as &$artist) {    
			$artist = trim($artist);
			$return .= "<a href='".URL(T('manga-directory', 'directory').'?artist='.$artist)."' title='".T('Artist')." ".$artist."'>".$artist."</a>, ";
		}
		return rtrim($return, ', ');
	});

	event('do_genre', NULL, function($string){
		$genres = explode(",", $string);
		foreach ($genres as &$genre) {    
			$genre = trim($genre);
			$return .= "<a href='".URL(T('manga-directory', 'directory').'?genre='.$genre)."' title='".T('Genre')." ".$genre."'>".$genre."</a>, ";
		}
		return rtrim($return, ', ');
	});

	event('print_manga_url', NULL, function($manga){ 
		if(!is_array($manga)){
			$manga = WASD::$sql->select(C('app.db_prefix').'manga', array('mangaId','slug'), array('mangaId'=>$manga, 'LIMIT'=>'1'));
			return URL(T('manga-slug', 'manga').'/'.$manga[0]['slug']);
		}else{	
			return URL(T('manga-slug', 'manga').'/'.$manga['slug']);
		}
	});

?>