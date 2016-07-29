<div class="col-lg-12">
<div class="clearfix"><br /></div>
  <h4><?php echo T2up('manga list') ?></h4>
  <br />
  <a href="<?php echo URL('admin/management/manga/new') ?>" class="btn btn-sm btn-blue"><i class="icon-plus"></i> <?php echo T('Add new series') ?></a>
  <br /><br />
  <?php echo T('Records per page:') ?> <a href="<?php echo url_param(currentUrl(), array('perPage'=>'5')) ?>">5</a> 
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'10')) ?>">10</a>
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'20')) ?>">20</a>
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'50')) ?>">50</a>
                                       <a href="<?php echo url_param(currentUrl(), array('perPage'=>'100')) ?>">100</a>     
  <br />
  <strong><?php echo T('Order by:') ?> </strong>
  <a href="<?php echo url_param(currentUrl(), array('order'=>'name')) ?>"><?php echo T('Name') ?></a> &middot; 
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
        <?php foreach($mangas as &$manga):  

          $manga = event('do_manga_info', $manga);  ?>
          <tr>
            <td class="block" style="width:40px"><img src="<?php echo URL($manga['cover']) ?>" width="40px"></td>
            <td class="block"><a href="<?php echo URL('admin/management/manga/edit/'.$manga['slug']) ?>"><strong><?php echo $manga['name'] ?></strong></a><br />
            <a href="<?php echo URL('admin/management/chapter/'.$manga['slug']) ?>"><?php echo T('Chapter list') ?></a> &middot; 
            <a href="<?php echo URL('admin/management/comment/10/1?manga='.$manga['mangaId']) ?>"><?php echo $manga['comments'].' '.T('Comment(s)') ?></a> 
            </td>
            <td class="block">
              <div class="btn-group">
                <a href="<?php echo URL('admin/management/manga/edit/'.$manga['slug']) ?>" class="btn btn-sm btn-info"><?php echo T('Edit') ?></a>
                <a href="<?php echo URL('admin/management/manga/delete/'.$manga['slug']) ?>" class="btn btn-sm btn-danger"><?php echo T('Delete') ?></a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <div class="pull-left">
   <a href="<?php echo currentUrl('0') ?>" class="btn btn-sm btn-green"><?php echo T('Clear filters') ?></a>
   <a href="<?php echo URL('admin/system/maintenance') ?>" class="btn btn-sm btn-red"><?php echo T('Delete all mangas') ?></a>
  </div>
  <div class="pull-right">
    <ul class="pagination blue">
      <?php echo printPaginator($p, $url, $params) ?>
    </ul>
  </div>
</div>