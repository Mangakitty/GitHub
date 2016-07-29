<div class="col-lg-9 col-sm-12">
	<h3><?php echo T('PHP Manga Script'); ?></h3>
	<hr>
	<?php echo Form::open(array("action"=>currentUrl(),"class"=>"form-horizontal","role"=>"form")) ?>
	  <input type="hidden" name="action" value="update">
	  <h3><?php echo T('Comment') ?></h3>
	  <div class="form-group">
	  	<div class="col-lg-12"><?php echo T('Moderation need for new comment?') ?></div>
	    <div class="col-lg-12">
		  <?php echo Form::select('commentModerate', C('app.commentModerate', '1'), array('1'=>T('Yes'), '2'=>T('No')), array('class'=>'form-control')) ?>
	    </div>
 	  </div>
 	  <div class="form-group">
 	  	<div class="col-lg-12"><strong><?php echo T('Limit x comment times in y second') ?></strong></div>
 	  	<div class="col-lg-12">
 	  		<?php echo T('Y second:') ?>
 	  		<?php echo Form::input('commentLimitTime', C('app.commentLimitTime', '300'), array('class'=>'form-control')) ?>
 	  		<?php echo T('X times:') ?>
 	  		<?php echo Form::input('commentLimit', C('app.commentLimit', '3'), array('class'=>'form-control')) ?>
 	  	</div>
 	  </div>
 	  <div class="form-group">
 	  	<div class="col-lg-12"><strong><?php echo T('Min length & Max length') ?></strong></div>
 	  	<div class="col-lg-12">
 	  		<?php echo T('Minimum characters') ?>
 	  		<?php echo Form::input('commentLMin', C('app.commentLMin', '10'), array('class'=>'form-control')) ?>
 	  		<?php echo T('Maximum character') ?>
 	  		<?php echo Form::input('commentLMax', C('app.commentLMax', '140'), array('class'=>'form-control')) ?>
 	  	</div>
 	  </div>
	  <?php echo event('acp_manga_settings', '') ?>
	  <div class="clearfix"></div>
	  <div class="form-group">
	    <div class="col-lg-12">
	      <button type="submit" class="btn btn-primary btn-md"><?php echo T('Save changes');?></button>
	    </div>
 	  </div>
</form>
</div>