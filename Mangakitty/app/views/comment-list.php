<div class="col-lg-12">
<div class="clearfix"><br /></div>
  <h4><?php echo T2up('comment list') ?></h4>
  <?php echo T('Records per page:') ?> <a href="<?php echo URL('admin/management/comment/5/1') ?>">5</a> 
                                       <a href="<?php echo URL('admin/management/comment/10/1') ?>">10</a>
                                       <a href="<?php echo URL('admin/management/comment/30/1') ?>">30</a> 
                                       <a href="<?php echo URL('admin/management/comment/50/1') ?>">50</a>                       
  <div class="clearfix"><br /></div>
  <?php echo Form::open(array('action'=>currentUrl('1'), 'method'=>'GET')) ?>
  	<?php echo Form::input('q', '', array('class'=>'form-control', 'placeholder'=>'Type smth to search')) ?>
  	<button class="btn btn-primary btn-sm" type="submit" style="  visibility: hidden;"></button>
  <?php echo Form::close() ?>
  <div class="pull-right">
    <button class="btn btn-red btn-delete-selected disabled"><?php echo T('Delete selected') ?></button>
    <?php echo Form::open(array('action'=>currentURL(), 'style'=>'display:inline', 'id'=>'delete-selected'));
            echo Form::hidden('action', 'delete-selected');
            echo Form::hidden('comment', '', array('class'=>'comment-selected'));
          echo Form::close(); ?>
  </div>
  <div class="clearfix"><br /><br /></div>
  <div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <?php foreach($comments as &$cm):  
                $author = Mangauser::findFirst(array('userId'=>$cm['author']));              
                $manga = Manga::findFirst(array('mangaId'=>$cm['manga']));          
                $chapter = Chapter::findFirst(array('chapterId'=>$cm['chapter']));                
        ?>
          <tr <?php echo ($cm['moderated'] == '0') ? 'class="danger"' : '' ?>>
            <td><?php echo Form::checkbox('delete[]', $cm['commentId'], array('class'=>'form-control cbox')); ?></td>
            <td><strong><a href="<?php echo url_param(currentUrl(), array('manga'=>$manga['mangaId'] )) ?>"><?php echo $manga['name'] ?></a> 
                <?php if($chapter['chapter'] != ''):  ?>
                  <a href="<?php echo url_param(currentUrl(), array('manga'=>$manga['mangaId'], 'chapter'=>$chapter['chapterId'] )) ?>"><?php echo $chapter['chapter'] ?></a> 
                <?php endif; ?>
                </strong>
            <br />
            <p><?php echo $cm['content'] ?></p>
            <br /><small><?php echo T('By') ?> <img src="<?php echo URL($author['preferences']['avatar']) ?>" style="width:32px; height:auto"> 
                        <strong><a href="<?php echo url_param(currentUrl(), array('author'=>$author['userId'] )) ?>"><?php echo $author['username']; ?></a></strong> 
                        <?php echo ago($cm['thetime']); ?> <?php echo long2ip($cm['ip']) != '0.0.0.0' ? '&middot; '.long2ip($cm['ip']) : '' ?></small></td>
            <td>
            <?php 
              if ($cm['moderated'] == '0'){
                echo Form::open(array('action'=>currentURL(), 'style'=>'display:inline'));
                  echo Form::hidden('action', 'approve');
                  echo Form::hidden('commentId', $cm['commentId']);
                  echo Form::button('submit', T('Approve'), array('class'=>'btn btn-green btn-sm'));
                echo Form::close();
              }
            ?>
            <?php 
                echo Form::open(array('action'=>currentURL(), 'style'=>'display:inline'));
                  echo Form::hidden('action', 'delete');                  
                  echo Form::hidden('commentId', $cm['commentId']);
                  echo "<button class='btn btn-red btn-sm btn-delete' type='button'>Delete</button>";
                  echo Form::button('submit', T('Are you sure?'), array('class'=>'btn btn-red btn-sm btn-confirm', 'style'=>'display:none'));
                echo Form::close();
            ?>
            <a href="<?php echo URL('admin/management/comment/edit/'.$cm['commentId']) ?>" class="btn btn-inverse btn-sm"><?php echo T('Edit') ?></a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <div class="pull-left">
   <a href="<?php echo currentUrl('0') ?>" class="btn btn-sm btn-green"><?php echo T('Clear filters') ?></a>
   <a href="<?php echo URL('admin/system/maintenance') ?>" class="btn btn-sm btn-red"><?php echo T('Delete all comments') ?></a>
  </div>
  <div class="pull-right">
    <ul class="pagination blue">
      <?php echo printPaginator($p, $url, $params) ?>
    </ul>
  </div>
</div>