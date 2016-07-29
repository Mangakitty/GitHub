<?php 

	add_shortcode('fsb_home_unikunik', 'fsb_home_unikunik');
	
	function fsb_home_unikunik($a) {
		include "/app/plugins/FlatSocialBarUnikUnik/views/index.php";
	}

?>