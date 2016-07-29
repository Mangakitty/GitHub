<!-- navigation area -->
<div class="row-fluid">
  <div class="col-sm-12">
    <div class="navbar navbar-inverse navbar-fixed-top navbar-responsive-collapse">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a href="<?php echo event('print_manga_url', $thisManga) ?>" class="navbar-brand"><?php echo $thisManga['name'] ?></a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
           <?php echo do_shortcode(C('app.chapterMenu')) ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </div>
  </div>
</div>
<!-- /navigation area -->