<div class="col-lg-offset-1 col-lg-6">
	<h3><?php echo T('Edit user'); ?></h3>
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
	<form action="" method="POST" class="form-horizontal" role="form">
	  <input type="hidden" name="action" value="edit">
	  <div class="form-group">
	    <label class="col-sm-2 control-label"><?php echo T('Username'); ?></label>
	    <div class="col-sm-10">
	      <input type="text" required class="form-control" name="username" value="<?php echo $username; ?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label"><?php echo T('Email'); ?></label>
	    <div class="col-sm-10">
	      <input type="text" required class="form-control" name="email" value="<?php echo $email; ?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label"><?php echo T('Password'); ?></label>
	    <div class="col-sm-10">
	      <input type="password" class="form-control" name="password">
	      <?php echo T('Leave blank if you do not want to change') ?>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label"><?php echo T('Role'); ?></label>
	    <div class="col-sm-10">
	    	<select name="role" class="form-control">
	    	<?php foreach ($roles as $k => $v): ?>
	    		<option value="<?php echo $k ?>" <?php if($v['name'] == $role) echo 'selected="selected"' ?>><?php echo ucfirst( $v['name'] ) ?></option>
	    	<?php endforeach ?>
	    	</select>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label"><?php echo T('Is confirmed'); ?></label>
	    <div class="col-sm-10">
	    	<div class="radio">
	            <label>
	              <input type="radio" name="confirmedEmail" value="1" <?php if($confirmedEmail == '1'){ echo 'checked="checked"'; } ?>>
	              <?php echo T('Yes') ?>
	            </label>
			</div>
	    	<div class="radio">
	            <label>
	              <input type="radio" name="confirmedEmail" value="0" <?php if($confirmedEmail == '0'){ echo 'checked="checked"';} ?>>
	              <?php echo T('No') ?>
	            </label>
	        </div>
	    </div>
	  </div>
	  <?php echo event('user-edit-form', '') ?>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-primary btn-sm"><i class="icon-check"></i> <?php echo T('Save');?></button>
	      <a class="btn btn-danger btn-sm" href="<?php echo url('admin/user/list'); ?>"><i class="icon-cross"></i> <?php echo T('Back to user list');?></a>
	    </div>
  </div>
</form>
</div>