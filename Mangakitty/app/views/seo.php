<div class="col-lg-9 col-sm-12" style="padding-left: 10px;">
	<h3><?php echo T('Search engine optimization'); ?></h3>
	<span><?php echo T('Lowest Level SEO Options: Meta tags') ?></span>
	<hr>
	<ul id="myTab" class="nav nav-tabs nav-justified">
      <li class="active"><a href="#home" data-toggle="tab"><?php echo T('Home Page') ?></a></li>
      <li><a href="#directory" data-toggle="tab"><?php echo T('Directory Page') ?></a></li>
      <li><a href="#manga" data-toggle="tab"><?php echo T('Single Manga Page') ?></a></li>
      <li><a href="#chapter" data-toggle="tab"><?php echo T('Single Chapter Page') ?></a></li>
    </ul>

	<?php echo Form::open(array("action"=>"admin/settings/seo","class"=>"form-horizontal","role"=>"form")) ?>
	  <input type="hidden" name="action" value="update">
	<div id="myTabContent" class="tab-content">
 		<div class="tab-pane fade in active" id="home">
		  <div class="alert alert-info"><?php echo T('Available shortcode:') ?> 
		  	{homeTitle}
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Title tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('homeTitle', C('app.homeTitle'), array("class"=>"form-control ")) ?>
		      <br />
		    </div>
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Description tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('homeDescription', C('app.homeDescription'), array("class"=>"form-control ")) ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Keyword tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('homeKeywords', C('app.homeKeywords'), array("class"=>"form-control ")) ?>
		    </div>
		  </div>
		</div>


	  <!-- --------------------------------------------------------------------------------------------

	   ------------------------------------------------------------------------------------------------ !-->
	  	<div class="tab-pane fade in" id="directory">
		  <div class="alert alert-info"><?php echo T('Available shortcode:') ?> 
		  	{homeTitle}, {page}
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Title tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('directoryTitle', C('app.directoryTitle'), array("class"=>"form-control ")) ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Description tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('directoryDescription', C('app.directoryDescription'), array("class"=>"form-control ")) ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Keyword tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('directoryKeywords', C('app.directoryKeywords'), array("class"=>"form-control ")) ?>
		    </div>
		  </div>
		</div>


		<div class="tab-pane fade in" id="manga">
		  <div class="alert alert-info"><?php echo T('Available shortcode:') ?> 
		  	{homeTitle}, {name}, {alternativeName}, {author}, {artist}, {genre}, {lastChapter}<br />{released} (released Year, eg. 1993), {mangaType} (Manga, Manhua, etc)
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Title tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('mangaTitle', C('app.mangaTitle'), array("class"=>"form-control ")) ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Description tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('mangaDescription', C('app.mangaDescription'), array("class"=>"form-control ")) ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Keyword tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('mangaKeywords', C('app.mangaKeywords'), array("class"=>"form-control ")) ?>
		    </div>
		  </div>
		</div>

		<div class="tab-pane fade in" id="chapter">
		  <div class="alert alert-info"><?php echo T('Available shortcode:') ?> 
		  	{homeTitle}, {name} (Manga Name), {alternativeName}, {author}, {artist}, {genre}<br />{released} (released Year, eg. 1993), {mangaType} (Manga, Manhua, etc)
		  	<br />
		  	{chapterNumber}, {chapterName}
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Title tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('chapterTitle', C('app.chapterTitle'), array("class"=>"form-control ")) ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Description tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('chapterDescription', C('app.chapterDescription'), array("class"=>"form-control ")) ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <span class="col-lg-12"><strong><?php echo T('Keyword tag'); ?></strong></span>
		    <div class="col-lg-12">
		      <?php echo Form::input('chapterKeywords', C('app.chapterKeywords'), array("class"=>"form-control ")) ?>
		    </div>
		  </div>
		</div>

	</div>

	  <div class="clearfix"></div>
	  <div class="form-group">
	    <div class="col-lg-offset-4 col-lg-8">
	      <button type="submit" class="btn btn-primary btn-md"><?php echo T('Save changes');?></button>
	    </div>
  </div>
</form>
</div>