      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-sm-12 well">
            <?php if(isset($message) && is_array($message)): ?>
              <div class="alert alert-dismissable alert-<?php echo $message[0] ?>">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $message[1] ?>
              </div>
            <?php endif ?>
            <?php echo Form::open(array('action'=>URL('login'), 'method'=>'POST', 'class'=>"form-horizontal")) ?>
              <?php echo Form::hidden('action', 'login') ?>
              <?php echo Form::hidden('token', session('token')); ?>
              <fieldset>
                <div class="form-group <?php echo ($message['2'] == 'username') ? 'has-error' : '' ?>">
                  <label for="inputUsername" class="col-lg-3 control-label"><?php echo T('Username or Email') ?></label>
                  <div class="col-lg-8">
                    <?php echo Form::input('username_email', stripslashes(R('username_email')), array('autocomplete'=>"off", 'required', 'placeholder'=>'Your registered Username or Email', 'class'=>"form-control")) ?>
                  </div>

                </div>
                <div class="form-group" <?php echo ($message['2'] == 'password') ? 'has-error' : '' ?>>
                  <label for="inputPassword" class="col-lg-3 control-label"><?php echo T('Password') ?></label>
                  <div class="col-lg-8">
                    <?php echo Form::input('password', R('password'), array('autocomplete'=>"off", 'required', 'placeholder'=>'Your registered password', 'class'=>"form-control", 'type'=>'password')) ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-8 col-lg-offset-3">
                    <button type="submit" class="btn btn-primary"><?php echo T('Sign in') ?></button>
                  </div>
                </div>
              </fieldset>
            <?php echo Form::close(); ?>
          </div>
        </div>
      </div>