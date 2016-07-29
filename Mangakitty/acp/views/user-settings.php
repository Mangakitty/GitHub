<div class="col-lg-6 col-sm-12">
	<h3><?php echo T('User Settings'); ?></h3>
	<hr>
	<?php if(isset($error)): ?>
		<div class="alert alert-danger" role="alert">
	      <strong><?php echo T('Oh snap', 'Oh snap!'); ?></strong> <?php echo $error; ?>
	    </div>
	<?php elseif(isset($info)): ?>
		<div class="alert alert-info" role="info">
	      <strong> <?php echo T('Yay!'); ?></strong> <?php echo $info; ?>
	    </div>
	<?php endif; ?>
	<form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
	  <input type="hidden" name="action" value="update">
	  <div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('User need to confirm?'); ?></label>
	    <div class="col-lg-8">
	      <?php echo Form::select('confirmationNeed', C('app.confirmationNeed'), array('1'=>T('Yes'), '0'=>T('No')), array('class'=>'form-control')) ?>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('Default Role'); ?></label>
	    <div class="col-lg-8">
	      <?php foreach ($roles as $k => $v) $selectRole[$k] = ucfirst($v['name']);?>
	      <?php echo Form::select('defaultRole', C('app.defaultRole'), $selectRole, array('class'=>'form-control')) ?>
	      <label><?php echo T('Assign a role for new user') ?></label>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('Guest Role'); ?></label>
	    <div class="col-lg-8">
	      <?php foreach ($roles as $k => $v) $selectRole[$k] = ucfirst($v['name']);?>
	      <?php echo Form::select('guestRole', C('app.guestRole'), $selectRole, array('class'=>'form-control')) ?>
	      <label><?php echo T('Assign a role for user who not logged in') ?></label>
	    </div>
	  </div>
	  <div class="form-group <?php echo ($message['2'] == 'avatar') ? 'has-error' : '' ?>">
	    <label class="col-lg-4 control-label"><?php echo T('Avatar'); ?></label>
	    <div class="col-lg-8">
	      <?php if (C('app.defaultAvatar') != ''): ?>
	      	<img class="img-thumbnail" style="margin: 0 0px 10px;" src="<?php echo URL(C('app.defaultAvatar')) ?>">
	      <?php endif ?>
	      <?php echo Form::input('avatar', '', array("type"=>"file", "class"=>"form-control ")) ?>
	    </div>
	  </div>
	  <div class="clearfix"></div>
	  <div class="form-group">
	    <div class="col-lg-offset-4 col-lg-8">
	      <button type="submit" class="btn btn-primary btn-md"><?php echo T('Save changes');?></button>
	    </div>
  </div>
</form>
</div>