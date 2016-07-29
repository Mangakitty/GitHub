<?php if (!defined("_WASD_")) exit; ?>
<?php echo Form::open(array('action'=>currentURL(), 'method'=>'POST')) ?>
<?php echo Form::hidden('action', 'translate') ?>
<div class="col-lg-12">      
<div class="clearfix"><br /></div>
    <div class="alert alert-info">
        <strong><?php echo T2up('Note') ?></strong> <?php echo T('toggle_trans_ex3', '%1s, %2s (and %..s) is variable, you can move them inside string but don\'t delete them.') ?><br>
    </div>
  <div class="table-responsive">
    <table class="table table-hover">
        <tbody>
            <tr>
                <td><?php echo T('Default/Explain') ?></td>
                <td><?php echo T('Translation') ?></td>
            </tr>
        <?php 
            $i = 0;
            foreach($definitions as $key=>$v):
            $i++;
        ?>
            <tr>
                <td><?php echo Form::input('translate['.$i.'][k]', $key, array('class'=>'form-control', 'readonly')) ?></td>
                <td><?php echo Form::input('translate['.$i.'][v]', $v, array('class'=>'form-control')) ?></td>
            </tr>
        <?php endforeach; ?>    
        </tbody>
    </table>
  </div>
</div>
<div class="clearfix"><br /></div>
<button class="btn btn-lg btn-green" style="position: fixed; bottom:20px; right:10px"><i class="icon-check"></i><?php echo T('Save changes') ?></button>
<?php echo Form::close() ?>
