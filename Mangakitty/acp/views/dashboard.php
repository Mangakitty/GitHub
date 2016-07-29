<div class="col-lg-12">
<?php echo event('admin_dashboard', $return) ?>
<div class="clearfix"><br /></div>
  <h4><?php echo T2up('Logged administrator actions') ?></h4>
  <p><?php echo T('This gives an overview of the last ten actions carried out by administrators.') ?> 
     <a href="<?php echo URL('admin/system/admin-log') ?>"><?php echo T('View all') ?></a></p>
  <div class="table-responsive">
  	<table class="table table-hover">
        <thead>
          <tr>
            <th><?php echo T2up('Username'); ?></th>
            <th><?php echo T2up('IP'); ?></th>
            <th><?php echo T2up('Time'); ?></th>
            <th><?php echo T2up('Actions'); ?></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($adminLog as &$log): ?>
          <tr>
            <td><?php echo $log['username']; ?></td>
            <td><?php echo long2ip($log['ip']); ?></td>
            <td><?php echo event('datetime', $log['theTime']); ?></td>
            <td><?php echo $log['string']; ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
<?php echo event('admin_dashboard_after', $return) ?>
</div>