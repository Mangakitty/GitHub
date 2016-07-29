<div class="col-lg-9 col-sm-12">
  <h3><?php echo sprintf(T('Edit Manga: %1s'), $thisManga['name']); ?></h3>
  <hr>
  <?php echo Form::open(array("action"=>currentUrl(),"class"=>"form-horizontal","role"=>"form")) ?>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Manga Name'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::input('name', $thisManga['name'], array("id"=>"inputName", "class"=>"form-control ")) ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Slug'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::input('slug', $thisManga['slug'], array("id"=>"inputSlug", "class"=>"form-control ", "required")) ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Alternative Name(s)'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::textarea('alternativeName', $thisManga['alternativeName'], array("class"=>"form-control ", "rows"=>'2')) ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Description'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::textarea('description', $thisManga['description'], array('id'=>'description',"class"=>"form-control ", "required", "rows"=>'3')) ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Cover'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::input('coverInput', $thisManga['coverInput'], array("type"=>"file", "id"=>"cover", "class"=>"form-control ")) ?>
        <?php echo Form::hidden('cover', '', array("id"=>"cover64", "class"=>"form-control ")) ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Manga Type'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::select('mangaType', $thisManga['mangaType'], array("1"=>T("Manga"), "2"=>T('Manhua'), "3"=>T('Manhwa'), "4"=>T('Comic')), array('class'=>'form-control')) ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Released Year'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::input('released', $thisManga['released'], array("class"=>"form-control ") ) ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Author(s)'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::input('author', $thisManga['author'], array("class"=>"form-control " ) ) ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Artist(s)'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::input('artist', $thisManga['artist'], array("class"=>"form-control ") ) ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Genre(s)'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::input('genre', $thisManga['genre'], array("class"=>"form-control ") ) ?>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Manga Status'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::select('mangaStatus', $thisManga['mangaStatus'], array("1"=>T("Complete"), "0"=>T('On Going'), "2"=>T('Dropped')), array('class'=>'form-control')) ?>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group">
      <div class="col-lg-offset-4 col-lg-8">
        <button type="submit" class="btn btn-primary btn-md"><?php echo T('Submit Changes');?></button>
      </div>
  </div>
</form>
</div>