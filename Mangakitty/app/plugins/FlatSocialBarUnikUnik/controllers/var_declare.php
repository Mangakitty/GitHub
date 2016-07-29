  <?php 
	$fsbdbcon = C('app.db_prefix').'unikunik_flatsocialbar';
	$fbId = array('Id'=>'1');
	$ytId = array('Id'=>'2');
	$gpId = array('Id'=>'3');
	$twId = array('Id'=>'4');
	$daId = array('Id'=>'5');
	$fbDB = WASD::$sql->select($fsbdbcon, array("link"), $fbId);
	$ytDB = WASD::$sql->select($fsbdbcon, array("link"), $ytId);
	$gpDB = WASD::$sql->select($fsbdbcon, array("link"), $gpId);
	$twDB = WASD::$sql->select($fsbdbcon, array("link"), $twId);
	$daDB = WASD::$sql->select($fsbdbcon, array("link"), $daId);
	$fb   = $fbDB['0']['link'];
	$yt   = $ytDB['0']['link'];
	$gp   = $gpDB['0']['link'];
	$tw   = $twDB['0']['link'];
	$da   = $daDB['0']['link'];	
  ?>
