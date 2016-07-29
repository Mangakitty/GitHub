<div class="col-lg-9 col-sm-12">
  <h3><?php echo T('New Manga'); ?></h3>
  <hr>
  <?php echo Form::open(array("action"=>currentUrl(),"class"=>"form-horizontal","role"=>"form")) ?>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Chapter number'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::input('chapter', $thisChapter['chapter'], array("id"=>"chapterNumber", "class"=>"form-control ")) ?>
      </div>
    </div>
    <div id="chapterInfoDiv">
      <div class="form-group">
        <label class="col-lg-4 control-label"><?php echo T('Name'); ?></label>
        <div class="col-lg-8">
          <?php echo Form::input('name', $thisChapter['name'], array("class"=>"form-control ", "placeholder"=>T('Chapter\'s title (Optional)'))) ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-4 control-label"><?php echo T('Content'); ?></label>
        <div class="col-lg-8">
          <?php echo Form::textarea('content', $thisChapter['content'], array("id"=>"inputContent", "class"=>"form-control ", "rows"=>'9')) ?>
          <label><?php echo T('Seperated each image with ";", no line break or other seperator needed') ?></label><br />
          <strong><?php echo T('Image Uploader (Multiple select available)') ?></strong> <?php echo Form::input('uploaderInput', '', array("type"=>"file", "data-href"=>URL('admin/base64'), "data-dir"=>"upload/manga/".$thisManga['slug']."/", "id"=>"inputUploader", "class"=>"form-control ", "multiple")) ?>
         
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group">
      <div class="col-lg-offset-4 col-lg-8">
        <button type="submit" class="btn btn-primary btn-md"><?php echo T('Submit changes');?></button>
      </div>
  </div>
</form>
</div>