      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-sm-12 well">
            <?php if(isset($message) && is_array($message)): ?>
              <div class="alert alert-dismissable alert-<?php echo $message[0] ?>">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $message[1] ?>
              </div>
            <?php endif ?>
            <?php echo Form::open(array('action'=>URL('register'), 'method'=>'POST', 'class'=>"form-horizontal")) ?>
              <?php echo Form::hidden('action', 'register') ?>
              <?php echo Form::hidden('token', session('token')); ?>
              <fieldset>
                <div class="form-group <?php echo ($message['2'] == 'username') ? 'has-error' : '' ?>">
                  <label for="inputUsername" class="col-lg-4 control-label"><?php echo T('Username') ?></label>
                  <div class="col-lg-8">
                    <?php echo Form::input('username', R('username'), array('autocomplete'=>"off", 'required', 'placeholder'=>'Your username with alphabet, number and underscope only', 'class'=>"form-control")) ?>                   
                  </div>

                </div>
                <div class="form-group" <?php echo ($message['2'] == 'email') ? 'has-error' : '' ?>>
                  <label for="inputEmail" class="col-lg-4 control-label"><?php echo T('Email') ?></label>
                  <div class="col-lg-8">
                    <?php echo Form::input('email', R('email'), array('autocomplete'=>"off", 'required', 'placeholder'=>'Your real email address', 'class'=>"form-control", 'type'=>'email')) ?>
                  </div>
                </div>
                <div class="form-group" <?php echo ($message['2'] == 'password') ? 'has-error' : '' ?>>
                  <label for="inputPassword" class="col-lg-4 control-label"><?php echo T('Password') ?></label>
                  <div class="col-lg-8">
                    <?php echo Form::input('password', R('password'), array('autocomplete'=>"off", 'required', 'placeholder'=>'A headache password', 'class'=>"form-control", 'type'=>'password')) ?>
                  </div>
                </div>
                <div class="form-group" <?php echo ($message['2'] == 'password') ? 'has-error' : '' ?>>
                  <label for="inputPassword" class="col-lg-4 control-label"><?php echo T('Confirm Your Password') ?></label>
                  <div class="col-lg-8">
                    <?php echo Form::input('password2', R('password2'), array('autocomplete'=>"off", 'required', 'placeholder'=>'Re-type your password', 'class'=>"form-control", 'type'=>'password')) ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-8 col-lg-offset-4">
                    <button type="submit" class="btn btn-primary"><?php echo T('Create') ?></button>
                  </div>
                </div>
              </fieldset>
            <?php echo Form::close(); ?>
          </div>
        </div>
      </div>