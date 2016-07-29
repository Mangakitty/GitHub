<?php 

	if (!defined("_WASD_")) exit; 

	$base64 = $_POST['base64'];
	$dir = '/'.trim($_POST['dir'], '/').'/';
	$img = new Vendor\SimpleImage();
	directory_is_writable(ROOT_DIR.$dir);
	$return = $dir.uniqid().'.png';
	$img->load_base64($base64)->save(ROOT_DIR.$return);

	exit(json_encode(array('s'=>'ok', 'm'=>$return)))



?>