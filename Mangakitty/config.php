<?php
$config["app.title"] = 'Manga Kitty';
$config["app.description"] = 'Free manga at Manga Kitty';
$config["app.language"] = 'English';
$config["app.appName"] = 'PHP Manga';
$config["email.from"] = 'noreply@mangakitty.com';
$config["app.theme"] = 'default';
$config["app.cookiePrefix"] = 'sks';
$config["app.randomInit"] = 'lwfgc';
$config["app.version"] = '1.1';
$config["app.db_host"] = '127.0.0.1';
$config["app.db_name"] = 'mangakit_ty';
$config["app.db_user"] = 'mangakit_ty';
$config["app.db_password"] = '1221lexxX';
$config["app.db_prefix"] = '';
$config["app.minifyJs"] = '1';
$config["app.minifyCss"] = '0';
$config["app.dateFormat"] = 'F j, Y';
$config["app.timeFormat"] = 'g:i a';
$config["app.timezone"] = 'America/New_York';
$config["app.dateFormatCustom"] = 'F j, Y';
$config["app.timeFormatCustom"] = 'g:i a';
$config["app.usernameRegex"] = '/^[a-zA-Z0-9_-]{3,16}$/';
$config["app.remoteVersion"] = 'http://huykhong.com/wasd/version/phpmanga/version.txt';
$config["app.startDate"] = 'Mon, 23 May 2016 00:20:54 +0700';
$config["app.installed"] = '1';
$config["email.confirmation"] = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
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
						https://mangakitty.com
					</td>
				</tr>
			</tbody>
		</table>
		</body>
		</html';
$config["link.plugins"] = 'http://unikunik.pw/?s=php+manga';
$config["link.themes"] = 'http://unikunik.pw/?s=php+manga';
$config["link.languages"] = 'http://unikunik.pw/?s=php+manga';
$config["app.enabledPlugins"] = array (
  0 => 'mangaHereGrabber',
  1 => 'jqupload',
);
$config["app.customCss"] = 'body{ 
    background-image: url("https://mangakitty.com/app/assets/images/original.jpg");}
.table-bordered {
	background-color: white;
    padding: 10px;
    margin: 3px;
}

div.manga_list2 {
	background-color: white;
display: block;
padding: 3px;
margin-bottom: 23px;
line-height: 1.66666667;
background-color: #fff;
border: 2px solid #e6e6e6;
border-radius: 2px;
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    font-size: 14px;
}
.media-heading {
    font-size: 20px;
}
.popover {
    font-size: 14px;
}
#pop-href2{
	background-color: white;
display: block;
padding: 10px;
margin-bottom: 23px;
line-height: 1.66666667;
background-color: #fff;
border: 2px solid #e6e6e6;
border-radius: 2px;
}
.navbar-nav > li {
	font-size: 14px;
}';
$config["app.customJs"] = '[analytic id="UA-79380143-1"] ';
$config["app.menu"] = '[home]
[directory]
<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mirror list  <b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="http://endive.mangakitty.com/">Endive</a></li>

					<li><a href="http://kimchi.mangakitty.com/">Kimchi</a></li>

					<li><a href="http://panini.mangakitty.com/">Panini</a></li>

					<li><a href="http://reuben.mangakitty.com/">Reuben</a></li>

					<li><a href="http://truffles.mangakitty.com/">Truffles</a></li>
					</ul>
				  </li>';
$config["app.ads1"] = '';
$config["app.ads2"] = '<script type="text/javascript">
var ad_idzone = "2143695",
	 ad_width = "728",
	 ad_height = "90";
</script>
<script type="text/javascript" src="https://ads.exoclick.com/ads.js"></script>
<noscript><a href="http://main.exoclick.com/img-click.php?idzone=2143695" target="_blank"><img src="https://syndication.exoclick.com/ads-iframe-display.php?idzone=2143695&output=img&type=728x90" width="728" height="90"></a></noscript>
<script type="text/javascript">
<!--
	var adblock = true;
