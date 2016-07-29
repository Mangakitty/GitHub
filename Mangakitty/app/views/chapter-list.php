<div class="col-lg-12">
<div class="clearfix"><br /></div>
  <table class="table table-bordered">
    <tr>
      <td class="block" style="width:40px"><img src="<?php echo URL($thisManga['cover']) ?>" width="40px"></td>
      <td class="block"><a href="<?php echo URL('admin/management/manga/edit/'.$thisManga['slug']) ?>"><strong><?php echo $thisManga['name'] ?></strong></a><br />
      <a href="<?php echo URL('admin/management/chapter/'.$thisManga['slug']) ?>"><?php echo T('Chapter list') ?></a>
      </td>
      <td class="block">
        <a href="<?php echo URL('admin/management/chapter/'.$thisManga['slug'].'/new') ?>" class="btn btn-sm btn-blue"><i class="icon-plus"></i> <?php echo T('Add new chapter') ?></a>
      </td>
    </tr>
  </table>
  <br />
  <strong><?php echo T('Order by:') ?> </strong>
  <a href="<?php echo url_param(currentUrl(), array('order'=>'chapter')) ?>"><?php echo T('Chapter Numbering') ?></a> &middot; 
  <a href="<?php echo url_param(currentUrl(), array('order'=>'thetime')) ?>"><?php echo T('Newest First') ?></a> &middot; 
  <a href="<?php echo url_param(currentUrl(), array('order'=>'views')) ?>"><?php echo T('Most viewed') ?></a> &middot; 
  <a href="<?php echo url_param(currentUrl(), array('order'=>'comments'))?>"><?php echo T('Most commented') ?> </a>        
  <br />
  <strong><?php echo T('Order type:') ?> </strong>
  <a href="<?php echo url_param(currentUrl(), array('orderType'=>'ASC')) ?>"><?php echo T('ASC') ?></a> &middot; 
  <a href="<?php echo url_param(currentUrl(), array('orderType'=>'DESC')) ?>"><?php echo T('DESC') ?></a> &middot;

  <div class="clearfix"><br /></div>
  <?php echo Form::open(array('action'=>currentUrl('1'), 'method'=>'GET')) ?>
    <?php echo Form::input('q', '', array('class'=>'form-control', 'placeholder'=>'Type smth to search')) ?>
    <button class="btn btn-primary btn-sm" type="submit" style="  visibility: hidden;"></button>
  <?php echo Form::close() ?>
  <div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <?php foreach($chapters as &$chapter):  
          $chapter= event('do_chapter_info', $chapter);  ?>

          <tr>
            <td class="block" ><?php echo sprintf(T('Chapter %1s'), $chapter['chapter']) ?> <?php echo $chapter['name'] ?>
            <span class="pull-right"><a href="<?php echo URL('admin/management/comment/10/1?manga='.$chapter['manga'].'&chapter='.$chapter['chapter']) ?>"><?php echo $chapter['comments']. ' ' .T('Comment(s)') ?></a></span></td>
            <td class="block" width="20%">
              <div class="btn-group">
                <a href="<?php echo URL('admin/management/chapter/'.$thisManga['slug'].'/edit/'.$chapter['chapter']) ?>" class="btn btn-sm btn-info"><?php echo T('Edit') ?></a>
                <a href="<?php echo URL('admin/management/chapter/'.$thisManga['slug'].'/delete/'.$chapter['chapter']) ?>" class="btn btn-sm btn-danger"><?php echo T('Delete') ?></a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <div class="pull-left">
   <a href="<?php echo currentUrl('0') ?>" class="btn btn-sm btn-green"><?php echo T('Clear filters') ?></a>
   <a href="<?php echo URL('admin/system/maintenance') ?>" class="btn btn-sm btn-red"><?php echo T('Delete all chapters') ?></a>
  </div>
</div>