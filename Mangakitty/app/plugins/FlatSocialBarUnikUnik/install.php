<?php 

	if (!defined("_WASD_")) exit;

	WASD::$sql->query("CREATE TABLE IF NOT EXISTS ".C('app.db_prefix')."unikunik_flatsocialbar (
						  `Id` int(11) NOT NULL AUTO_INCREMENT,
						  `social` varchar(20) NOT NULL,
						  `link` varchar(255) NOT NULL,
						  PRIMARY KEY (`Id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
						
					$fsbdbcon = C('app.db_prefix').'unikunik_flatsocialbar';
					$array = array( 'social'=>'facebook', 'link'=>'http://facebook.com/unikunik.pw' );
					WASD::$sql->insert($fsbdbcon, $array);
					$array = array( 'social'=>'youtube', 'link'=>'http://youtube.com/unikunik.pw' );
					WASD::$sql->insert($fsbdbcon, $array);
					$array = array( 'social'=>'googleplus', 'link'=>'http://plus.google.com/unikunik.pw' );
					WASD::$sql->insert($fsbdbcon, $array);
					$array = array( 'social'=>'twitter', 'link'=>'http://twitter.com/unikunik.pw' );
					WASD::$sql->insert($fsbdbcon, $array);
					$array = array( 'social'=>'devianart', 'link'=>'http://devianart.com/unikunik.pw' );
					WASD::$sql->insert($fsbdbcon, $array);
	
	include "/app/plugins/FlatSocialBarUnikUnik/controllers/install.php";				
 ?>