<?php

	function R($key, $default = ""){
		if (!empty($_POST[$key])) return $_POST[$key];
		elseif (isset($_GET[$key])) return $_GET[$key];
		else return $default;
	}

	function P($key, $defaul = ""){
		return WASD::pparams($key, $default);
	}

	function C($key, $default = null){
		return WASD::config($key, $default);
	}

	function SQL(){
		
	}

	function T($key, $default = null){
		return WASD::translate($key, $default);
	}
	
	function T2up($key, $default = null){
		return strtoupper(WASD::translate($key, $default));
	}

	function Ts($string, $pluralString, $amount){
		$number = (float)str_replace(",", "", $amount);
		return sprintf(T($number == 1 ? $string : $pluralString), $amount);
	}

	function url($link = ''){
		if (strpos($link, "http://") === 0) return $link;
		
		return rtrim(WASD::$webURL, "/"). "/". ltrim($link, '/');
	}

	function cookie($name, $value = NULL, $time = NULL){
		global $_COOKIE;
		if($time == NULL){ $time = time() + (10 * 365 * 24 * 60 * 60); }else{ $time = time() + $time; }
		if($value == NULL) return isset($_COOKIE[C('app.cookiePrefix').$name]) ? json_decode(decrypted($_COOKIE[C('app.cookiePrefix').$name], C('app.randomInit')), true) : false;
		setcookie(C('app.cookiePrefix').$name, encrypted(json_encode($value), C('app.randomInit')),  $time, '/', NULL, 0 ); 
	}

	function session($name, $value = NULL){
		if($value == NULL) return $_SESSION[C('app.randomInit', 'huykhong')][$name];
		$_SESSION[C('app.randomInit', 'huykhong')][$name] = $value;
		
	}

	function session_get($array_name, $element){
		return $_SESSION[C('app.randomInit', 'huykhong')][$array_name][$element];
	}

	function encrypted($string, $key){
		return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
	}

	function decrypted($encrypted, $key){
		return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($encrypted), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	}

	function pw($password){
		return hash('sha256', $password);
	}

	function dump(){
		$string = '';
		foreach(func_get_args() as $value){
			$string .= '<pre>' . h($value === NULL ? 'NULL' : (is_scalar($value) ? $value : print_r($value, TRUE))) . "</pre>\n";
		}
	echo $string;
	}

	function h($string){
		return htmlspecialchars($string, ENT_QUOTES, 'utf-8');
	}

	function sanitizeFileName($value){
		return preg_replace("/(?:[\/:\\\]|\.{2,}|\\x00)/", "", $value);
	}
	function sanitizeHTML($value){
		return htmlentities($value, ENT_QUOTES, "UTF-8");
	}
	function sanitizeForHTTP($value){
		return str_replace(array("\r", "\n", "%0a", "%0d", "%0A", "%0D"), "", $value);
	}

	function sendEmail($to, $subject, $body){
		$phpmailer = LIB_PATH.'/Vendor/PHPMailer.php';
		require_once($phpmailer);
		$mail = new \Vendor\PHPMailer(true);
		$mail->CharSet = 'UTF-8';
		$mail->IsHTML(true);
		$mail->AddAddress($to);
		$mail->SetFrom(C("app.emailFrom"), sanitizeForHTTP(C("app.title")));
		$mail->Subject = sanitizeForHTTP($subject);
		$mail->Body = $body;

		return $mail->Send();
	}

	function sanitize_title( $title, $fallback_title = '', $context = 'save' ) {
	        $raw_title = $title;
	
	        if ( 'save' == $context )
	                $title = remove_accents($title);
	
	        if ( '' === $title || false === $title )
	                $title = $fallback_title;
	
	        return $title;
	}

	function remove_accents($string) {
	        if ( !preg_match('/[\x80-\xff]/', $string) )
	                return $string;
	        if (seems_utf8($string)) {
	                $chars = array(
	                // Decompositions for Latin-1 Supplement
	                chr(194).chr(170) => 'a', chr(194).chr(186) => 'o',
	                chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
	                chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
	                chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
	                chr(195).chr(134) => 'AE',chr(195).chr(135) => 'C',
	                chr(195).chr(136) => 'E', chr(195).chr(137) => 'E',
	                chr(195).chr(138) => 'E', chr(195).chr(139) => 'E',
	                chr(195).chr(140) => 'I', chr(195).chr(141) => 'I',
	                chr(195).chr(142) => 'I', chr(195).chr(143) => 'I',
	                chr(195).chr(144) => 'D', chr(195).chr(145) => 'N',
	                chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
	                chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
	                chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
	                chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
	                chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
	                chr(195).chr(158) => 'TH',chr(195).chr(159) => 's',
	                chr(195).chr(160) => 'a', chr(195).chr(161) => 'a',
	                chr(195).chr(162) => 'a', chr(195).chr(163) => 'a',
	                chr(195).chr(164) => 'a', chr(195).chr(165) => 'a',
	                chr(195).chr(166) => 'ae',chr(195).chr(167) => 'c',
	                chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
	                chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
	                chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
	                chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
	                chr(195).chr(176) => 'd', chr(195).chr(177) => 'n',
	                chr(195).chr(178) => 'o', chr(195).chr(179) => 'o',
	                chr(195).chr(180) => 'o', chr(195).chr(181) => 'o',
	                chr(195).chr(182) => 'o', chr(195).chr(184) => 'o',
	                chr(195).chr(185) => 'u', chr(195).chr(186) => 'u',
	                chr(195).chr(187) => 'u', chr(195).chr(188) => 'u',
	                chr(195).chr(189) => 'y', chr(195).chr(190) => 'th',
	                chr(195).chr(191) => 'y', chr(195).chr(152) => 'O',
	                // Decompositions for Latin Extended-A
	                chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
	                chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
	                chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
	                chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
	                chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
	                chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
	                chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
	                chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
	                chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
	                chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
	                chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
	                chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
	                chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
	                chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
	                chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
	                chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
	                chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
	                chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
	                chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
	                chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
	                chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
	                chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
	                chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
	                chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
	                chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
	                chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
	                chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
	                chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
	                chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
	                chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
	                chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
	                chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
	                chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
	                chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
	                chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
	                chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
	                chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
	                chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
	                chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
	                chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
	                chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
	                chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
	                chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
	                chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
	                chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
	                chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
	                chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
	                chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
	                chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
	                chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
	                chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
	                chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
	                chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
	                chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
	                chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
	                chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
	                chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
	                chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
	                chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
	                chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
	                chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
	                chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
	                chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
	                chr(197).chr(190) => 'z', chr(197).chr(191) => 's',
	                // Decompositions for Latin Extended-B
	                chr(200).chr(152) => 'S', chr(200).chr(153) => 's',
	                chr(200).chr(154) => 'T', chr(200).chr(155) => 't',
	                // Euro Sign
	                chr(226).chr(130).chr(172) => 'E',
	                // GBP (Pound) Sign
	                chr(194).chr(163) => '',
	                // Vowels with diacritic (Vietnamese)
	                // unmarked
	                chr(198).chr(160) => 'O', chr(198).chr(161) => 'o',
	                chr(198).chr(175) => 'U', chr(198).chr(176) => 'u',
	                // grave accent
	                chr(225).chr(186).chr(166) => 'A', chr(225).chr(186).chr(167) => 'a',
	                chr(225).chr(186).chr(176) => 'A', chr(225).chr(186).chr(177) => 'a',
	                chr(225).chr(187).chr(128) => 'E', chr(225).chr(187).chr(129) => 'e',
	                chr(225).chr(187).chr(146) => 'O', chr(225).chr(187).chr(147) => 'o',
	                chr(225).chr(187).chr(156) => 'O', chr(225).chr(187).chr(157) => 'o',
	                chr(225).chr(187).chr(170) => 'U', chr(225).chr(187).chr(171) => 'u',
	                chr(225).chr(187).chr(178) => 'Y', chr(225).chr(187).chr(179) => 'y',
	                // hook
	                chr(225).chr(186).chr(162) => 'A', chr(225).chr(186).chr(163) => 'a',
	                chr(225).chr(186).chr(168) => 'A', chr(225).chr(186).chr(169) => 'a',
	                chr(225).chr(186).chr(178) => 'A', chr(225).chr(186).chr(179) => 'a',
	                chr(225).chr(186).chr(186) => 'E', chr(225).chr(186).chr(187) => 'e',
	                chr(225).chr(187).chr(130) => 'E', chr(225).chr(187).chr(131) => 'e',
	                chr(225).chr(187).chr(136) => 'I', chr(225).chr(187).chr(137) => 'i',
	                chr(225).chr(187).chr(142) => 'O', chr(225).chr(187).chr(143) => 'o',
	                chr(225).chr(187).chr(148) => 'O', chr(225).chr(187).chr(149) => 'o',
	                chr(225).chr(187).chr(158) => 'O', chr(225).chr(187).chr(159) => 'o',
	                chr(225).chr(187).chr(166) => 'U', chr(225).chr(187).chr(167) => 'u',
	                chr(225).chr(187).chr(172) => 'U', chr(225).chr(187).chr(173) => 'u',
	                chr(225).chr(187).chr(182) => 'Y', chr(225).chr(187).chr(183) => 'y',
	                // tilde
	                chr(225).chr(186).chr(170) => 'A', chr(225).chr(186).chr(171) => 'a',
	                chr(225).chr(186).chr(180) => 'A', chr(225).chr(186).chr(181) => 'a',
	                chr(225).chr(186).chr(188) => 'E', chr(225).chr(186).chr(189) => 'e',
	                chr(225).chr(187).chr(132) => 'E', chr(225).chr(187).chr(133) => 'e',
	                chr(225).chr(187).chr(150) => 'O', chr(225).chr(187).chr(151) => 'o',
	                chr(225).chr(187).chr(160) => 'O', chr(225).chr(187).chr(161) => 'o',
	                chr(225).chr(187).chr(174) => 'U', chr(225).chr(187).chr(175) => 'u',
	                chr(225).chr(187).chr(184) => 'Y', chr(225).chr(187).chr(185) => 'y',
	                // acute accent
	                chr(225).chr(186).chr(164) => 'A', chr(225).chr(186).chr(165) => 'a',
	                chr(225).chr(186).chr(174) => 'A', chr(225).chr(186).chr(175) => 'a',
	                chr(225).chr(186).chr(190) => 'E', chr(225).chr(186).chr(191) => 'e',
	                chr(225).chr(187).chr(144) => 'O', chr(225).chr(187).chr(145) => 'o',
	                chr(225).chr(187).chr(154) => 'O', chr(225).chr(187).chr(155) => 'o',
	                chr(225).chr(187).chr(168) => 'U', chr(225).chr(187).chr(169) => 'u',
	                // dot below
	                chr(225).chr(186).chr(160) => 'A', chr(225).chr(186).chr(161) => 'a',
	                chr(225).chr(186).chr(172) => 'A', chr(225).chr(186).chr(173) => 'a',
	                chr(225).chr(186).chr(182) => 'A', chr(225).chr(186).chr(183) => 'a',
	                chr(225).chr(186).chr(184) => 'E', chr(225).chr(186).chr(185) => 'e',
	                chr(225).chr(187).chr(134) => 'E', chr(225).chr(187).chr(135) => 'e',
	                chr(225).chr(187).chr(138) => 'I', chr(225).chr(187).chr(139) => 'i',
	                chr(225).chr(187).chr(140) => 'O', chr(225).chr(187).chr(141) => 'o',
	                chr(225).chr(187).chr(152) => 'O', chr(225).chr(187).chr(153) => 'o',
	                chr(225).chr(187).chr(162) => 'O', chr(225).chr(187).chr(163) => 'o',
	                chr(225).chr(187).chr(164) => 'U', chr(225).chr(187).chr(165) => 'u',
	                chr(225).chr(187).chr(176) => 'U', chr(225).chr(187).chr(177) => 'u',
	                chr(225).chr(187).chr(180) => 'Y', chr(225).chr(187).chr(181) => 'y',
	                // Vowels with diacritic (Chinese, Hanyu Pinyin)
	                chr(201).chr(145) => 'a',
	                // macron
	                chr(199).chr(149) => 'U', chr(199).chr(150) => 'u',
	                // acute accent
	                chr(199).chr(151) => 'U', chr(199).chr(152) => 'u',
	                // caron
	                chr(199).chr(141) => 'A', chr(199).chr(142) => 'a',
	                chr(199).chr(143) => 'I', chr(199).chr(144) => 'i',
	                chr(199).chr(145) => 'O', chr(199).chr(146) => 'o',
	                chr(199).chr(147) => 'U', chr(199).chr(148) => 'u',
	                chr(199).chr(153) => 'U', chr(199).chr(154) => 'u',
	                // grave accent
	                chr(199).chr(155) => 'U', chr(199).chr(156) => 'u',
	                );
	                // Used for locale-specific rules
	                $locale = C('app.locale', 'en_US');
	                if ( 'de_DE' == $locale ) {
	                        $chars[ chr(195).chr(132) ] = 'Ae';
	                        $chars[ chr(195).chr(164) ] = 'ae';
	                        $chars[ chr(195).chr(150) ] = 'Oe';
	                        $chars[ chr(195).chr(182) ] = 'oe';
	                        $chars[ chr(195).chr(156) ] = 'Ue';
	                        $chars[ chr(195).chr(188) ] = 'ue';
	                        $chars[ chr(195).chr(159) ] = 'ss';
	                } elseif ( 'da_DK' === $locale ) {
	                        $chars[ chr(195).chr(134) ] = 'Ae';
	                        $chars[ chr(195).chr(166) ] = 'ae';
	                        $chars[ chr(195).chr(152) ] = 'Oe';
	                        $chars[ chr(195).chr(184) ] = 'oe';
	                        $chars[ chr(195).chr(133) ] = 'Aa';
	                        $chars[ chr(195).chr(165) ] = 'aa';
	                }
	                $string = strtr($string, $chars);
	        } else {
	                // Assume ISO-8859-1 if not UTF-8
	                $chars['in'] = chr(128).chr(131).chr(138).chr(142).chr(154).chr(158)
	                        .chr(159).chr(162).chr(165).chr(181).chr(192).chr(193).chr(194)
	                        .chr(195).chr(196).chr(197).chr(199).chr(200).chr(201).chr(202)
	                        .chr(203).chr(204).chr(205).chr(206).chr(207).chr(209).chr(210)
	                        .chr(211).chr(212).chr(213).chr(214).chr(216).chr(217).chr(218)
	                        .chr(219).chr(220).chr(221).chr(224).chr(225).chr(226).chr(227)
	                        .chr(228).chr(229).chr(231).chr(232).chr(233).chr(234).chr(235)
	                        .chr(236).chr(237).chr(238).chr(239).chr(241).chr(242).chr(243)
	                        .chr(244).chr(245).chr(246).chr(248).chr(249).chr(250).chr(251)
	                        .chr(252).chr(253).chr(255);
	                $chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";
	                $string = strtr($string, $chars['in'], $chars['out']);
	                $double_chars['in'] = array(chr(140), chr(156), chr(198), chr(208), chr(222), chr(223), chr(230), chr(240), chr(254));
	                $double_chars['out'] = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
	                $string = str_replace($double_chars['in'], $double_chars['out'], $string);
	        }
	        return $string;
	}

	function slug( $title, $raw_title = '', $context = 'display' ) {
	        $title = strip_tags($title);
	        // Preserve escaped octets.
	        $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
	        // Remove percent signs that are not part of an octet.
	        $title = str_replace('%', '', $title);
	        // Restore octets.
	        $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
	        if (seems_utf8($title)) {
	                if (function_exists('mb_strtolower')) {
	                        $title = mb_strtolower($title, 'UTF-8');
	                }
	                $title = utf8_uri_encode($title, 200);
	        }
	        $title = strtolower($title);
	        $title = preg_replace('/&.+?;/', '', $title); // kill entities
	        $title = str_replace('.', '-', $title);
	        if ( 'save' == $context ) {
	                // Convert nbsp, ndash and mdash to hyphens
	                $title = str_replace( array( '%c2%a0', '%e2%80%93', '%e2%80%94' ), '-', $title );
	                // Strip these characters entirely
	                $title = str_replace( array(
	                        // iexcl and iquest
	                        '%c2%a1', '%c2%bf',
	                        // angle quotes
	                        '%c2%ab', '%c2%bb', '%e2%80%b9', '%e2%80%ba',
	                        // curly quotes
	                        '%e2%80%98', '%e2%80%99', '%e2%80%9c', '%e2%80%9d',
	                        '%e2%80%9a', '%e2%80%9b', '%e2%80%9e', '%e2%80%9f',
	                        // copy, reg, deg, hellip and trade
	                        '%c2%a9', '%c2%ae', '%c2%b0', '%e2%80%a6', '%e2%84%a2',
	                        // acute accents
	                        '%c2%b4', '%cb%8a', '%cc%81', '%cd%81',
	                        // grave accent, macron, caron
	                        '%cc%80', '%cc%84', '%cc%8c',
	                ), '', $title );
	                // Convert times to x
	                $title = str_replace( '%c3%97', 'x', $title );
	        }
	        $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
	        $title = preg_replace('/\s+/', '-', $title);
	        $title = preg_replace('|-+|', '-', $title);
	        $title = trim($title, '-');
	        return $title;
	}

	function seems_utf8($str) {
        mbstring_binary_safe_encoding();
        $length = strlen($str);
        reset_mbstring_encoding();
        for ($i=0; $i < $length; $i++) {
                $c = ord($str[$i]);
                if ($c < 0x80) $n = 0; # 0bbbbbbb
                elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
                elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
                elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
                elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
                elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
                else return false; # Does not match any model
                for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
                        if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                                return false;
                }
        }
        return true;
	}

	function mbstring_binary_safe_encoding( $reset = false ) {
		static $encodings = array();
		static $overloaded = null;

		if ( is_null( $overloaded ) )
			$overloaded = function_exists( 'mb_internal_encoding' ) && ( ini_get( 'mbstring.func_overload' ) & 2 );

		if ( false === $overloaded )
			return;

		if ( ! $reset ) {
			$encoding = mb_internal_encoding();
			array_push( $encodings, $encoding );
			mb_internal_encoding( 'ISO-8859-1' );
		}

		if ( $reset && $encodings ) {
			$encoding = array_pop( $encodings );
			mb_internal_encoding( $encoding );
		}
	}

	function reset_mbstring_encoding() {
		mbstring_binary_safe_encoding( true );
	}

	function utf8_uri_encode( $utf8_string, $length = 0 ) {
	        $unicode = '';
	        $values = array();
	        $num_octets = 1;
	        $unicode_length = 0;
	        mbstring_binary_safe_encoding();
	        $string_length = strlen( $utf8_string );
	        reset_mbstring_encoding();
	        for ($i = 0; $i < $string_length; $i++ ) {
	                $value = ord( $utf8_string[ $i ] );
	                if ( $value < 128 ) {
	                        if ( $length && ( $unicode_length >= $length ) )
	                                break;
	                        $unicode .= chr($value);
	                        $unicode_length++;
	                } else {
	                        if ( count( $values ) == 0 ) $num_octets = ( $value < 224 ) ? 2 : 3;
	                        $values[] = $value;
	                        if ( $length && ( $unicode_length + ($num_octets * 3) ) > $length )
	                                break;
	                        if ( count( $values ) == $num_octets ) {
	                                if ($num_octets == 3) {
	                                        $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
	                                        $unicode_length += 9;
	                                } else {
	                                        $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
	                                        $unicode_length += 6;
	                                }
	                                $values = array();
	                                $num_octets = 1;
	                        }
	                }
	        }
	        return $unicode;
	}

	function undoRegisterGlobals(){
		if (ini_get("register_globals")) {
			$array = array("_REQUEST", "_SESSION", "_SERVER", "_ENV", "_FILES");
			foreach ($array as $value) {
				foreach ((array)$GLOBALS[$value] as $key => $var) {
					if (isset($GLOBALS[$key]) and $var === $GLOBALS[$key]) unset($GLOBALS[$key]);
				}
			}
		}
	}

	function recursive_array_search($needle,$haystack) {
	    foreach($haystack as $key=>$value) {
	        $current_key=$key;
	        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
	            return $current_key;
	        }
	    }
	    return false;
	}

	function redirect($destination, $code = 302){
		if(empty($destination)) $destination = URL();
		@ob_end_clean();
		header("Location: ".sanitizeForHTTP($destination), true, $code);
		exit;
	}

	function relativeTime($then, $precise = false){
		if(!isValidTimeStamp($then)) $then = strtotime($then);
		if (!$then) return T("never");
		$ago = time() - $then;
		if ($ago < 1) return T("just now");
		if ($ago >= ($period = 60 * 60 * 24 * 365.25)) {
			$years = floor($ago / $period);
			return Ts("%d year ago", "%d years ago", $years);
		}elseif ($ago >= ($period = 60 * 60 * 24 * (365.25 / 12)) * 2) {
			$months = floor($ago / $period);
			return Ts("%d month ago", "%d months ago", $months);
		}elseif ($ago >= ($period = 60 * 60 * 24 * 7)) {
			$weeks = floor($ago / $period);
			return Ts("%d week ago", "%d weeks ago", $weeks);
		}elseif ($ago >= ($period = 60 * 60 * 24)) {
			$days = floor($ago / $period);
			return Ts("%d day ago", "%d days ago", $days);
		}elseif ($ago >= ($period = 60 * 60)) {
			$hours = floor($ago / $period);
			return Ts("%d hour ago", "%d hours ago", $hours);
		}

		if ($precise) {
			if ($ago >= ($period = 60)) {
				$minutes = floor($ago / $period);
				return Ts("%d minute ago", "%d minutes ago", $minutes);
			}elseif ($ago >= 1) return Ts("%d second ago", "%d seconds ago", $ago);

		}

		return T("just now");
	}

	function sql_date($timestamp = NULL){
		return date('Y-m-d H:i:s', $timestamp ?: time());
	}	

	function paginator($totalElement, $perPage, $currentPage = NULL){
		$return = array();
		if (!is_numeric($currentPage) || $currentPage < 1){ $currentPage = 1; }	
		$return['l'] = ceil($totalElement/$perPage);				
		$return['p'] = $currentPage == 1 ? '1' : $currentPage - 1;							
		$return['n'] = $currentPage >= $return['l'] - 1 ? $return['l'] : $currentPage + 1;	
		$return['s'] = (is_numeric($currentPage) ? ($currentPage - 1) * $perPage : 0);
		$return['c'] = $currentPage;
		$return['pp'] = $perPage;
		return $return;
		// LAST PAGE: l
		// Previous Page and Next Page: p & n
		// Start Page (for condition): s
		// Current Page: c
	}

	function curl_request($url, array $options = NULL){
		$ch = curl_init($url);

		$defaults = array(
			CURLOPT_HEADER => 0,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_TIMEOUT => 5,
		);

		// Connection options override defaults if given
		curl_setopt_array($ch, (array) $options + $defaults);

		// Create a response object
		$object = new stdClass;

		// Get additional request info
		$object->response = curl_exec($ch);
		$object->error_code = curl_errno($ch);
		$object->error = curl_error($ch);
		$object->info = curl_getinfo($ch);

		curl_close($ch);

		return $object;
	}
	
	function directory_is_writable($dir, $chmod = 0755){
		// If it doesn't exist, and can't be made
		if(! is_dir($dir) AND ! mkdir($dir, $chmod, TRUE)) return FALSE;

		// If it isn't writable, and can't be made writable
		if(! is_writable($dir) AND !chmod($dir, $chmod)) return FALSE;

		return TRUE;
	}

	function event($event, $value = NULL, $callback = NULL){
	    static $events;
	    // Adding or removing a callback?
	    if($callback !== NULL){
	        if($callback){
	            $events[$event][] = $callback;
	        }else{
	            unset($events[$event]);
	        }
	    }elseif(isset($events[$event])){ // Fire a callback
	        foreach($events[$event] as $function){
	        	$value = call_user_func($function, $value);
	        }
	        return $value;
	    }
	}

	function strposa($haystack, $needle, $offset=0) {
	    if(!is_array($needle)) $needle = array($needle);
	    foreach($needle as $query) {
	        if(strpos($haystack, $query, $offset) !== false) return true; // stop on first true result
	    }
	    return false;
	}
	function in_array_r($item , $array){
	    return preg_match('/"'.$item.'"/i' , json_encode($array));
	}
	function error($info){
		error_log('['.C('app.appName').'] '.$info);
	}
	function versionChecker(){
	    $remoteVersion = trim(file_get_contents(C('app.remoteVersion')));
	    return version_compare(C('app.version'), $remoteVersion, '<');
	}
	function ip(){
		if($_SERVER['REMOTE_ADDR'] == '::1') return '127.0.0.1';
		return $_SERVER['REMOTE_ADDR'];
	}
	function adminLog($log){
		$thisAdmin = session('thisUser');
		$query = WASD::$sql->insert(C('app.db_prefix').'admin_log',array('string'=>$log, 'theTime'=>time(), 'adminId'=>$thisAdmin['userId'], 'ip'=>ip2long(ip())));
		return $query;
	}
	function getAdminLog($limit = 10, $wheres = NULL){
		$where = array("ORDER"=>'theTime DESC');
		if($wheres != NULL) $where = array_merge($wheres, $where);
		if(!isset($where['LIMIT'])) $where['LIMIT'] = $limit; 
		$tUser = C('app.db_prefix').'user';
		$query = WASD::$sql->select(C('app.db_prefix').'admin_log',
			// JOINING 
							array('[>]'.$tUser=>array("adminId" => "userId")),
							array('string','theTime','adminId','ip',$tUser.'.username'),
							$where);
		//exit(dump($wheres));
		return $query;
	}

	// Parameters string to array

	function printPaginator($p, $url, $params = NULL){
		$parts = explode("?", $url);
		$url = rtrim(rtrim($parts[0], '?'), '/');

		if($params == NULL) $params = $parts['1']; 
		if(!is_array($params)) parse_str($params, $params);
		
		$paginator .= "<li ".($p[c] == '1' ? 'class=\'disabled\'' : '')."><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'page')=>'1')))."'>&laquo; </a></li>";
		if(($cminus2 = $p['c']-2) > 0)
			$paginator .= "<li><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'page')=>$cminus2))).">$cminus2</a></li>";
		if(($cminus1 = $p['c']-1) > 0)
			$paginator .= "<li><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'page')=>$cminus1)))."'>$cminus1</a></li>";
		$paginator .= "<li class='active'><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'page')=>$$p['c'])))."'>$p[c]</a></li>";
		if(($cplus1 = $p['c']+1) <= $p['l'])
			$paginator .= "<li><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'page')=>$cplus1)))."'>$cplus1</a></li>";
		if(($cplus2 = $p['c']+2) < $p['l'])
			$paginator .= "<li><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'page')=>$cplus2)))."'>$cplus2</a></li>";
		$paginator .= "<li ".($p[c] == $p['l'] ? 'class=\'disabled\'' : '')."><a href='".url_param($url, array_merge($params, array(T('this-page-slug', 'page')=>$p['l'])))."'>&raquo;</a></li>";
		
		return $paginator;
	}		
	function currentUrl($var = 1) {
		$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https' : 'http';
		$host     = $_SERVER['HTTP_HOST'];
		$script   = $_SERVER["REQUEST_URI"];
		 
		$currentUrl = $protocol . '://' . $host . $script;
		if($var == 0){
			$currentUrl = explode("?", $currentUrl);
			return $currentUrl[0];
		}
		return $currentUrl;
	}
	function languageList(){
       	if ($handle = opendir(LANG_PATH)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    echo "<option value='$entry' ".(C('app.language') == $entry ? 'selected' : '').">".ucfirst($entry)."</option>";
                }
            }
            closedir($handle);
       }
	}
	function grab_image($url, $saveto){
	    $ch = curl_init ($url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
	    $raw = curl_exec($ch);
	    curl_close ($ch);
	    if(file_exists($saveto)){
	        unlink($saveto);
	    }
	    $fp = fopen($saveto,'x');
	    fwrite($fp, $raw);
	    fclose($fp);
	}

	function controllerRegister($controller, $plugin, $file, $type = 'extend'){
		$registeredControllers[$controller][$type][] = array('plugin'=>$plugin, 'file'=>$file);
		$controllers = array_merge($registeredControllers, C('app.registeredControllers', array()));
		WASD::writeConfig(array('registeredControllers'=>$controllers));
	}
	function controllerDeregister($controller, $plugin, $file, $type = 'extend'){
		$rc = C('app.registeredControllers');
		if(isset($rc[$controller])){
			if(isset($rc[$controller][$type])){
				for($i = 0; $i < count($rc[$controller][$type]); $i++){
					if($rc[$controller][$type][$i]['plugin'] == $plugin) unset($rc[$controller][$type][$i]);
				}
				if(count($rc[$controller][$type]) == 0) unset($rc[$controller][$type]);
			}
			if(count($rc[$controller]) == 0) unset($rc[$controller]);
		}
		WASD::writeConfig(array('registeredControllers'=>$rc));
	}

	function isValidTimeStamp($timestamp){
	    return ((string) (int) $timestamp === $timestamp) 
	        && ($timestamp <= PHP_INT_MAX)
	        && ($timestamp >= ~PHP_INT_MAX);
	}

	function ago($ptime){
		
		if(!isValidTimeStamp($ptime)) $ptime = strtotime($ptime);

	    $etime = time() - $ptime;

	    if ($etime < 1)
	    {
	        return '0 seconds';
	    }

	    $a = array( 365 * 24 * 60 * 60  =>  T('year'),
	                 30 * 24 * 60 * 60  =>  T('month'),
	                      24 * 60 * 60  =>  T('day'),
	                           60 * 60  =>  T('hour'),
	                                60  =>  T('minute'),
	                                 1  =>  T('second')
	                );
	    $a_plural = array( T('year')   => T('years'),
	                       T('month')  => T('months'),
	                       T('day')    => T('days'),
	                       T('hour')   => T('hours'),
	                       T('minute') => T('minutes'),
	                       T('second') => T('seconds')
	                );

	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . T(' ago');
	        }
	    }
	}

	/**********************************************************
	 **********************************************************
	  Token
	 **********************************************************
	 **********************************************************/

	function doToken(){
		$token = md5(rand());
		session('token', $token);
	}
	function checkToken($token){
		if($token == session('token'))
			return true;
		doToken();
		return false;
	}
	
	function array_to_attr($attr){
		$attr_str = '';

		foreach ((array) $attr as $property => $value)
		{
			// Ignore null/false
			if ($value === null or $value === false)
			{
				continue;
			}

			// If the key is numeric then it must be something like selected="selected"
			if (is_numeric($property))
			{
				$property = $value;
			}

			$attr_str .= $property.'="'.$value.'" ';
		}

		// We strip off the last space for return
		return trim($attr_str);
	}

	function html_tag($tag, $attr = array(), $content = false){
		$has_content = (bool) ($content !== false and $content !== null);
		$html = '<'.$tag;

		$html .= ( ! empty($attr)) ? ' '.(is_array($attr) ? array_to_attr($attr) : $attr) : '';
		$html .= $has_content ? '>' : ' />';
		$html .= $has_content ? $content.'</'.$tag.'>' : '';

		return $html;
	}

	function json_out(array $array = array()){
		echo json_encode($array);
		exit;
	}

	function copy_directory($src,$dst) { 
	    $dir = opendir($src); 
	    @mkdir($dst); 
	    while(false !== ( $file = readdir($dir)) ) { 
	        if (( $file != '.' ) && ( $file != '..' )) { 
	            if ( is_dir($src . '/' . $file) ) { 
	                copy_directory($src . '/' . $file,$dst . '/' . $file); 
	            } 
	            else { 
	                copy($src . '/' . $file,$dst . '/' . $file); 
	            } 
	        } 
	    } 
	    closedir($dir); 
	}  

	function deleteDir($path) {
    return is_file($path) ?
            @unlink($path) :
            array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
	}

    function url_param($url, array $change){
    	$parts = parse_url($url);
		parse_str($parts['query'], $params);
		foreach($change as $key => $value){
			if((string)$value != '')
				$params[$key] = $value;
		}
		return strtok($url, '?').'?'.http_build_query($params);
	}


	// USER

	function isLoggedIn(){
		if (is_array(session('thisUser'))) return true;
		return false;
	}
	
	function isAdmin(){
		if (is_array(session('thisUser')) && session_get('permissions', 'master_admin') == '1') return true;
		return false;
	}

	function userIsExist($field, $value){
		$search = WASD::$sql->select(C('app.db_prefix').'user', array('userId'), array($field=>$value, 'LIMIT'=>1));
		if(is_array($search) && count($search) == 1) return true;
		return false;
	}

	function confirmEmail($email, $code = NULL){
		if($code == NULL){
			// NO Code, so it mean gen a confirm code for this email
			$code = uniqid();
			WASD::$sql->update(C('app.db_prefix').'user', array('confirmCode'=>$code), array('email'=>$email, 'LIMIT'=>'1'));
			return $code;
		}	
        $check = WASD::$sql->select(C('app.db_prefix')."user", array("confirmedEmail"), array('email'=>$email, 'LIMIT'=>'1'));
        if($check[0]['confirmedEmail'] == '1') return 'half-ok';	
        $check = WASD::$sql->select(C('app.db_prefix')."user", array("userId"), array('AND' => array("confirmCode"=>$code, 'email'=>$email), 'LIMIT'=>'1'));
        if(is_array($check) && count($check) == '1'){
            WASD::$sql->update(C('app.db_prefix')."user", array("confirmedEmail"=>'1'), array("userId"=>$check[0]['userId'], 'LIMIT'=>'1')); 
			event('confirm', $check[0]['userId']);
            return 'ok';
        }
            return 'ko';
    }
        
    function resetpw($email, $code){
            $this->db->limit_val = "1";
            $result = $this->db->dbSelect($this->ninja_config['TABLES_PREFIX']."users",array("salt"),array("code"=>$code,'email'=>$email));
            if(count($result) == '1'){
                $newpw = $this->pw_with_salt($result[0]['salt'],'123456');
                $this->db->dbUpdate($this->ninja_config['TABLES_PREFIX']."users",array("password"=>$newpw,"code"=>''),array("email"=>$email)); 
                return true;
            }
                return false;
    }

    function secure_img_upload($file, $path, $options = array()){
    	// HANDLE OPTIONS
    	$validExtensions = isset($options['validExtensions']) ? $options['validExtensions'] : array('jpg', 'jpeg', 'png');
    	$surfix = isset($options['surfix']) ? $options['surfix'] : '';
    	
    	// HANDLES FILES
    	$tempFile           =    $file['tmp_name'];
    	$fileName        	=    $file['name'];
    	$extension 			= 	 explode(".", $fileName);
    	$extension 			=    strtolower(end($extension));
    	$imageName       	=    sha1($fileName.uniqid());
    	$destination		= 	 rtrim($path, '/').'/'.$imageName.$surfix.'.'.$extension;

    	if(in_array($extension, $validExtensions)) {
	        $validExtension        =    true;    
	    } else {
	        $validExtension        =    false;    
	    }

	    // Run getImageSize function to check that we're really getting an image
	    if(getimagesize($tempFile) == false) {
	        $validImage        =    false;    
	    } else {
	        $validImage        =    true;    
	    }

	    if($validExtension == true && $validImage == true) {
        	if(move_uploaded_file($tempFile, $destination)) {
        		return $destination;
        	}else{
        		return array('s'=>'ko', 'm'=>T("Invalid path."));
        	}
        }else{
        	return array('s'=>'ko', 'm'=>T("Invalid extension."));
        }
    }