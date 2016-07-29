<?php 

	if (!defined("_WASD_")) exit;

	WASD::$sql->query("CREATE TABLE IF NOT EXISTS ".C('app.db_prefix')."unikunik_abpfriend (
						  `Id` int(11) NOT NULL AUTO_INCREMENT,
						  `variable` varchar(20) NOT NULL,
						  `function` varchar(255) NOT NULL,
						  PRIMARY KEY (`Id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
						
					$abpfrienddbcon = C('app.db_prefix').'unikunik_abpfriend';
					$array = array( 'variable'=>'message', 'function'=>'It seems that you have activated <b>Adblock Plus</b>, it may cause some functions do not work properly. Please turn off <b>Adblock Plus</b> <a href=\'\' target=\'_blank\'>Refresh</a>' );
					WASD::$sql->insert($abpfrienddbcon, $array);
					$array = array( 'variable'=>'color', 'function'=>'orange' );
					WASD::$sql->insert($abpfrienddbcon, $array);
					$array = array( 'variable'=>'enable', 'function'=>'1' );
					WASD::$sql->insert($abpfrienddbcon, $array);
	
	include "/app/plugins/NPabpfriendUnikUnik/controllers/install.php";

 ?>