<div class="col-lg-offset-1 col-lg-6">
	<h3><?php echo T('Manage User Role'); ?></h3>
	<hr>
	<table class="table">
      <tbody>
      	<?php foreach ($roles as $id => $role): ?>
	        <tr>
	          <td><?php echo $role['name'] ?></td>
	          <td style="text-align: right;">
	          	  <form class="form-horizontal" role="form" method="POST">	
	          	  	<input type="hidden" name="action" value="delete">
	          	  	<input type="hidden" name="roleId" value="<?php echo $id ?>">
	          	  	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit-role-<?php echo $id ?>"><i class="icon-edit"></i></button>
	          	  	<button type="submit" <?php echo (in_array($id, array('1','2'))) ? 'disabled' :'' ?> class="btn btn-red"><i class="icon-trash"></i></button>
	          	   </form>
	          </td>
	        </tr>
      	<?php endforeach ?>
      </tbody>
    </table>
    <button class="btn btn-green" data-toggle="modal" data-target="#new-role-modal"><i class="icon-plus"></i> <?php echo T('Add new Role') ?></button>
</div>


<!-- ADD NEW ROLE MODEL -->
<div id="new-role-modal" class="modal fade scale-effect" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	      <h4 class="modal-title" id="newRoleModalLabel"><?php echo T('New Role') ?></h4>
	    </div>
	    <div class="modal-body">
            <form class="form-horizontal" role="form" method="POST">
              <input type="hidden" name="action" value="new_role">
              <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo T('Role Name') ?></label>
                <div class="col-sm-8">
                  <input type="text" name="name" class="form-control" placeholder="<?php echo T('Customer') ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo T('Global permissions') ?></label>
                <div class="col-sm-8">
                	<?php echo T('Is this group MASTER ADMIN?') ?>
                   <div class="radio-inline">
                        <label>
                          <input type="radio" name="permissions[master_admin]" value="1" <?php echo $role['permissions']['master_admin'] == '1' ? 'checked="checked"' : '' ?>>
                          <?php echo T('Yes') ?>
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                          <input type="radio" name="permissions[master_admin]" value="0" <?php echo $role['permissions']['master_admin'] == '0' ? 'checked="checked"' : '' ?>>
                          <?php echo T('No') ?>
                        </label>
                    </div>
                </div>
              </div>
              <?php $return = event('user_role_form', array('roles'=>$roles, 'role'=>$role, 'return'=>'')); echo $return['return'];  ?>
              <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-8">
               		<button class="btn btn-green"><?php echo T('Save changes') ?></button>
                </div>
              </div>
            </form>
	    </div>
	  </div>
	</div>
</div>


<!-- EDIT ROLE MODEL -->
<?php foreach ($roles as $id => $role): ?>
<div id="edit-role-<?php echo $id ?>" class="modal fade scale-effect" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-body">
            <form class="form-horizontal" role="form" method="POST">
              <input type="hidden" name="action" value="edit_role">
              <input type="hidden" name="roleId" value="<?php echo $id ?>">
              <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo T('Role Name') ?></label>
                <div class="col-sm-8">
                  <input type="text" name="name" class="form-control" placeholder="<?php echo T('Customer') ?>" value="<?php echo $role['name'] ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo T('Global permissions') ?></label>
                <div class="col-sm-8">
                	<?php echo T('Is MASTER ADMIN?') ?>
                   <div class="radio-inline">
                        <label>
                          <input type="radio" name="permissions[master_admin]" value="1" <?php echo $role['permissions']['master_admin'] == '1' ? 'checked="checked"' : '' ?>>
                          <?php echo T('Yes') ?>
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label>
                          <input type="radio" name="permissions[master_admin]" value="0" <?php echo $role['permissions']['master_admin'] == '0' ? 'checked="checked"' : '' ?>>
                          <?php echo T('No') ?>
                        </label>
                    </div>
                </div>
              </div>
              <?php  $return = event('user_role_form', array('roles'=>$roles, 'role'=>$role, 'return'=>'')); echo $return['return']; ?>
              <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-8">
               		<button class="btn btn-green"><?php echo T('Save changes') ?></button>
               		<button class="btn" data-dismiss="modal"><?php echo T('Cancel') ?></button>
                </div>
              </div>
            </form>
	    </div>
	  </div>
	</div>
</div>
<?php endforeach; ?>