<?php
	if (!defined("_WASD_")) exit;
	
	event('sendEmail', NULL, function($data){
		$mail = new \Vendor\PHPMailer(true);
		$mail->CharSet = 'UTF-8';
		$mail->IsHTML(true);
		$mail->AddAddress($data['to']);
		$mail->SetFrom(C("email.from"), sanitizeForHTTP(C("app.title")));
		$mail->Subject = sanitizeForHTTP($data['subject']);
		$mail->Body = $data['body'];
		return $mail->Send();
	});

	///////////////////// DATE TIME ///////////////////////

	event('date', NULL, function($time){
		return date(C('app.dateFormat'), $time);
	});
	event('time', NULL, function($time){
		return date(C('app.timeFormat'), $time);
	});
	event('datetime', NULL, function($time){
		return event('date', $time).' '.event('time', $time);
	});


	///////////////////// JS, CSS, HEADER ///////////////////////

	event('customJs', NULL, function($js){
		return '<script>'. $js .'</script>';
	});
	event('customCss', NULL, function($css){
		return '<style>'. $css .'</style>';
	});
	event('js', NULL, function(array $js){
		$head = '';

		if (!empty($js["remote"])) {
			foreach ($js["remote"] as $url) {
				$head .= "<script src='$url'></script>\n";
			}
		}
		unset($js["remote"]);

		foreach ($js['local'] as &$each) {	
			$head .= '<script src="' . URL($each) .'"></script>';
		}

		return $head;
	});

	event('css', NULL, function(array $css){
		$head = '';

		if (!empty($css["remote"])) {
			foreach ($css["remote"] as $url) {
				$head .= '<link rel="stylesheet" type="text/css" media="screen" href="' .$url. '">';
			}
		}
		unset($css["remote"]);

		foreach ($css['local'] as &$each) {	
			$head .= '<link rel="stylesheet" type="text/css" media="screen" href="' . URL($each)  . '">';
		}
		

		return $head;
	});

	event('render_404', NULL, function() { 
		echo '
			<html>
			<head>
				<title>'.T('404_title', '404 PAGE NOT FOUND').'</title>
				<meta charset="utf-8"/>
				<link rel="stylesheet" type="text/css" media="screen" href="//netdna.bootstrapcdn.com/bootswatch/3.0.3/yeti/bootstrap.min.css">
				<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
			</head>
			<body>
			<div class="container">
				<div class="page-header">
					<div class="row">
						<div class="col-lg-12">
							<h1>' . T('404', '404') . '</h1>
							<p class="lead">' . T('page_doesnt_exist', 'The page you are looking for doesn\'t exist') . '
							<br/>
							<a href="' . url('') .'">'. T('back-to-home', 'Back to home') .'</a></p>
						</div>
					</div>
				</div>
			</div>
			</body>
			</html>';
	});

	event('render_tokenMismatch', NULL, function() { 
		echo '
			<html>
			<head>
				<title>'.T('Token Mismatch').'</title>
				<meta charset="utf-8"/>
				<link rel="stylesheet" type="text/css" media="screen" href="//netdna.bootstrapcdn.com/bootswatch/3.0.3/yeti/bootstrap.min.css">
				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
				<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
			</head>
			<body>
			<div class="container">
				<div class="page-header">
					<div class="row">
						<div class="col-lg-12">
							<h1>' . T('Token Mismatch') . '</h1>
							<p class="lead">' . T('Please back to the previous page, refresh and try again') . '
							<br/>
							<a href="#" onclick="history.go(-1); return false;">'. T('Back') .'</a></p>
						</div>
					</div>
				</div>
			</div>
			</body>
			</html>';
			exit;
	});
