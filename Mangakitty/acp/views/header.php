<?php 

    if(!is_array($cssFiles['local'])) $cssFiles['local'] = array();
    array_unshift($cssFiles['local'], 'acp/assets/css/bootstrap.min.css');
	$cssFiles['local'][] = 'acp/assets/css/animation.css';
	$cssFiles['local'][] = 'acp/assets/css/extended.min.css';
	$cssFiles['local'][] = 'acp/assets/css/custom.css';
	$cssFiles['local'][] = 'acp/assets/css/fontello.css';
	$cssFiles['local'][] = 'acp/assets/css/acp.css';
	$cssFiles['remote'][] = 'http://fonts.googleapis.com/css?family=Noto+Sans:400,700';
	//$cssFiles['remote'][] = '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css';

?>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $title; ?></title>
	<?php 
		echo event('css', $cssFiles);
		echo event('customCss', $customCss); 
	 ?>	
	 
	 
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdn.rawgit.com/blueimp/jQuery-File-Upload/master/js/vendor/jquery.ui.widget.js"></script>
<script src="https://cdn.rawgit.com/blueimp/jQuery-File-Upload/master/js/jquery.iframe-transport.js"></script>
<script src="../../../../app/plugins/jqupload/js/jquery.fileupload.js"></script>
	
</head>
