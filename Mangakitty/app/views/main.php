  <?php echo $header ?>
  <body>
    <div id="blog-page">
      <div class="container">

      	<?php echo $topHeader ?>

    	  <?php echo $navigator ?>
        
        <!-- article area -->
        <div class="row">

          <div class="col-md-9">	

            <?php echo C('app.ads2') ?>

          	<?php echo $content ?>

            <div class="clearfix"></div>
            <?php echo C('app.ads3') ?>
			
			
			
          </div>
          <div class="col-md-3">

          <?php echo $sidebar ?>

          </div>
        </div>
        <!-- /article area -->

		  <!-- footer and copyright -->
      <div class="clearfix"><br /><br /></div>
    	<?php echo $footer ?>

      </div>
    </div>
  </body>
  </html>