//-->
</script>
<script type="text/javascript" src="https://mangakitty.com/adframe.js"></script>
<script type="text/javascript">
    if(adblock) {
    document.write(\'<div>Please disable your adblocking program, Our ads are <b>not</b> annoying or distracting in any way, and are not known to popup or be malicious of any nature. For the sake of reading awesome hentai manga and simply being awesome, please support us by disabling your ad blocker :) Thanks</div>\');
    }
</script>';
$config["app.ads3"] = '<script type="text/javascript">
var ad_idzone = "2143711",
	 ad_width = "728",
	 ad_height = "90";
</script>
<script type="text/javascript" src="https://ads.exoclick.com/ads.js"></script>
<noscript><a href="http://main.exoclick.com/img-click.php?idzone=2143711" target="_blank"><img src="https://syndication.exoclick.com/ads-iframe-display.php?idzone=2143711&output=img&type=728x90" width="728" height="90"></a></noscript>
<script type="text/javascript">
<!--
	var adblock = true;
//-->
</script>
<script type="text/javascript" src="https://mangakitty.com/adframe.js"></script>
<script type="text/javascript">
    if(adblock) {
    document.write(\'<div>Please disable your adblocking program, Our ads are <b>not</b> annoying or distracting in any way, and are not known to popup or be malicious of any nature. For the sake of reading awesome hentai manga and simply being awesome, please support us by disabling your ad blocker :) Thanks</div>\');
    }
</script>';
$config["app.widget"] = '[manga-cover]
[search-box]
[listing-sidebar]
[manga-list2 quantity="5" title="Most popular" order="DESC" sorting="views"]
';
$config["app.footerLeft"] = '';
$config["app.footerRight"] = '';
$config["app.headerBrand"] = '<h1 class="text-uppercase" id="blog-name"><a href="/">MANGA KITTY</a> <a href="/"><img src="https://mangakitty.com/acp/assets/imgs/wasdlogo.png" height=140></h1></a>';
$config["app.homeContent"] = '[latest-manga title="10 Latest Manga" quantity="10"]
</br>
<div id="pop-href2"/>
[latest-manga2 title="10 Latest Manga" quantity="10"]
</div>';
$config["app.mangaContent"] = '<div id="pop-href2"/>
[manga-info]
[manga-chapter-list]

<div id="disqus_thread"></div>
<script>

/**
 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables */
/*
var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page\'s canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page\'s unique identifier variable
};
*/
(function() { // DON\'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement(\'script\');
    s.src = \'//mangakitten.disqus.com/embed.js\';
    s.setAttribute(\'data-timestamp\', +new Date());
    (d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                    
</div>';
$config["app.chapterContent"] = '<div class="col-lg-4 col-lg-offset-4">[select-chapter]</div>
<div class="clearfix"><br /></div>
<div class="col-lg-4 col-lg-offset-4 text-center">[select-page]</div>
<div class="clearfix"><br /><br /><br /></div>
<center><script type="text/javascript">
var ad_idzone = "2143729",
	 ad_width = "728",
	 ad_height = "90";
</script>
<script type="text/javascript" src="https://ads.exoclick.com/ads.js"></script>
<noscript><a href="http://main.exoclick.com/img-click.php?idzone=2143729" target="_blank"><img src="https://syndication.exoclick.com/ads-iframe-display.php?idzone=2143729&output=img&type=728x90" width="728" height="90"></a></noscript>
<script type="text/javascript">
<!--
	var adblock = true;
//-->
</script>
<script type="text/javascript" src="https://mangakitty.com/adframe.js"></script>
<script type="text/javascript">
    if(adblock) {
    document.write(\'<div>Please disable your adblocking program, Our ads are <b>not</b> annoying or distracting in any way, and are not known to popup or be malicious of any nature. For the sake of reading awesome hentai manga and simply being awesome, please support us by disabling your ad blocker :) Thanks</div>\');
    }
</script></center>
[read-pbp]
';
$config["app.chapterMenu"] = '[home title=\'Back 2 home\']
';
$config["app.directoryContent"] = '[listing default="paging" perPage="50" default-sorting="name"]';
$config["app.textDirectoryContent"] = '[text-version]';
$config["app.confirmationNeed"] = '1';
$config["app.defaultGroup"] = '2';
$config["app.defaultRole"] = '2';
$config["app.guestRole"] = '2';
$config["app.defaultAvatar"] = '/upload/default.png';
$config["app.homeTitle"] = 'Free manga at {homeTitle}';
$config["app.homeDescription"] = 'Free manga, manhua, manhwa and comic at {homeTitle}';
$config["app.homeKeywords"] = 'manga, manhua, manhwa, comic, {homeTitle}';
$config["app.directoryTitle"] = 'Manga directory at {homeTitle} page {page}';
$config["app.directoryDescription"] = 'All manga, manhua, manhwa at {homeTitle} \'s directory';
$config["app.directoryKeywords"] = 'manga, manhua, manhwa, directory, manga collection, manga directory';
$config["app.mangaTitle"] = 'Read {name} ({released}) free at {homeTitle}';
$config["app.mangaDescription"] = '{mangaType} {name} free at {homeTitle}, updated chapter {lastChapter}';
$config["app.mangaKeywords"] = '{alternativeName}, {genre}, {name}';
$config["app.chapterTitle"] = 'Free reading {name} {chapterNumber} {chapterName} at {homeTitle}';
$config["app.chapterDescription"] = '{mangaType} {name} {chapterNumber} at {homeTitle}';
$config["app.chapterKeywords"] = '{name}, {chapterName}, read {name} {chapterNumber}';
$config["installed.mangaHereGrabber"] = '1';
$config["installed.jqupload"] = '1';
$config["installed.NPabpfriendUnikUnik"] = '1';
$config["installed.FlatSocialBarUnikUnik"] = '1';

// Last updated by @ Fri, 29 Jul 2016 01:54:25 -0400
?>