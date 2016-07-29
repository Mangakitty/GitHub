<?php 

	add_shortcode('dropdown', 'dropdown');
	add_shortcode('link', 'mangaMenu');
	add_shortcode('analytic', 'GA');


	function dropdown($a){
		$a['link'] = explode('|', $a['link']);
		$a['title'] = explode('|', $a['title']);
		if (empty($a['link']) || empty($a['title'])) return false;
		for($i = 0; $i < count($a['link']); $i++ ){
			$return .= '<li><a href="'.URL($a['link'][$i]).'">'.$a['title'][$i].'</a></li>';
		}
		$return ='<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$a['name'].'  <b class="caret"></b></a>
					<ul class="dropdown-menu">
					'.$return.'
					</ul>
				  </li>';
		return $return;
	}
	function mangaMenu($a){
		return '<li><a href="'.URL($a['url']).'" class="'.$a['class'].'" id="'.$a['id'].'">'.$a['title'].'</a></li>';
	}
	function GA($a){
		return '
		  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

		  ga(\'create\', \''.$a['id'].'\', \'auto\');
		  ga(\'send\', \'pageview\');

		';
	}

	// HOME CONTENT WIDGETS
	add_shortcode('latest-manga', 'latest_manga');
	add_shortcode('latest-manga2', 'latest_manga2');


	function latest_manga($a){
		$l = $a['quantity'];
		$mangas = WASD::$sql->select(C('app.db_prefix').'manga', array('cover', 'slug', 'name', 'lastChapter', 'lastUpdate'), array('LIMIT'=>$l, 'ORDER'=>'lastUpdate DESC'));
		if(!empty($a['title'])) $return = '<h3>'.$a['title'].'</h3>';
		$return .= '<table class="table table-bordered table-hover">
					<thead>
					  <tr>
						<th colspan="2">'.T('Manga').'</th>
						<th>'.T('Last Chapter').'</th>
					  </tr>
					</thead>';
		foreach( $mangas as &$manga ){
			$return .= '<tr>
			                  	<td style="background-image:url(\''.URL($manga['cover']).'\');width:100px;height:100%;background-size: 100px; background-position:50% 30%; "></td>
			                    <td><h4><a href="'.event('print_manga_url', $manga).'">'.$manga['name'].'</a></h4></td>
			                    <td><a href="'.event('print_manga_url', $manga).'/'.$manga['lastChapter'].'">'.$manga['lastChapter'].'</a> ('.relativeTime($manga['lastUpdate']).')</td>
			                  </tr>';
		}
		$return .= '</table>';
		return $return;

	}	

	function latest_manga2($a){
		$l = $a['quantity'];
		$mangas = WASD::$sql->select(C('app.db_prefix').'manga', array('cover', 'slug', 'name', 'lastChapter', 'lastUpdate', 'released'), array('LIMIT'=>$l, 'ORDER'=>'lastUpdate DESC'));
		if(!empty($a['title'])) $return = '<h3>'.$a['title'].'</h3>';
		$return .= '<div id="pop-href" data-href="'.URL('popover').'">';
		foreach( $mangas as &$manga ){
			$return .= '<div>
					      <span data-toggle="mangapop" manga-slug="'.$manga['slug'].'" data-placement="right" data-original-title="'.$manga['name'].' '.$manga['released'].'">
					      	<b><a href="'.event('print_manga_url', $manga).'">'.$manga['name'].'</a></b>
					      </span>
					      <span class="pull-right"><i>'.relativeTime($manga['lastUpdate']).'</i></span>
					      <br>
					      <span class="blur"><a href="'.event('print_manga_url', $manga).'/'.$manga['lastChapter'].'">'.$manga['name'].' '.$manga['lastChapter'].'</a></span> 
	      				</div>';
      	}
      	$return .= '</div>';
      	return $return;
	}

	// SINGLE MANGA CONTENT & WIDGETS

	add_shortcode('manga-cover', 'manga_cover');
	add_shortcode('manga-info', 'manga_info');
	add_shortcode('manga-chapter-list', 'chapter_list');
	add_shortcode('fb-comment', 'fbCM');

	function manga_cover($a){
		$slug = P('slug');
		if($slug == '') return false;
		$cover = WASD::$sql->select(C('app.db_prefix').'manga', array('cover'), array('slug'=>$slug, 'LIMIT'=>'1'));
		return '<img class="thumbnail manga-cover" width="100%" src="'.URL($cover[0]['cover']).'">';
	}

	function manga_info($a){
		$slug = P('slug');
		if($slug == '') return false;
		$thisManga = WASD::$sql->select(C('app.db_prefix').'manga', '*', array('slug'=>$slug, 'LIMIT'=>'1'));
		$thisManga = $thisManga[0];
		$return = '<h1 id="tables">'.$thisManga['name'].'</h1>
					<h4>'.$thisManga['alternativeName'].'</h4>	 
					<table class="table table-striped">
					<tbody>
						<tr>
							<td>'.T('Author(s)').'</td>
							<td>'.T('Artist(s)').'</td>
							<td>'.T('Genre(s)').'</td>
						</tr>
						<tr>
							<td>'.event('do_author', $thisManga['author']).'</td>
							<td>'.event('do_artist', $thisManga['artist']).'</td>
							<td>'.event('do_genre', $thisManga['genre']).'</td>
						</tr>
					</tbody>
					</table>	
					<h3>'.T('Description').'</h3>
					<p>'.$thisManga['description'].'</p>';
		return $return;					
	}

	function chapter_list($a){
		$slug = P('slug');
		if($slug == '') return false;
		
		$thisManga = WASD::$sql->select(C('app.db_prefix').'manga', '*', array('slug'=>$slug, 'LIMIT'=>'1'));
		$thisManga = $thisManga[0];
		$chapters = WASD::$sql->query("SELECT chapter, name, thetime, customFields FROM ".C('app.db_prefix')."chapter WHERE manga = '".$thisManga['mangaId']."' ORDER BY CAST(chapter AS DECIMAL(10,6)) DESC")->fetchAll();

		$return = '<h3>'.T('Chapters').'</h3>
					<table class="table table-hover">
						<tbody>';
		foreach ($chapters as &$chapter){
		$return .= '<tr>
						<td><a href="'.event('print_manga_url', $thisManga).'/'.$chapter['chapter'].'"><b>'. $thisManga['name'].' '.$chapter['chapter'].'</b> </a></td>
						<td>'.$chapter['name'].'</td>
					</tr>';
		}					
		$return .= '</tbody>
					</table>';
		return $return;
	}

	// SINGLE CHAPTER 

	add_shortcode('home', 'home_menu');
	add_shortcode('directory', 'directory_menu');
	add_shortcode('read-webtoon', 'webtoon');
	add_shortcode('read-pbp', 'pbp');
	add_shortcode('select-chapter', 'select_chapter');
	add_shortcode('select-page', 'select_page');

	function home_menu($a){
		$a['title'] = isset($a['title']) ? $a['title'] : T('Home');
		return '<li class="active"><a href="'.URL('').'"><span class="icon-home"></span>&nbsp;&nbsp;'.$a['title'].'</a></li>';
	}	
	function directory_menu($a){
		$a['title'] = isset($a['title']) ? $a['title'] : T('Manga Directory');
		return '<li><a href="'.URL(T('directory-slug', 'directory')).'">'.$a['title'].'</a></li>';
	}

	function select_chapter($a){
		$a['style'] = isset($a['style']) ? $a['style'] : '';
		$manga = P('slug');
		$chapter = P('chapter');
		$thisManga = WASD::$sql->select(C('app.db_prefix').'manga', '*', array('slug'=>$manga, 'LIMIT'=>'1'));
		$thisManga = $thisManga[0];
		$chapters = WASD::$sql->select(C('app.db_prefix').'chapter', array('chapter'), array('manga'=>$thisManga['mangaId']));	
		foreach($chapters as &$chap){
			$select[event('print_manga_url', $thisManga).'/'.$chap['chapter']] = $thisManga['name'].' '.$chap['chapter'];
		}
		$return .= '<div style="margin:70px 0 20px 0;'.$a['style'].'">';
		$return .= Form::select('mangaType', event('print_manga_url', $thisManga).'/'.$chapter, $select, array('class'=>'form-control', 'onchange'=>"window.location=this.value;"));
		$return .= '</div>';
		return $return;
	}

	function select_page($a){
		$page = R(T('page-slug', 'page'), '0');
		$manga = P('slug');
		$chapter = P('chapter');
		$thisManga = WASD::$sql->select(C('app.db_prefix').'manga', '*', array('slug'=>$manga, 'LIMIT'=>'1'));
		$thisManga = $thisManga[0];
		$select = WASD::$sql->select(C('app.db_prefix').'chapter', array('content', 'customFields'), array('AND'=>array('manga'=>$thisManga['mangaId'], 'chapter'=>$chapter), 'LIMIT'=>'1'));
		$images = rtrim($select[0]['content'], ';');
		$images = explode(';', $images);
		$total = count($images);
		for ($i=0; $i < $total; $i++) { 
			$selectBox[url_param(currentUrl(), array(T('page-slug', 'page')=>$i))] = sprintf(T('Page %1s'), $i);
		}
		if($page > '0') $return .= '<a href="'.url_param(currentUrl(), array(T('page-slug', 'page')=>$page-1 )).'" class="label label-info">'.T('Previous page').'</a>'; 
		$return .= Form::select('mangaType', currentUrl(), $selectBox, array('class'=>'form-control input-sm', 'onchange'=>"window.location=this.value;", 'style'=>'max-width:100px;display:inline;margin:0px 10px'));
		if($page < $total-1) $return .= '<a href="'.url_param(currentUrl(), array(T('page-slug', 'page')=>$page+1)).'" class="label label-info">'.T('Next page').'</a>'; 
		return $return;
	}

	function fbCM($a){
		$id = $a['appId'];
		$quantity = isset($a['quantity']) ? $a['quantity'] : '10';
		$color = isset($a['color']) ? $a['color'] : 'light';
		if(isset($a['title'])) $return .= '<h3>'.$a['title'].'</h3>';
		$return .= '<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId='.$id.'&version=v2.0";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, \'script\', \'facebook-jssdk\'));</script>';
		$return .= '<div class="fb-comments" data-width="100%" data-href="'.currentUrl(0).'" data-numposts="'.$quantity.'" data-colorscheme="'.$color.'"></div>';
		return $return;
	}

	function webtoon($a){
		$manga = P('slug');
		$chapter = P('chapter');
		$thisManga = WASD::$sql->select(C('app.db_prefix').'manga', '*', array('slug'=>$manga, 'LIMIT'=>'1'));
		$thisManga = $thisManga[0];
		$select = WASD::$sql->select(C('app.db_prefix').'chapter', array('content', 'customFields'), array('AND'=>array('manga'=>$thisManga['mangaId'], 'chapter'=>$chapter), 'LIMIT'=>'1'));
		$images = rtrim($select[0]['content'], ';');
		$images = explode(';', $images);
		$return .= '<div class="chapter-content">';
		foreach($images as &$image){
			$return .= '<img src="'.URL(trim($image)).'" class="chapter-img"><br /><br />';
		}
		$return .= '</div>';
		return $return;
	}


	function pbp($a){
		$page = R(T('page-slug', 'page'), '0');
		$manga = P('slug');
		$chapter = P('chapter');
		$thisManga = WASD::$sql->select(C('app.db_prefix').'manga', '*', array('slug'=>$manga, 'LIMIT'=>'1'));
		$thisManga = $thisManga[0];
		$select = WASD::$sql->select(C('app.db_prefix').'chapter', array('content', 'customFields'), array('AND'=>array('manga'=>$thisManga['mangaId'], 'chapter'=>$chapter), 'LIMIT'=>'1'));
		$images = rtrim($select[0]['content'], ';');
		$images = explode(';', $images);
		$return .= '<div class="chapter-content">';
		if($page != count($images) - 1){
			$return .= '<a href="'.url_param(currentUrl(), array(T('page-slug', 'page')=>$page+1)).'"><img src="'.URL(trim($images[$page])).'" class="chapter-img"></a><br /><br />';
		}else{
			$return .= '<img src="'.URL(trim($images[$page])).'" class="chapter-img"><br /><br />';
		}
		$return .= '</div>';
		if($page != count($images) - 1){
			$return .= '<img src="'.URL(trim($images[$page+1])).'" style="display:none">';
		}
		$return .= '<script>
						window.onload = function() {
							$(document).keyup(function (event) {						 
							  if (event.keyCode == 37) {  
							  	'.($page != 0 ? 'window.location.href = "'.url_param(currentUrl(), array(T('page-slug', 'page')=>$page-1)).'";' : '').'
							  } else if (event.keyCode == 39) {
							    '.($page != (count($images) - 1) ? 'window.location.href = "'.url_param(currentUrl(), array(T('page-slug', 'page')=>$page+1)).'";' : '').'
							  }
							});  
						};	
					</script>';
		return $return;
	}

	add_shortcode('text-version', 'text_version');
	add_shortcode('paging-version', 'paging_version');
	add_shortcode('listing', 'listing');
	add_shortcode('listing-sidebar', 'listing_sidebar');
	add_shortcode('search-box', 'search_box');
	
	function listing($a){
		$default = isset($a['default']) ? $a['default'] : 'paging';
		$type = (R('type') != '') ? R('type') : $default;
		$chooseable = isset($a['chooseable']) ? $a['chooseable'] : 'yes';

		if($chooseable == 'yes')
			$return .= '<div class="btn-group btn-block">
						    <button class="btn btn-sm btn-info" disabled="">'.T('Listing type').'</button>
						    <a href="'.url_param(currentUrl(), array('type'=>'text')).'" class="btn btn-sm btn-info '.($type == 'text' ? 'active' : '').'"><i class="glyphicon glyphicon-th"></i> '.T('ALL IN ONE PAGE').'</a>
						    <a href="'.url_param(currentUrl(), array('type'=>'paging')).'" class="btn btn-sm btn-info '.($type == 'paging' ? 'active' : '').'"><i class="glyphicon glyphicon-th-list"></i> '.T('PAGINATION').'</a>
						</div> <div class="clearfix"><br /></div>';

		$type = $type.'_version';
		$return .= $type($a);


		return $return;

	}

	function paging_version($a){
		$c['per-page'] = isset($a['perpage']) ? $a['perpage'] : '50';
		$c['thisPage'] = R(T('this-page-slug', 'c-page')) != '' ? R(T('this-page-slug', 'c-page')) : '0';

		if(R('q') != '') $wheres['LIKE'] = array('name'=>substr(strip_tags(R('q')), 0, 15));
		if(R('genre') != '') $wheres['LIKE'] = array('genre'=>substr(strip_tags(R('genre')), 0, 15));
		if(R('artist') != '') $wheres['LIKE'] = array('artist'=>substr(strip_tags(R('artist')), 0, 15));
		if(R('author') != '') $wheres['LIKE'] = array('author'=>substr(strip_tags(R('author')), 0, 15));
		if(R('released') != '') $wheres['AND'] = array('released'=>intval(R('released')));
		if(R('status') != '' && in_array(R('status'), array('ongoing', 'completed', 'dropped'))) 
			$wheres['AND'] = array('mangaStatus'=>strtr(R('status'), array('ongoing'=>'0', 'completed'=>'1', 'dropped'=>'2')));

		// COUTING AND DO PAGINATING
		$total = WASD::$sql->count(C('app.db_prefix').'manga', $wheres);
		$p = paginator($total, $c['per-page'], $c['thisPage']);
		$wheres['LIMIT'] = array($p['s'], $c['per-page']);

		$order = (R('sorting') != '' && in_array(R('sorting'), array('views', 'name', 'lastUpdate', 'comment', 'views'))) ? R('sorting') : ($a['default-sorting'] != '' ? $a['default-sorting'] : 'name');
		$sortingType = R('sorting-type') == '' ? ($a['default-sorting-type'] != '' ? $a['default-sorting-type'] : 'ASC') : R('sorting-type');
		
		$wheres['ORDER'] = $order.' '.$sortingType;

		// NOW FETCH
		$mangas = WASD::$sql->select(C('app.db_prefix').'manga',  '*', $wheres);

		// PAGINATION
		$return .= '<ul class="pagination blue" style="margin:0">
						'.printPaginator($p, currentUrl()).'
					</ul>';

    	// ORDER TYPE/*
    	$return .= '<div class="btn-group" style="float:right;padding-left: 5px;">
				    <a href="'.url_param(currentUrl(), array('sorting-type'=>'ASC')).'" class="btn btn-sm btn-info "><i class="glyphicon glyphicon-sort-by-attributes"></i> '.T('ASC').'</a>
				    <a href="'.url_param(currentUrl(), array('sorting-type'=>'DESC')).'" class="btn btn-sm btn-info "><i class="glyphicon glyphicon-sort-by-attributes-alt"></i> '.T('DESC').'</a>
				</div>';

		// ORDER BY
		$return .= '<div class="btn-group" style="float:right">
				    <button class="btn btn-sm btn-info" disabled="">'.T('Sort by').'</button>
				    <a href="'.url_param(currentUrl(), array('sorting'=>'name')).'" class="btn btn-sm btn-info "><i class="glyphicon glyphicon-sort-by-alphabet"></i> '.T('Name').'</a>
				    <a href="'.url_param(currentUrl(), array('sorting'=>'views')).'" class="btn btn-sm btn-info "><i class="glyphicon glyphicon-eye-open"></i> '.T('Views').'</a>
				    <a href="'.url_param(currentUrl(), array('sorting'=>'lastUpdate')).'" class="btn btn-sm btn-info "><i class="glyphicon glyphicon-calendar"></i> '.T('Last update').'</a>
				</div>';				

		$return .= '<div class="clearfix"><br /><br /></div>';
			
		$return .= '<div id="pop-href" data-href="'.URL('popover').'">';

		foreach ($mangas as &$manga) {
			$return .= '<div class="col-lg-6 col-md-12" style="height:150px; margin-bottom:20px">
						<span class="thumbnail" data-toggle="mangapop" data-placement="right" manga-slug="'.$manga['slug'].'" data-original-title="'.$manga['name'].' ('.$manga['released'].')" style="padding: 10px; margin: 3px">
					      	<div class="media">
							  <a class="pull-left" href="'.event('print_manga_url', $manga).'" style="width: 100px;height: 124px;float: left;overflow: hidden;border: 1px #e5e5e5 solid;padding:2px">
							    <img class="media-object img-thumb" src="'.URL($manga['cover']).'" alt="'.$manga['name'].'" width="96px">
							  </a>
							  <div class="media-body">
							    <h3 class="media-heading" id="tables"><a href="'.event('print_manga_url', $manga).'">'.$manga['name'].'</a></h3>							    
							    <span style="float:left;display:block"><small>'.event('do_genre', $manga['genre']).'</small><br>
							    <span class="display:block">'.sprintf(T('Total views: %1s'), $manga['views']).'</span> <br>
							    '.T('Last chapter: ').' <a href="'.event('print_manga_url', $manga).'/'.$manga['lastChapter'].'">'.$manga['lastChapter'].'</a>
							    </span>							  
							  </div>
							</div>
					    </span>
					</div>';
		}
		
		$return .= '</div>';

		return $return;
	}

	function text_version($a){
		$return .= '<div id="pop-href" data-href="'.URL('popover').'">';
		$return .= '<div class="btn-group btn-block">
		    		<a href="#char-#" class="filter btn btn-sm btn-primary">#</a>';
		foreach (range('a', 'z') as $i) 
					$return .= '<a href="#char-'.$i.'" class="filter btn btn-sm btn-primary">'.strtoupper($i).'</a>';
		$return .= '</div>';

			// SPECIAL CHARACTER & NUMBERS

			$return .= '<div id="char-#" class="char col-lg-4 col-sm-6 .col-xs-12">
				<h3>#</h3>
				<hr>';
			$mangas = WASD::$sql->query("SELECT slug, name FROM ".C('app.db_prefix')."manga WHERE name NOT REGEXP '^[[:alpha:]]' ORDER BY name ASC")->fetchAll();
			foreach($mangas as &$manga)
				$return .= '<span data-toggle="mangapop" manga-slug="'.$manga['slug'].'" data-placement="auto" data-original-title="'.$manga['title'].'" class="manga-'.$manga['status'].'"><a href="'.event('print_manga_url', $manga).'"><strong>'.$manga['name'].'</strong></a></span><br />';
			$return .= '</div>';


			// ALPHABET CHARACTERS

		foreach (range('a', 'z') as $i){
			$return .= '<div id="char-'.$i.'" class="char col-lg-4 col-sm-6 .col-xs-12">
				<h3>'.strtoupper($i).'</h3>
				<hr>';
			$mangas = WASD::$sql->select(C('app.db_prefix').'manga', array('slug', 'name', 'mangaStatus(status)'), array('name[~]'=>$i.'%', 'ORDER'=>'name ASC'));
			foreach($mangas as &$manga)
				$return .= '<span data-toggle="mangapop" manga-slug="'.$manga['slug'].'" data-placement="auto" data-original-title="'.$manga['title'].'" class="manga-'.$manga['status'].'"><a href="'.event('print_manga_url', $manga).'"><strong>'.$manga['name'].'</strong></a></span><br />';
			$return .= '</div>';	
		}
		$return .= '</div>';
		return $return;

	}

	function listing_sidebar($a){
		if(trim(str_replace(URL(), '', currentUrl(0))) != T('directory-slug', 'directory')) return false;
		$return .= '<div id="listing_sidebar">
		<div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">'.T('Browser by genres').'</h3>
          </div>
          <div class="panel-body">
			<ul class="clrfix">
				<li><a  href="'.URL(T('directory-slug', 'directory')).'">'.T('All').'</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'Swimsuit')) .'">Swimsuit</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'butts')) .'">Butts</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'citing')) .'">Biting</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'chubby')) .'">Chubby</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'color')) .'">Color</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'cross-dressing')) .'">Cross Dressing</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'ecchi')) .'">Ecchi</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'dark-skin')) .'">Dark Skin</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'gender-bender')) .'">Gender Bender</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'femdom')) .'">Femdom</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'hairy')) .'">Hairy</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'lingerie')) .'">Lingerie</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'pegging')) .'">Pegging</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'shimapan')) .'">Shimapan</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'stockings')) .'">Stockings</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'toys')) .'">Toys</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'pregnant')) .'">Pregnant</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'maid')) .'">Maids</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'humiliation')) .'">Humiliation</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'romance')) .'">Romance</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'teacher')) .'">Teacher</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'sci-fi')) .'">Sci-fi</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'gangbang')) .'">Gangbang</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'face-sitting')) .'">Face sitting</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'solo')) .'">Solo</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'yaoi')) .'">Yaoi</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('genre'=>'yuri')) .'">Yuri</a></li>
			</ul>
          </div>
        </div>
		<div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">'.T('Browse Manga by Year of Released').'</h3>
          </div>
          <div class="panel-body">
			<ul class="clrfix" id="released_filter">
				<li><a  href="'.URL(T('directory-slug', 'directory')).'">'.T('All').'</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2015')) .'">2015</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2014')) .'">2014</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2013')) .'">2013</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2012')) .'">2012</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2011')) .'">2011</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2010')) .'">2010</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2009')) .'">2009</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2008')) .'">2008</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2007')) .'">2007</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2006')) .'">2006</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2005')) .'">2005</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2004')) .'">2004</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2003')) .'">2003</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2002')) .'">2002</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2001')) .'">2001</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'2000')) .'">2000</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'1999')) .'">1999</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'1998')) .'">1998</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'1997')) .'">1997</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'1996')) .'">1996</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('released'=>'older')) .'">'.T('Older').'</a></li>
			</ul>
          </div>
        </div>
		<div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">'.T('Browse Manga by Status').'</h3>
          </div>
          <div class="panel-body">
			<ul class="clrfix" id="status_filter" style="margin-bottom:0">
				<li><a  href="'.URL(T('directory-slug', 'directory')).'">'.T('All').'</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('status'=>'completed')) .'">'.T('Completed').'</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('status'=>'ongoing')) .'">'.T('Ongoing').'</a></li>
				<li><a  href="'.url_param( URL(T('directory-slug', 'directory')), array('status'=>'dropped')) .'">'.T('Dropped').'</a></li>
			</ul>
          </div>
        </div>
	</div>
	';

	return $return;
	}

	function search_box($a){
		$return .= Form::open(array('method'=>'GET', 'action'=>URL(T('directory'))));
		$return .= Form::input('q', R('q'), array('class'=>'form-control input-md', 'style'=>'margin-bottom:5px','placeholder'=>T('Type smth to search')));
		$return .= '<button type="submit" class="btn btn-block btn-md btn-primary"><i class="icon-find"></i> '.T('Search').'</button>';
		$return .= Form::close();
		$return .= '<div class="clearfix"><br /></div>';
		return $return;
	}


	add_shortcode('manga-list', 'manga_list');
	add_shortcode('manga-list2', 'manga_list2');
	add_shortcode('fb-like-box', 'fb_likebox');


	function manga_list($a){
		$l = isset($a['quantity']) ? $a['quantity'] : '20';
		$s = isset($a['sorting']) ? $a['sorting'] : 'views';
		$o = isset($a['order']) ? $a['order'] : 'DESC'; 
		$mangas = WASD::$sql->select(C('app.db_prefix').'manga', array('cover', 'slug', 'name', 'lastChapter', 'lastUpdate'), array('LIMIT'=>$l, 'ORDER'=>$s.' '.$o));
		if(!empty($a['title'])) $return = '<h3>'.$a['title'].'</h3>';
		$return .= '<table class="table table-bordered table-hover">';
		foreach( $mangas as &$manga ){
			$return .= '<tr>
			                  	<td style="background-image:url(\''.URL($manga['cover']).'\');width:40px;height:100%;background-size: 100px; background-position:50% 30%; cursor: hand; cursor: pointer;" onclick="window.location = \''.URL(event('print_manga_url', $manga)).'\';"></td>
			                    <td><strong><a href="'.event('print_manga_url', $manga).'">'.$manga['name'].'</a></strong>
			                    		<br /><a href="'.event('print_manga_url', $manga).'/'.$manga['lastChapter'].'" title="'.$manga['name'].' '.T('chapter').' '.$manga['lastChapter'].'">'.$manga['name'] . ' '. $manga['lastChapter'].'</a></td>
			                  </tr>';
		}
		$return .= '</table>';
		return $return;

	}	

	function manga_list2($a){
		$l = isset($a['quantity']) ? $a['quantity'] : '20';
		$s = isset($a['sorting']) ? $a['sorting'] : 'views';
		$where = array('LIMIT'=>$l);
		$o = isset($a['order']) ? $a['order'] : 'DESC'; 

		$mangas = WASD::$sql->select(C('app.db_prefix').'manga', array('cover', 'slug', 'name', 'lastChapter', 'lastUpdate', 'released', 'views'), array('LIMIT'=>$l, 'ORDER'=>$s.' '.$o));
		if(!empty($a['title'])) $return = '<h3>'.$a['title'].'</h3>';
		$return .= '';
		foreach( $mangas as &$manga ){
			$return .= '<div class="col-lg-12 manga_list2">						
							  <a data-toggle="mangapop" data-placement="left" manga-slug="'.$manga['slug'].'" data-original-title="'.$manga['name'].' ('.$manga['released'].')" class="cover pull-left" href="'.event('print_manga_url', $manga).'">
							    <img class="media-object img-thumb" src="'.URL($manga['cover']).'" alt="'.$manga['name'].'" width="56px">
							  </a>
							    <div>
								    <strong><a href="'.event('print_manga_url', $manga).'">'.$manga['name'].'</a></strong>							    
								    <small>'.event('do_genre', $manga['genre']).'</small><br />
								    '.sprintf(T('Total views: %1s'), $manga['views']).'<br />
								    '.T('Last chapter: ').' <a href="'.event('print_manga_url', $manga).'/'.$manga['lastChapter'].'">'.$manga['lastChapter'].'</a>
							    </div>					    
						</div>';
		}
		$return .= '</div>';
		return $return;

	}

	function fb_likebox($a) {
		$url = isset($a['url']) ? $a['url'] : 'https://www.facebook.com/huykhongcom';
		$height = isset($a['height']) ? str_replace('px', '', $a['height']) : '590';
		$color = isset($a['color']) ? $a['color'] : 'light';
		return '<div class="clearfix"><br /></div><div id="likebox-wrapper"><iframe src="//www.facebook.com/plugins/likebox.php?href='.urlencode($url).'&amp;width&amp;height='.$height.'&amp;colorscheme='.$color.'&amp;show_faces='.$a['show_faces'].'&amp;header='.$a['header'].'&amp;stream='.$a['stream'].'&amp;show_border='.$a['show_border'].'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:590px;" allowTransparency="true"></iframe></div>';
	}

	add_shortcode('comment-form', 'comment_form');
	add_shortcode('comment-list', 'comment_list');

	function comment_form($a){
		$slug = P('slug');
		if($slug == '') return false; // IF not manga or chapter page, die
		$message = TE('message');
		echo $message;
		if (!isLoggedIn()) {
			$return = '<div class="panel">
					      <div class="panel-body">
					        <h3>'.T('Comments').'</h3>
					          <div class="clearfix"><br></div>
					          <div class="alert alert-'.$message[0].'">
					           '.sprintf(T('<a href="%1s">Log in</a> to leave comment'), URL(T('login-slug', 'login'))).'
					          </div>					       
					      </div>
					    </div>';
		}else{
			$return = '<div class="panel">
					      <div class="panel-body">
					        <h3>'.T('Comments').'</h3>';
					        if(count($message)){
			$return .=		 '<div class="clearfix"><br></div>
					          <div class="alert alert-'.$message[0].'">
					           '.$message['1'].'
					          </div>';
					        } 
			$return .=		Form::open(array('action'=>currentUrl().'#commentForm', 'role'=>'form-group', 'id'=>'commentForm')).'
					          '.Form::hidden('token', session('token')).'
					          '.Form::hidden('action', 'comment').'
					          <div class="row">
					            <div class="col-md-2 col-xs-1">
					            <img src="'.URL(session_get('preferences', 'avatar')).'" class="img-thumbnail img-responsive">
					            </div>
					            <div class="col-md-10 col-xs-10">
						          <div class="form-group">
						            '.Form::textarea('content', R('content'), array('id'=>'commentTxt', 'placeholder'=>T('Say smth'), 'type'=>'text', 'class'=>'form-control comment-box')).'
						          	'.Form::button('submit', T('Submit'), array('class'=>'btn btn-xs btn-green')).'
						          </div>
						        </div>	
						      </div>				          
					        '.Form::close().'
					        
					        <hr>
					      </div>
					    </div>';
		}
		return $return;
	}

	// I clone this plugin because print paginator page conflict with chapter page
	function customPrintPaginator($p, $url, $params = NULL){
		$parts = explode("?", $url);
		$url = rtrim(rtrim($parts[0], '?'), '/');

		if($params == NULL) $params = $parts['1']; 
		if(!is_array($params)) parse_str($params, $params);
		
		$paginator .= "<li ".($p[c] == '1' ? 'class=\'disabled\'' : '')."><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'c-page')=>'1')))."'>&laquo; </a></li>";
		if(($cminus2 = $p['c']-2) > 0)
			$paginator .= "<li><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'c-page')=>$cminus2))).">$cminus2</a></li>";
		if(($cminus1 = $p['c']-1) > 0)
			$paginator .= "<li><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'c-page')=>$cminus1)))."'>$cminus1</a></li>";
		$paginator .= "<li class='active'><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'c-page')=>$$p['c'])))."'>$p[c]</a></li>";
		if(($cplus1 = $p['c']+1) <= $p['l'])
			$paginator .= "<li><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'c-page')=>$cplus1)))."'>$cplus1</a></li>";
		if(($cplus2 = $p['c']+2) < $p['l'])
			$paginator .= "<li><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'c-page')=>$cplus2)))."'>$cplus2</a></li>";
		$paginator .= "<li ".($p[c] == $p['l'] ? 'class=\'disabled\'' : '')."><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'c-page')=>$p['l'])))."'>&raquo;</a></li>";
		
		return $paginator;
	}		

	function comment_list($a){
		$where = array();
		$c['per-page'] = isset($a['perpage']) ? $a['perpage'] : '5';
		$c['thisPage'] = R(T('this-page-slug', 'c-page'), '0');
		$manga = Manga::findFirst(array('slug'=>P('slug')));
		$chapter = Chapter::findFirst(array('AND'=>array('manga'=>$manga['mangaId'], 'chapter'=>P('chapter'))));

		$wheres['AND'] = array('moderated'=>'1', 'manga'=>$manga['mangaId']);
		if($chapter['chapter'] != '') $wheres['AND']['chapter'] = $chapter['chapter'];
		

		// COUTING AND DO PAGINATING
		$total = WASD::$sql->count(C('app.db_prefix').'comment', $wheres);
		$p = paginator($total, $c['per-page'], $c['thisPage']);
		$wheres['LIMIT'] = array($p['s'], $c['per-page']);
		$wheres['ORDER'] = R('order') != '' ? R('order').' desc' : 'thetime DESC';

		// NOW FETCH

		$comments = Comment::find($wheres);
		

		$p = $p;	
		$c = $c;
		$url = URL('admin/management/comment');

		$return .= '';
		if (count($comments) == 0){
            $return .= T('Be the first one who comment in this confession');
		}else{
            foreach ($comments as &$comment){
            	$author = Mangauser::findFirst(array('userId'=>$comment['author']));
                $return .= '<p>'.$comment['content'].'</p>
             			   <span>'.sprintf(T('By %1s %2s'), '<strong><img src="'.URL($author['preferences']['avatar']).'" style="width:20px">'.$author['username'].'</strong>', ago($comment['thetime'])).'</span>			                
			                <hr>';
            }
        }
		$return .= '<ul class="pagination blue" style="margin:0">
				'.customPrintPaginator($p, currentUrl()).'
			</ul>';
		return $return;
	}

?>