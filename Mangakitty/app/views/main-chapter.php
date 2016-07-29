  <?php echo $header ?>
  <body>

    <div id="blog-page">
      <div class="container">

    	  <?php echo $navigator ?>
        
        <!-- article area -->
        <div class="row">

          <div class="col-md-12">	
          	<?php echo do_shortcode(C('app.chapterContent')) ?>
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