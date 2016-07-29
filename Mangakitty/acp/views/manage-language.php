<div class="col-lg-12">
<div class="clearfix"><br /></div>
  <div class="table-responsive">
  	<table class="table table-hover">
        <tbody>
        <?php foreach($languages as $l): ?>
          <tr>
            <td><?php if(file_exists($file = LANG_PATH . "/$l/icon.png")) echo "<img src='".URL("languages/$l/icon.png")."' width='16px' height='16px' style='vertical-align: baseline;'>" ?>
                <strong><?php echo $l; ?></strong></td>
            <td>
                <!-- USE FROM -->
                <?php echo Form::open(array('action'=>URL('admin/language/management'), 'method'=>'POST', 'style'=>'display:inline')) ?>
                <?php echo Form::hidden('action', 'set') ?>
                <?php echo Form::hidden('language', $l) ?>
                <button class="btn btn-inverse btn-xs" <?php echo C('app.language') == $l ? 'disabled' : '' ?>><i class="icon-check"></i><?php echo T('Set as default') ?></button>
                <?php echo Form::close() ?>

                <!-- DUPLICATED FROM -->
                <?php echo Form::open(array('action'=>URL('admin/language/management'), 'method'=>'POST', 'style'=>'display:inline')) ?>
                <?php echo Form::hidden('action', 'duplicate') ?>
                <?php echo Form::hidden('language', $l) ?>
                <button class="btn btn-green btn-xs"><i class="icon-docs"></i><?php echo T('Duplicate') ?></button>
                <?php echo Form::close() ?>

            	<!-- RENAME FROM -->  
            	<button class="btn btn-pink btn-xs" data-toggle="modal" data-target="#rename-<?php echo $l ?>"> <i class="icon-wrench"></i><?php echo T('Rename') ?></button>

            	<div id="rename-<?php echo $l ?>" class="modal fade scale-effect" tabindex="-1" role="dialog" aria-labelledby="renameModal" aria-hidden="true">
					<div class="modal-dialog">
					  <div class="modal-content">
					    <div class="modal-body">
			            	<?php echo Form::open(array('action'=>URL('admin/language/management'), 'class'=>"form-horizontal", 'role'=>"form",'method'=>'POST', 'style'=>'display:inline')) ?>
			            	<?php echo Form::hidden('action', 'rename') ?>
			            	<?php echo Form::hidden('language', $l) ?>
				              <div class="form-group">
				                <label class="col-sm-4 control-label"><?php echo T('New Name') ?></label>
				                <div class="col-sm-8">
				                  <?php echo Form::input('new_name', $l.T('New'), array('class'=>'form-control')) ?>
				                  <small> <?php echo T('No space language name') ?>  </small>
				                </div>
				              </div>
				              <div class="form-group">
				                <label class="col-sm-4 control-label"></label>
				                <div class="col-sm-8">
				               		<button class="btn btn-green"><?php echo T('Save changes') ?></button>
				               		<button class="btn" data-dismiss="modal"><?php echo T('Cancel') ?></button>
				                </div>
				              </div>
				            <?php echo Form::close() ?>
					    </div>
					  </div>
					</div>
				</div>

            	<!-- EDIT FROM -->        
            	<a href="<?php echo URL('admin/language/edit/'.$l) ?>" class="btn btn-blue btn-xs"><i class="icon-language-1"></i><?php echo T('Translate') ?></a>

            	<!-- DELETE FROM -->
            	<?php echo Form::open(array('action'=>URL('admin/language/management'), 'method'=>'POST', 'style'=>'display:inline')) ?>
            	<?php echo Form::hidden('action', 'delete') ?>
            	<?php echo Form::hidden('language', $l) ?>
            	<button type="submit" class="btn btn-red btn-xs" <?php echo $l == C('app.language') ? 'disabled' : '' ?>><i class="icon-cancel"></i><?php echo T('Delete') ?></button>
            	<?php echo Form::close() ?>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>
<div class="clearfix"><br /></div>
<div class="col-lg-12">
    <div class="alert alert-info">
        <strong><?php echo T('Question') ?>:</strong> <?php echo T('toggle_trans_ex1', 'The string I want to replace doesn\'t exist in translation language, what I have to do?') ?></a><br />
        <strong><?php echo T('Answer') ?>:</strong> <?php echo T('toggle_trans_ex2', 'Please turn string logger on (toggle button below), after that, surf your site, every line you see will be logged in the translation file and now you can translate anything you see. Remember to turn this off when you done to reduce page load time.') ?>
		<div class="clearfix"><br /></div>
		<?php echo Form::open(array('action'=>URL('admin/language/management'), 'method'=>'POST', 'style'=>'display:inline')) ?>
		<?php echo Form::hidden('action', 'toggle_translation') ?>
		<button type="submit" class="btn btn-red btn-xs"> <?php echo C('developer.translate') ? T('Turn off language string logger') : T('Turn on language string logger') ?></button>
		<?php echo Form::close() ?>
        <br /><br />
        <strong><?php echo T('Question') ?>:</strong> <?php echo T('toggle_trans_ex3', 'What is ...-slug mean?') ?></a><br />
        <strong><?php echo T('Answer') ?>:</strong> <?php echo T('toggle_trans_ex4', 'It\'s is translation string of URL slug like yoursite.com/news, "news" is news-slug, if string have suffix "-slug", remember not to use space') ?>

    </div>
	
</div>