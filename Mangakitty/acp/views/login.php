<html>
<?php echo $header; ?>
<body>
 <div id="login-page">
      <div class="container">
        <div id="login-block">

          <!-- option 1, use image as main logo -->
          <img src="<?php echo URL('acp/assets/imgs/wasdlogo.png') ?>" id="login-image" alt="<?php echo C('app.title') ?> logo" />
          <!-- option 2 use icon as main logo, uncomment this line below -->
          <!-- <i class="fa fa-mortar-board" id="login-icon"></i> -->

          <!-- change form action url -->
          <form method="POST" role="form">
			<input type="hidden" name="action" value="login">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icon-user-outline"></i></span>
                <input type="text" name="username" class="form-control " placeholder="<?php echo T('Username', 'Username'); ?>">
              </div>
            </div>
            <!-- form-group -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icon-key-outline"></i></span>
                <input type="password" name="password" class="form-control " placeholder="<?php echo T('Password', 'Password'); ?>">
              </div>
            </div>
            <!-- button -->
            <button type="submit" class="btn btn-block btn-lg btn-sky"><i class="icon-login"></i> <?php echo T('Login', 'Login'); ?></button>
          </form>
          <!-- /form -->

        </div>
      </div>
    </div>
	<?php echo $footer ?>
    <?php if (isset($message)) echo '<script> $.growl({ type: \'danger\', message: "'. $message .'" });</script>';  ?>
</body>
</html>