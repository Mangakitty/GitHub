	<!-- menu -->
      <div id="acp-menu">
        <p class="text-center visible-xs">
          <a href="#" class="btn btn-lg btn-orange toggle-sidemenu" id="acp-compose-button"><i class="icon-menu-2"></i></a>
        </p>
        <ul id="acp-menu-listing" class="list-unstyled" role="tablist">
        <?php echo event('acp_left_menu', $menu) ?>
        <?php echo event('acp_left_menu2', $menu) ?>
        <li><a href="<?php echo URL('admin/logout') ?>"><i class="icon-off"></i> <span class="acp-md-text"><?php echo T('Log out') ?></span></a></li>
        </ul>
      </div>
      <!-- /menu -->


      <div class="tab-content">
		  <?php echo event('acp_left_menu_detail', $menu) ?>
	  </div>
      <!-- acp-list -->
      
      <!-- /acp-list -->
