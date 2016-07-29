<div class="col-lg-6 col-sm-12">
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
	<form action="" method="POST" class="form-horizontal" role="form">
	  <input type="hidden" name="action" value="update">
	  <div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('Site Title'); ?></label>
	    <div class="col-lg-8">
	      <input type="text" required class="form-control " name="title" value="<?php echo C('app.title'); ?>">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('Description'); ?></label>
	    <div class="col-lg-8">
	      <input type="text" required class="form-control " name="description" value="<?php echo C('app.description'); ?>">
	    </div>
	  </div>
	  <?php 
			$timezones = DateTimeZone::listIdentifiers(); 
			$select = array();
			foreach ($timezones as $k => $zone) {
				$parts = explode('/', $zone);
				$select[$parts[0]][$zone] = str_replace('_', ' ', $parts[1]);
			}
	  ?>

	  <div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('Timezone'); ?></label>
	    <div class="col-lg-8">
	      <?php echo Form::select('timezone', C('app.timezone'), $select, array('class'=>'form-control')) ?>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('Date Format'); ?></label>
	    <div class="col-lg-8">
			<label title="F j, Y"><input type="radio" name="dateFormat" value="F j, Y" <?php if(C('app.dateFormat') == 'F j, Y') echo 'checked="checked"'; ?>> <span>September 12, 2014</span></label><br>
			<label title="Y-m-d"><input type="radio" name="dateFormat" value="Y-m-d" <?php if(C('app.dateFormat') == 'Y-m-d') echo 'checked="checked"'; ?>> <span>2014-09-12</span></label><br>
			<label title="m/d/Y"><input type="radio" name="dateFormat" value="m/d/Y" <?php if(C('app.dateFormat') == 'm/d/Y') echo 'checked="checked"'; ?>> <span>09/12/2014</span></label><br>
			<label title="d/m/Y"><input type="radio" name="dateFormat" value="d/m/Y" <?php if(C('app.dateFormat') == 'd/m/Y') echo 'checked="checked"'; ?>> <span>12/09/2014</span></label><br>
			<label>
				<input type="radio" name="dateFormat" id="date_format_custom_radio" value="custom" <?php if(!in_array(C('app.dateFormat'), array('F j, Y','Y-m-d','m/d/Y','d/m/Y'))) echo 'checked="checked"'; ?>> <?php echo T('Custom'); ?>: </label>
				<input type="text" name="dateFormatCustom" value="<?php echo C('app.dateFormat') ?>" class="form-control ">
		  
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('Time Format'); ?></label>
	    <div class="col-lg-8">
			<label title="g:i a"><input type="radio" name="timeFormat" value="g:i a" <?php if(C('app.timeFormat') == 'g:i a') echo 'checked="checked"'; ?>> <span>5:51 pm</span></label><br>
			<label title="g:i A"><input type="radio" name="timeFormat" value="g:i A" <?php if(C('app.timeFormat') == 'g:i A') echo 'checked="checked"'; ?>> <span>5:51 PM</span></label><br>
			<label title="H:i"><input type="radio" name="timeFormat" value="H:i" <?php if(C('app.timeFormat') == 'H:i') echo 'checked="checked"'; ?>> <span>17:51</span></label><br>
			<label><input type="radio" name="timeFormat" id="timeFormatCustom_radio" value="custom" <?php if(!in_array(C('app.timeFormat'), array('g:i a','g:i A','H:i'))) echo 'checked="checked"'; ?>> Custom: </label>
			<input type="text" name="timeFormatCustom" value="<?php echo C('app.timeFormat') ?>" class="form-control ">
			<p><a href="http://codex.wordpress.org/Formatting_Date_and_Time">Documentation on date and time formatting</a>.</p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('Language'); ?></label>
	    <div class="col-lg-8">
	      <select id="timezone" class="form-control " name="language">
	      	<?php echo languageList(); ?>
	      </select>
	    </div>
	  </div>
	  <?php echo event('acp-setting-general', '') ?>
	  <div class="clearfix"></div>
	  <div class="form-group">
	    <div class="col-lg-offset-4 col-lg-8">
	      <button type="submit" class="btn btn-primary btn-md"><?php echo T('Save changes');?></button>
	    </div>
  </div>
</form>
</div>