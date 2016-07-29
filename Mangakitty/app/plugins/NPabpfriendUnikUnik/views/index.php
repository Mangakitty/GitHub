	<script src="/app/plugins/NPabpfriendUnikUnik/assets/js/advertisement.js"></script> 
 <?php 
			include "/app/plugins/NPabpfriendUnikUnik/controllers/var_declare.php";
  ?>
	<link rel="stylesheet" type="text/css" href="/app/plugins/NPabpfriendUnikUnik/assets/css/<?php echo $color ?>.css"> 
	<!-- <script src="/app/plugins/NPabpfriendUnikUnik/assets/js/NP-AdBlockPlus-Friend.js"></script> 
	-->
	
	<?php
	if($enable == '1'){
	echo '<script type="text/javascript">	
if (document.getElementById("detectabp") == undefined)
	{
	document.write("<div id=\\\'npadsfriend-notice\\\'><div id=\\\'npadsfriend-notice-navbar\\\'><b class=\\\'brand\\\'>NP-AdBlock Friend</b><a class=\\\'npadsfriend-navbar-link\\\' title=\\\'Visit Homepage\\\' href=\\\'\\\'>Home</a><a class=\\\'npadsfriend-navbar-link\\\' title=\\\'Donate\\\' href=\\\'\\\'>Donate</a><a class=\\\'npadsfriend-navbar-link\\\' title=\\\'Plugin Homepage\\\' href=\\\'\\\'>Nusantara Project</a></div><div id=\\\'npadsfriend-notice-content\\\'><u style=\\\'font-size: 18px;\\\'>Notice:<br></u>' . $message . '</div></div>");
	}
</script>	
	';
	}
	?>
