  <?php 
	$abpfrienddbcon = C('app.db_prefix').'unikunik_abpfriend';
	$messageVar = array('variable'=>'message');
	$messageDB = WASD::$sql->select($abpfrienddbcon, array("function"), $messageVar);
	$message = $messageDB['0']['function'];
	
	$colorVar = array('variable'=>'color');
	$colorDB = WASD::$sql->select($abpfrienddbcon, array("function"), $colorVar);
	$color = $colorDB['0']['function'];
	
	$enableVar = array('variable'=>'enable');
	$enableDB = WASD::$sql->select($abpfrienddbcon, array("function"), $enableVar);
	$enable = $enableDB['0']['function'];
	
  ?>
