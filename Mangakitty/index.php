<?php
	
	define("_WASD_", 1);

	include 'lib/bootstrap.php';

	if(file_exists('update.php')){
		include 'update.php';
		@unlink('update.php');
	}

	if(!file_exists('.htaccess')) copy('lib/htaccess.txt', '.htaccess');

	if(!file_exists('install.php')){
		include 'controllers/main.robot.php';
	}else{ 
		include 'install.php';
	}