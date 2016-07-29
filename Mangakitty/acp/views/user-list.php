<div class="col-lg-12">
<div class="clearfix"><br /></div>
  <?php echo T('Records per page:') ?> <a href="<?php echo url_param(currentUrl(), array('perPage'=>'5')) ?>">5</a> 
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'10')) ?>">10</a>
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'20')) ?>">20</a>
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'50')) ?>">50</a>
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'100')) ?>">100</a>
  <div class="table-responsive">
  	<table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th><?php echo T2up('Role'); ?></th>
            <th><?php echo T2up('Username'); ?></th>
            <th><?php echo T2up('Email'); ?></th>
            <th><?php echo T2up('Join date'); ?></th>
            <th><?php echo T2up('Register IP'); ?></th>
            <th><?php echo T2up('Actions'); ?></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($users as &$user): ?>
          <tr>
            <td><?php echo $user['userId']; ?></td>
            <td><a href="<?php echo currentUrl('0') ?>?role=<?php echo $user['role'] ?>"><?php echo $user['roleName']; ?></a></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo event('datetime', $user['joinDate']); ?></td>
            <td><a href="<?php echo currentUrl('0') ?>?ip=<?php echo $user['ip'] ?>"><?php echo long2ip($user['joinIP']); ?></a></td>
            <td><a class="btn btn-xs btn-info" href="<?php echo URL('admin/user/edit/'.$user['userId']); ?>"><i class="icon-wrench"></i> <?php echo T('Edit'); ?></a>
            	  <a class="btn btn-xs btn-danger" href="<?php echo URL('admin/user/delete/'.$user['userId']); ?>"><i class="icon-cancel-4"></i> <?php echo T('Delete'); ?></a>
            </td>
          </tr>
        <?php endforeach; ?>
          <tr>
            <td></td>
            <td></td>
            <td><form class="form-inline" role="form" method="GET">
                  <div class= "form-group">
                    <input type="text" class="form-control input-sm" name="username" placeholder="<?php echo T('Username') ?>">
                  </div>  
                <button type="submit" style="visibility: hidden;"></button>
              </form> 
            </td>
            <td><form class="form-inline" role="form" method="GET">
                  <div class= "form-group">
                    <input type="text" class="form-control input-sm" name="email" placeholder="<?php echo T('Email') ?>">
                  </div>  
                <button type="submit" style="visibility: hidden;"></button>
              </form> 
            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
    </table>
  </div>
<div class="clearfix"><br /></div>
  <div class="pull-right">
    <ul class="pagination blue">
      <?php echo printPaginator($p, $url, $params) ?>
    </ul>
  </div>
</div>
