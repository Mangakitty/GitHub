      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <h1><?php echo T('Confirmation') ?></h1>
            <p class="lead"><?php echo T('Confirm your email') ?></p>
          </div>
          <div class="col-md-8 col-sm-12 well">
            <?php if ($status == 'ok'): ?>
              <?php echo T('Congratulations! Your account has been activated, you can login from now') ?>
            <?php elseif($status == 'half-ok'): ?>
              <?php echo T('Your account already activated') ?>
            <?php else: ?>
              <?php echo T('Wrong confirmation info or this link has been expired') ?>
            <?php endif ?>
          </div>
        </div>
      </div>