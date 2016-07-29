<div class="col-lg-12">
  <h3><?php echo T('In use') ?></h3>
  <div class="col-md-3 col-xs-6">
    <div href="#" class="thumbnail caption-overlay" style="margin-bottom: 0">
      <img src="<?php echo URL('app/themes/'.C('app.theme').'/thumbnail.png') ?>" class="img-responsive">
      <div class="caption">
        <h3><?php echo $themes[C('app.theme')]['name'] ?> <?php echo $themes[C('app.theme')]['version'] ?></h3>
        <p><?php echo $themes[C('app.theme')]['description'] ?> (<?php echo T('By') ?> <a href="<?php echo $themes[C('app.theme')]['authorURL'] ?>" target="_blank"><?php echo $themes[C('app.theme')]['author'] ?></a>)</p>
      </div>
    </div>
  </div>
  <?php unset($themes[C('app.theme')]); ?>
  <div class="clearfix"><br /></div>
  <h3><?php echo T('Available') ?></h3>
  <p><small><?php echo T('Click on theme title to active') ?> </small></p>
    <?php foreach($themes as $code=>$info): ?>
      <div class="col-md-3 col-xs-6">
        <div href="#" class="thumbnail caption-overlay" style="margin-bottom: 0">
          <img src="<?php echo URL('app/themes/'.$code.'/thumbnail.png') ?>" class="img-responsive">
          <div class="caption">
            <h3><a href="<?php echo URL('admin/theme/switch/'.$code) ?>"><?php echo $info['name'] ?> <?php echo $info['version'] ?></a></h3>
            <p><?php echo $info['description'] ?> (<?php echo T('By') ?> <a href="<?php echo $info['authorURL'] ?>" target="_blank"><?php echo $info['author'] ?></a>)</p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
