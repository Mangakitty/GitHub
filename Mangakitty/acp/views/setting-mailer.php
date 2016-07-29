<div class="col-lg-9 col-sm-12" style="margin-left: 10px;">
	<h3><?php echo T('General Settings', 'General Settings'); ?></h3>
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
	<?php echo Form::open(array('action'=>currentUrl(), 'method'=>'POST', 'class'=>"form-horizontal", 'role'=>"form")) ?>
	  <input type="hidden" name="action" value="update">
	  <div class="form-group">
	    <label class="col-lg-12"><?php echo T('Email From'); ?></label>
	    <div class="col-lg-12">
	      <?php echo Form::input('from', C('email.from'), array('class'=>'form-control', 'required')) ?>
	    </div>
	  </div>
	  <h3><?php echo T('Email Template') ?></h3>
	  <div class="form-group">
	    <label class="col-lg-12"><?php echo T('Confirmation template'); ?></label>
	    <div class="col-lg-12">
	      <?php echo Form::textarea('confirmation', C('email.confirmation'), array('class'=>'form-control', 'required', 'rows'=>'6')) ?>
	      <?php echo T('Available shortcodes:') ?> {user}, {siteTitle}, {link}<br />
	      <?php echo T('Html is allowed') ?>
	    </div>
	  </div>
	  <?php echo event('acp-setting-mailer', '') ?>
	  <div class="clearfix"></div>
	  <div class="form-group">
	    <div class="col-lg-offset-4 col-lg-12">
	      <button type="submit" class="btn btn-primary btn-md"><?php echo T('Save changes');?></button>
	    </div>
  </div>
</form>
</div>