<div class="col-lg-12">
<div class="clearfix"><br /></div>
  <h4><?php echo T2up('Logged administrator actions') ?></h4>
  <?php echo T('Records per page:') ?> <a href="<?php echo url_param(currentUrl(), array('perPage'=>'5')) ?>">5</a> 
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'10')) ?>">10</a>
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'20')) ?>">20</a>
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'50')) ?>">50</a>
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'100')) ?>">100</a>



  <div class="clearfix"><br /></div>
  <div class="table-responsive">
    <table class="table table-hover">
        <thead>
          <tr>
            <th><?php echo T2up('Username'); ?></th>
            <th><?php echo T2up('User IP'); ?></th>
            <th><?php echo T2up('Time'); ?></th>
            <th><?php echo T2up('Actions'); ?></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($adminLog as &$log): ?>
          <tr>
            <td><a href="<?php echo currentUrl('0') ?>?id=<?php echo $log['adminId'] ?>"><?php echo $log['username']; ?></a></td>
            <td><a href="<?php echo currentUrl('0') ?>?ip=<?php echo $log['ip'] ?>"><?php echo long2ip($log['ip']); ?></a></td>
            <td><?php echo event('datetime', $log['theTime']); ?></td>
            <td><?php echo $log['string']; ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <div class="pull-left">
   <form class="form-inline" role="form" method="GET">
      <div class="form-group">
        <label for="inputAction"><?php echo T('Filter by action:') ?> </label>
        <input type="text" class="form-control input-sm" name="action" id="inputAction" placeholder="<?php echo T('Login') ?>">
      </div>
      <button type="submit" class="btn btn-default btn-sm"><?php echo T('Submit') ?></button>
    </form>   
  </div>
  <div class="pull-right">
    <ul class="pagination blue">
      <?php echo printPaginator($p, $url, $params) ?>
    </ul>
  </div>
</div>