 <?php 
	include "/app/plugins/FlatSocialBarUnikUnik/controllers/var_declare.php";
?>

<div class="col-lg-6 col-sm-12">
  <h3>Social Network Site </h3>
  <hr>
  <?php echo Form::open(array('action'=>currentUrl(0), 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form')) ?>
  <div class="form-group">
    <?php echo Form::hidden('action', 'save_social') ?>
   	<label class="col-lg-4 control-label"><?php echo T('Facebook site'); ?></label>
    	<div class="col-lg-8">
			<?php echo Form::input('facebook_url', $fb, array('class'=>'form-control', 'placeholder'=>'http://facebook.com/unikunik.pw' )) ?>
		</div>
  </div>
   <div class="form-group">
   	<label class="col-lg-4 control-label"><?php echo T('Youtube site'); ?></label>
    	<div class="col-lg-8">
			<?php echo Form::input('youtube_url', $yt, array('class'=>'form-control', 'placeholder'=>'http://unikunik.pw/' )) ?>
		</div>
  </div>
   <div class="form-group">
   	<label class="col-lg-4 control-label"><?php echo T('Google+ site'); ?></label>
    	<div class="col-lg-8">
			<?php echo Form::input('googleplus_url', $gp, array('class'=>'form-control',  'placeholder'=>'http://unikunik.pw/')) ?>
		</div>
  </div>
   <div class="form-group">
   	<label class="col-lg-4 control-label"><?php echo T('Twitter site'); ?></label>
    	<div class="col-lg-8">
			<?php echo Form::input('twitter_url', $tw, array('class'=>'form-control',  'placeholder'=>'http://unikunik.pw/')) ?>
		</div>
  </div>
   <div class="form-group">
   	<label class="col-lg-4 control-label"><?php echo T('Devianart site'); ?></label>
    	<div class="col-lg-8">
			<?php echo Form::input('devianart_url', $da, array('class'=>'form-control',  'placeholder'=>'http://unikunik.pw/')) ?>
		</div>
  </div>
  <div class="clearfix"><br /></div>
  <div class="form-group">
	<div class="col-lg-offset-4 col-lg-8">
		<button class=" btn btn-block btn-primary">Save Social Site</button>
	</div>
  </div>
  <?php echo Form::close() ?>
</div>

