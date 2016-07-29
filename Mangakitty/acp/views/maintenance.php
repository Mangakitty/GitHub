<div class="col-lg-12">
<div class="clearfix"><br /></div>
  <div class="alert red">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon-warning-empty"></i> <?php echo T('Be careful with all the actions in this page!') ?>
  </div>
  <div class="table-responsive">
  	<table class="table table-hover">
        <tbody>
        	<tr>
	        	<td>
					<strong><?php echo T('Delete all users') ?></strong><br />
					<?php echo T('Delete all user in database but keep the 1st user') ?>
				</td>
				<td><form method="POST"><input type="hidden" name="action" value="delete-user"><button class="btn btn-yellow btn-small" type="submit"><?php echo T('RUN NOW') ?></button></form></td>
			</tr>
        	<tr>
	        	<td>
					<strong><?php echo T('Purge all sessions') ?></strong><br />
					<?php echo T('Purge all sessions. This will log out all users (except you) by truncating the session table.') ?>
				</td>
				<td><form method="POST"><input type="hidden" name="action" value="clear-session"><button class="btn btn-yellow btn-small" type="submit"><?php echo T('RUN NOW') ?></button></form></td>
			</tr>
        	<tr>
	        	<td>
					<strong><?php echo T('Reset website\'s start date') ?></strong><br />
					<?php echo sprintf(T('Your website\'s start date is %1s'), '<span class="label blue">'.C('app.startDate').'</span>') ?>
				</td>
				<td><form method="POST"><input type="hidden" name="action" value="start-date"><button class="btn btn-yellow btn-small" type="submit"><?php echo T('RUN NOW') ?></button></form></td>
			</tr>
			<?php echo event('maintenance', $return) ?>
        </tbody>
    </table>
  </div>
</div>
