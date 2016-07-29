<?php 

	include 'shortcodes.php';

	function bartag_func($atts) {
	 	return "foo = {$atts['foo']}";
	}

	add_shortcode('bartag', 'bartag_func');


	$string = 'Tôi là [bartag foo=\'bar\'] ';

	echo do_shortcode($string);