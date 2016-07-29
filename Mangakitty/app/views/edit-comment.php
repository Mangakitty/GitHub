<div class="col-lg-9 col-sm-12">
	<h3><?php echo T('Edit confession'); ?></h3>
	<hr>
	<?php echo Form::open(array("action"=>URL("admin/management/comment"),"class"=>"form-horizontal","role"=>"form")) ?>
	  <input type="hidden" name="action" value="update">
	  <input type="hidden" name="commentId" value="<?php echo $cm['commentId'] ?>">
	  <div class="form-group">
	    <label class="col-lg-4 control-label"><?php echo T('Content'); ?></label>
	    <div class="col-lg-8">
	      <?php echo Form::textarea('content', $cm['content'], array("class"=>"form-control ", "required", 'cols'=>'5')) ?>
	    </div>
	  </div>

	  <div class="clearfix"></div>
	  <div class="form-group">
	    <div class="col-lg-offset-4 col-lg-8">
	      <button type="submit" class="btn btn-primary btn-md"><?php echo T('Edit');?></button>
	      <a href="<?php echo URL('admin/management/comment') ?>" class="btn btn-inverse btn-md"><?php echo T('Cancel');?></a>
	    </div>
  </div>
</form>
</div>