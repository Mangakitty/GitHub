<?php


if (!defined("_WASD_")) {
		echo '<br />HOME PAGE: http://codecanyon.net/user/Aincrad?ref=Aincrad' . '<br />PORTOFOLIO: http://codecanyon.net/user/Aincrad/portfolio?ref=Aincrad' . '<br />email: yearimdangtk@gmail.com' . '<br /><br />';
			include "index.html";
		exit; 	
	}



	$router->map('GET|POST','/admin/management/jqupload', array('c'=>'/admin/init|/plugin/jqupload/server/php/index'), 'jqupload');
