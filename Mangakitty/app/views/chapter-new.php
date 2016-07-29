<div class="col-lg-9 col-sm-12">
  <h3><?php echo T('New Manga'); ?></h3>
  <hr>
  <?php echo Form::open(array("action"=>currentUrl(),"class"=>"form-horizontal","role"=>"form")) ?>
    <div class="form-group">
      <label class="col-lg-4 control-label"><?php echo T('Chapter number'); ?></label>
      <div class="col-lg-8">
        <?php echo Form::input('chapter', R('chapter'), array("id"=>"chapterNumber", "class"=>"form-control ")) ?>
      </div>
    </div>
    <div id="chapterInfoDiv" style="display:none">
      <div class="form-group">
        <label class="col-lg-4 control-label"><?php echo T('Name'); ?></label>
        <div class="col-lg-8">
          <?php echo Form::input('name', R('name'), array("class"=>"form-control ", "placeholder"=>T('Chapter\'s title (Optional)'))) ?>
        </div>
      </div>
      <div class="form-group">
        <label class="col-lg-4 control-label"><?php echo T('Content'); ?></label>
        <div class="col-lg-8">
          <?php echo Form::textarea('content', R('content'), array("id"=>"inputContent", "class"=>"form-control ", "rows"=>'9')) ?>
          <label><?php echo T('Seperated each image with ";", no line break or other seperator needed') ?></label><br />
          <strong><?php echo T('Image Uploader (Multiple select available)') ?></strong> 
		  <?php echo Form::input('uploaderInput', R('uploaderInput'), array("type"=>"file", "data-href"=>URL('admin/base64'), "data-dir"=>"upload/manga/".$thisManga['slug']."/", "id"=>"inputUploader", "class"=>"form-control ", "multiple")) ?>
		  <?php
			$dir = '/' . trim($thisManga['slug'], '/') . '/';
			$root = dirname(get_server_vars('SCRIPT_FILENAME')) ;
			echo '<script> var dir = "' . $dir . '";</script>';
			echo '<script> var phpmanga = "' . $root . '";</script>';
			include PLUGINS_DIR.'/jqupload/index.php'; 
			function get_server_vars($id) {
				return @$_SERVER[$id];
			}
			?>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group">
      <div class="col-lg-offset-4 col-lg-8">
        <button type="submit" class="btn btn-primary btn-md"><?php echo T('Submit');?></button>
      </div>
  </div>
</form>

    <br>
    <div class="col-lg-12 panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Jqupload Notes</h3>
        </div>
        <div class="panel-body">
            <ul>
                <li>Jqupload version 1.0</li>
                <li>Please fill the chapter number first before uploading.</li>
                <li>You can <strong>drag &amp; drop</strong> files from your desktop on this web page.</li>
                <li>You can use both of uploader button.</li>
                <li>Our Support email  <a href="yearimdangtk@gmail.com">yearimdangtk@gmail.com</a></li>
            </ul>
        </div>
    </div>