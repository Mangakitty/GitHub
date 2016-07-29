<div class="col-lg-12">
<div class="clearfix"><br /></div>
  <div class="table-responsive">
  	<table class="table table-hover">
        <tbody>
        <?php foreach($plugins as $code=>$info): ?>
          <tr>
            <td><?php if(file_exists($file = PLUGINS_DIR . "/$code/icon.png")) echo "<img src='".URL("app/plugins/$code/icon.png")."' width='16px' height='16px' style='vertical-align: baseline;'>" ?>
                <strong><?php echo $info['name']; ?></strong></td>
            <td width="60%"><?php echo $info['description']; ?></td>
            <td><a class="btn btn-xs btn-info btn-pop" data-container="body" data-toggle="popover" data-placement="left" data-html="true" 
                          data-content="<strong><?php echo T('Author') ?>:</strong> <?php echo $info['author'] ?> <a href='<?php echo $info['authorURL'] ?>' target='_blank'><i class='icon-home'></i></a><br />
                                        <strong><?php echo T('Version') ?>:</strong> <?php echo $info['version'] ?><br />
                                        <strong><?php echo T('License') ?>:</strong> <?php echo $info['license'] ?><br />
                                        " 
                          data-original-title="" title=""><i class="icon-info-circled"></i><?php echo T('Info') ?></a>
                <?php if($info['installed'] != '1'): ?>
            	  <a class="btn btn-xs btn-green" href="<?php echo URL('admin/plugin/install/'.$code); ?>"><i class="icon-install"></i> <?php echo T('Install'); ?></a>
                <?php elseif($info['installed'] == '1' && !in_array($code, C('app.enabledPlugins'))): ?>
                <a class="btn btn-xs btn-sky" href="<?php echo URL('admin/plugin/switch/'.$code); ?>"><?php echo T('Enable'); ?></a>
                <?php else: ?>
                <a class="btn btn-xs btn-red" href="<?php echo URL('admin/plugin/switch/'.$code); ?>"><?php echo T('Disable'); ?></a>  
                <?php endif; ?>   
                <?php if (isset($info['setting']) && in_array($code, C('app.enabledPlugins'))): ?><a class="btn btn-xs btn-yellow" href="<?php echo URL($info['setting']) ?>"><i class="icon-cog"></i> <?php echo T('Setting') ?></a><?php endif; ?>
                <?php if (!in_array($code, C('app.enabledPlugins')) && $info['installed'] == '1' && file_exists(PLUGINS_DIR . "/$code/uninstall.php")): ?><a class="btn btn-xs btn-red" href="<?php echo URL('admin/plugin/uninstall/'.$code); ?>"><i class="icon-off"></i> <?php echo T('Uninstall') ?></a><?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>
