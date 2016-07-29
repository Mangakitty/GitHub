<?php	


if (!defined("_WASD_")) {
		echo '<br />';
		echo 'HOME PAGE: http://codecanyon.net/user/Aincrad?ref=Aincrad' . '<br />';
		echo 'PORTOFOLIO: http://codecanyon.net/user/Aincrad/portfolio?ref=Aincrad' . '<br />';
		echo 'email: yearimdangtk@gmail.com' . '<br /><br />';
			include "../../index.html";
		exit; 	
	}


error_reporting(E_ALL | E_STRICT);


$manga_dir = $_REQUEST['mangadir'];
$phpmanga_dir = $_REQUEST['phpmanga'];
$manga_chapter_dir = $phpmanga_dir . '/upload/manga' . $manga_dir . '/';

$options = array(
	'upload_dir' => $manga_chapter_dir,
	'upload_url' => '/upload/manga' . $manga_dir . '/',
	'user_dirs' => true,
);

require('UploadHandler.php');

$upload_handler = new UploadHandler($options);



