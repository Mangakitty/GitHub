<?php if (!defined("_WASD_")) exit; ?>


<?php echo Form::open(array('method'=>'POST', 'action'=>currentURL(0), "class"=>"form-horizontal", "role"=>"form", "enctype"=>"multipart/form-data")) ?>
    <?php if(isset($message) && is_array($message)): ?>
      <div class="col-lg-offset-4 alert alert-dismissable alert-<?php echo $message[0] ?>">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $message[1] ?>
      </div>
    <?php endif ?>
	<div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('Username'); ?></label>
	    <div class="col-lg-8">
	      <?php echo Form::input('username', session_get('thisUser', 'username'), array("class"=>"form-control ", "disabled")) ?>
	    </div>
	</div>
	<div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('Email'); ?></label>
	    <div class="col-lg-8">
	      <?php echo Form::input('email', session_get('thisUser', 'email'), array("class"=>"form-control ", "disabled")) ?>
	    </div>
	</div>
	<hr>

	<div class="form-group <?php echo ($message['2'] == 'avatar') ? 'has-error' : '' ?>">
	    <label class="col-lg-4 control-label"><?php echo T('Avatar'); ?></label>
	    <div class="col-lg-8">
	      <?php if (session_get('preferences', 'avatar') != ''): ?>
	      	<img class="img-thumbnail" style="margin: 0 0px 10px;" src="<?php echo URL(session_get('preferences', 'avatar')) ?>">
	      <?php endif ?>
	      <?php echo Form::input('avatar', '', array("type"=>"file", "class"=>"form-control ")) ?>
	    </div>
	</div>
	<hr>
	<?php if(isset($message2) && is_array($message2)): ?>
      <div class="col-lg-offset-4 alert alert-dismissable alert-<?php echo $message2[0] ?>">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo $message2[1] ?>
      </div>
    <?php endif ?>
	<div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('New password'); ?></label>
	    <div class="col-lg-8">
	      <?php echo Form::password('password', '', array("class"=>"form-control ")) ?>
	      <label><?php echo T('Leave this if you do not want to change your password') ?></label>
	    </div>
	</div>
	<div class="form-group <?php echo ($message2['2'] == 'password') ? 'has-error' : '' ?>">
	    <label class="col-lg-4 control-label"><?php echo T('Confirm Password'); ?></label>
	    <div class="col-lg-8">
	      <?php echo Form::password('repassword', '', array("class"=>"form-control ")) ?>
	    </div>
	</div>
	<?php echo event('usercp_settings', '') ?>
	<div class="form-group <?php echo ($message2['2'] == 'password') ? 'has-error' : '' ?>">
	    <label class="col-lg-4 control-label">&nbsp;</label>
	    <div class="col-lg-8">
	      <button class="btn btn-primary" type="submit"><?php echo T('Save') ?></button>
	    </div>
	</div>
<?php echo Form::close() ?>