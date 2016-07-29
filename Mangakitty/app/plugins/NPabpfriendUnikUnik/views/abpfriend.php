 <?php 
	include "/app/plugins/NPabpfriendUnikUnik/controllers/var_declare.php";
?>

<div class="col-lg-8">
  <h3>AdBlockPlus-Friend (Nusantara Project) </h3>
  <hr>
  <?php echo Form::open(array('action'=>currentUrl(0), 'method'=>'POST', 'class'=>'form-horizontal', 'role'=>'form')) ?>
  <div class="form-group">
    <?php echo Form::hidden('action', 'save_abpfriend') ?>
   	<label class="col-lg-3 control-label"><?php echo T('Enable'); ?></label>
    	<div class="col-lg-9">
		<?php echo Form::select('abpfriend_enable', $enable, array('1'=>T('Enable'), '2'=>T('Disable'), ), array('class'=>'form-control', 'style'=>'float: right')) ?>
		</div>
  </div>
 
 <div class="form-group">
   	<label class="col-lg-3 control-label"><?php echo T('Theme color'); ?></label>
    	<div class="col-lg-9">
		<?php echo Form::select('abpfriend_color', $color, array('blue'=>T('blue'), 'green'=>T('green'), 'lightblue'=>T('lightblue'), 'orange'=>T('orange'), 'red'=>T('red'), ), array('class'=>'form-control', 'style'=>'float: right')) ?>
		</div>
  </div>

 
  <div class="form-group"> 	
   	<label class="col-lg-3 control-label"><?php echo T('Message'); ?></label>
    	<div class="col-lg-9">
			<?php echo Form::textarea('abpfriend_message', $message, array('class'=>'form-control', 'required', 'rows'=>'6', 'placeholder'=>T('It seems that you have activated Adblock Plus, it may cause some functions do not work properly. Please turn off Adblock Plus Refresh') )) ?>
			 <div style="float:left">don't use " (quotation mark), please replace with \' (reverse-solidus apostrophe)</div>
		</div>
  </div>
  
  <div class="clearfix"><br /></div>
  <div class="form-group">
	<div class="col-lg-offset-3 col-lg-9">
		<button class=" btn btn-block btn-primary">Save AdBlockPlus-Friend Setting</button>
	</div>
  </div>
  <?php echo Form::close() ?>
</div>

