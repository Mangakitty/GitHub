<?php if (!defined("_WASD_")) exit; ?>

<div class="col-lg-11 col-sm-12" style="margin-left: 10px;">
	<?php echo Form::open(array("action"=>"admin/settings/customization","class"=>"form-horizontal","role"=>"form")) ?>
	  <input type="hidden" name="action" value="update">

	 <ul id="myTab" class="nav nav-tabs nav-justified">
      <li class="active"><a href="#cssjs" data-toggle="tab">Css & Js</a></li>
      <li><a href="#topheader" data-toggle="tab">Top Header</a></li>
      <li><a href="#menu" data-toggle="tab">Menu (Navigator)</a></li>
      <li><a href="#ads" data-toggle="tab">Ads Space</a></li>
      <li><a href="#sidebar" data-toggle="tab">Sidebar</a></li>
      <li><a href="#footer" data-toggle="tab">Footer</a></li>
      <li class="dropdown">
        <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Content <b class="caret"></b></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
          <li><a href="#homecontent" tabindex="-1" data-toggle="tab">Home content (Index Page)</a></li>
          <li><a href="#directorycontent" tabindex="-1" data-toggle="tab">Directory Page Content</a></li>
          <li><a href="#singlemangacontent" tabindex="-1" data-toggle="tab">Single Manga Page Content</a></li>
          <li><a href="#singlechaptercontent" tabindex="-1" data-toggle="tab">Chapter Reading Page Content</a></li>
        </ul>                    
      </li>
    </ul>
	<div id="myTabContent" class="tab-content">
 		<div class="tab-pane fade in active" id="cssjs">
		  <h2>JS & Css</h2>
		  <hr>
		  <div class="form-group">
		    <label class="control-label"><?php echo T('Custom CSS'); ?></label>
		    <div>
		      <?php echo Form::textarea('customCss', C('app.customCss'), array("class"=>"form-control editor", "rows"=>"5")) ?>
		      <?php echo T('Custom Css for your website (all page)') ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label"><?php echo T('Custom Js'); ?></label>
		    <div>
		      <?php echo Form::textarea('customJs', C('app.customJs'), array("class"=>"form-control editor", "rows"=>"5")) ?>
		      <?php echo T('Custom Javascript for your website (all page, no open/close tag required)') ?><br />
		      <strong><?php echo T('Available Shortcodes:') ?></strong> [analytic id=""]
		    </div>
		  </div>
		</div>


 		<div class="tab-pane fade in" id="topheader">
		  <h2>Top header</h2>
		  <hr>
		  <div class="form-group">
		    <label class="control-label"><?php echo T('Header brand'); ?></label>
		    <div>
		      	<?php echo Form::textarea('headerBrand', C('app.headerBrand'), array("class"=>"form-control editor", "rows"=>"5")) ?>
		        <?php echo T('Header Brand, html is allowed') ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <div>
		       <div class="panel panel-invert inverse">
		          <div class="panel-heading">
		            <h3 class="panel-title"><?php echo T('Menu') ?> &middot; <?php echo T('Applied for home, directory and single manga page') ?></h3>
		          </div>
		          <div class="panel-body" style='padding:0px'>
		      		<?php echo Form::textarea('menu', C('app.menu', "[link title='Huykhong' url='http://huykhong.com']"), array("class"=>"form-control", "rows"=>"10")) ?>
		          </div>
		          <div class="panel-footer menu-shortcodes">
		          	<?php echo T('Available shortcodes:') ?><br />
		          	[home title="Home"]<br /> 
		          	[dropdown name="Click to drop menu" url="link1|link2|link3" title="title1|title2|title3"]<br />
		          	[link title="Google" url="http://google.com"] (optional: class="" and id="")
	 	          </div>
		        </div>
		    </div>
		  </div>
		</div>

		<div class="tab-pane fade in" id="homecontent">
		  <h2><?php echo T('Home page') ?></h2>
		  <div class="form-group">
		    <div>
		       <div class="panel panel-invert inverse">
		          <div class="panel-heading">
		            <h3 class="panel-title"><?php echo T('Home Content') ?></h3>
		          </div>
		          <div class="panel-body" style='padding:0px'>
		      		<?php echo Form::textarea('homeContent', C('app.homeContent', "[link title='Huykhong' url='http://huykhong.com']"), array("class"=>"form-control", "rows"=>"10")) ?>
		          </div>
		          <div class="panel-footer menu-shortcodes">
		          	<?php echo T('Available shortcodes:') ?><br /> 
		          	[latest-manga title="Header (Optional)" quantity="10"]<br />
		          	[latest-manga2 title="Header (Optional)" quantity="30"] 
	 	          </div>
		        </div>
		    </div>
		  </div>
	  	</div>

	  	<div class="tab-pane fade in" id="directorycontent">
		  <h2><?php echo T('Directory page') ?></h2>
		  <div class="form-group">
		    <div>
		       <div class="panel panel-invert inverse">
		          <div class="panel-heading">
		            <h3 class="panel-title"><?php echo T('Listing Directory Page Content') ?></h3>
		          </div>
		          <div class="panel-body" style='padding:0px'>
		      		<?php echo Form::textarea('directoryContent', C('app.directoryContent', "[listing per-page='20' default-sorting='name'] "), array("class"=>"form-control", "rows"=>"10")) ?>
		          </div>
		          <div class="panel-footer menu-shortcodes">
		          	<?php echo T('Available shortcodes:') ?><br /> 
		          	[listing default="text" perPage="30" choosable="yes" default-sorting="name"] <br />
		          	<strong>Options:</strong><br /> 
		          	<strong>default</strong> => Set default type will be show, text (a -> z) or paging (from page 1), <br />
		          	<strong>perPage</strong> => item per page if choose paging,<br /> 
		          	<strong>choosable</strong> => is yes if allow user to choose other type instead of default<br />
		          	<strong>default-sorting</strong> => As default is sorting by "name", "latsUpdate", "views"
		          	<strong>default-sorting-type</strong> => ASC or DESC

	 	          </div>
		        </div>
		    </div>
		  </div>
	  	</div>

	  	<div class="tab-pane fade in" id="singlemangacontent">
		  <h2><?php echo T('Single manga page') ?></h2>
		  <div class="form-group">
		    <div>
		       <div class="panel panel-invert inverse">
		          <div class="panel-heading">
		            <h3 class="panel-title"><?php echo T('Single Manga Content') ?></h3>
		          </div>
		          <div class="panel-body" style='padding:0px'>
		      		<?php echo Form::textarea('mangaContent', C('app.mangaContent', "[mangainfo]"), array("class"=>"form-control", "rows"=>"10")) ?>
		          </div>
		          <div class="panel-footer menu-shortcodes">
		          	<?php echo T('Available shortcodes:') ?><br /> 
		          	[manga-info]<br />
		          	[manga-chapter-list] <br />
		          	[fb-comment appId="733659116654232" quantity="15" color="light"] => Add facebook comments box, insert your appId to moderate comments, color is light or dark only, quantity is number of comments are show
	 	          </div>
		        </div>
		    </div>
		  </div>
		</div>

		<div class="tab-pane fade in" id="singlechaptercontent">
		  <h2><?php echo T('Single chapter page') ?></h2>
		  <div class="form-group">
		    <div>
		       <div class="panel panel-invert inverse">
		          <div class="panel-heading">
		            <h3 class="panel-title"><?php echo T('Single Chapter Content') ?></h3>
		          </div>
		          <div class="panel-body" style='padding:0px'>
		      		<?php echo Form::textarea('chapterContent', C('app.chapterContent', "[read type='webtoon']"), array("class"=>"form-control", "rows"=>"10")) ?>
		          </div>
		          <div class="panel-footer menu-shortcodes">
		          	<?php echo T('Available shortcodes:') ?><br /> 
		          	[read-webtoon] => Chapter image display, all image in one page<br />
		          	[read-pbp] => Chapter image display, page by page<br />
		          	[select-page style='align:center (optional)'] => This is for Page by page reading type only<br />
		          	[select-chapter style='align:center (optional)'] <br />
		          	[fb-comment appId="733659116654232" quantity="15" color="light"] => Add facebook comments box, insert your appId to moderate comments, color is light or dark only, quantity is number of comments are show
	 	          </div>
		        </div>
		    </div>
		  </div>
		</div>

		<div class="tab-pane fade in" id="menu">
		  <div class="form-group">
		    <div>
		       <div class="panel panel-invert inverse">
		          <div class="panel-heading">
		            <h3 class="panel-title"><?php echo T('Menu') ?> &middot; <?php echo T('Applied for single chapter page only') ?></h3>
		          </div>
		          <div class="panel-body" style='padding:0px'>
		      		<?php echo Form::textarea('chapterMenu', C('app.chapterMenu', "[home title='Back 2 home']"), array("class"=>"form-control", "rows"=>"10")) ?>
		          </div>
		          <div class="panel-footer menu-shortcodes">
		          	<?php echo T('Available shortcodes:') ?><br /> 
		          	[home title="Back 2 home (Optional)"]<br />
		          	[dropdown name="Click to drop menu" url="link1|link2|link3" title="title1|title2|title3"]<br />
		          	[link title="Google" url="http://google.com"] (optional: class="" and id="")
	 	          </div>
		        </div>
		    </div>
		  </div>
	  	</div>

	  	<div class="tab-pane fade in" id="ads">
		  <div class="form-group">
		    <label class="control-label"><?php echo T('Ads space 1'); ?></label>
		    <div>
		      <?php echo Form::textarea('ads1', C('app.ads1'), array("class"=>"form-control editor", "rows"=>"5")) ?>
		      <?php echo T('Ad space on top right of the website') ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label"><?php echo T('Ads space 2'); ?></label>
		    <div>
		      <?php echo Form::textarea('ads2', C('app.ads2'), array("class"=>"form-control editor", "rows"=>"5")) ?>
		      <?php echo T('Ad space after navigator') ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label"><?php echo T('Ads space 3'); ?></label>
		    <div>
		      <?php echo Form::textarea('ads3', C('app.ads3'), array("class"=>"form-control editor", "rows"=>"5")) ?>
		      <?php echo T('Ad space above footer') ?>
		    </div>
		  </div>
		</div>

		<div class="tab-pane fade in" id="sidebar">
		  <div class="form-group">
		    <div>
		       <div class="panel panel-invert inverse">
		          <div class="panel-heading">
		            <h3 class="panel-title"><i class="fa fa-bookmark"></i> <?php echo T('Right sidebar, html is allowed') ?></h3>
		          </div>
		          <div class="panel-body" style='padding:0px'>
		      		<?php echo Form::textarea('widget', C('app.widget'), array("class"=>"form-control editor", "rows"=>"10")) ?>
		          </div>
		          <div class="panel-footer"><?php echo T('Available shortcodes:') ?><br /> 
		            <strong>[search-box]</strong><br />
					=> Simple search box<br />
		            <strong>[manga-cover]</strong><br />
					=> This will show manga cover (for single manga page only)<br />
		            <strong>[listing-sidebar]</strong><br />
					=> Show listing option (directory page only)<br />
		            <strong>[manga-list] and [manga-list2]</strong><br />
					=> Show manga list by custom sorting, options:
					<ul>
						<li>Title: Widget title (Optional)</li>
						<li>sorting: Which type of sorting will manga affected in this widget (name, views, lastUpdate)</li>
						<li>order: ASC or DESC</li>
						<li>quantity: number of items</li>
					</ul>
					<strong>[fb-like-box]</strong><br />
					=> Show facebook like box, options:
					<ul>
						<li>url: your facebook fanpage url</li>
						<li>height: widget's heigth, width is auto so you don't need to set</li>
						<li>show_faces: true or false (show people who also liked)</li>
						<li>header: true or false (header bar of widget)</li>
						<li>stream: Show stream (posts) of your page in widget</li>
						<li>show_border: true or false, show border of widget</li>
					</ul>
		        </div>
		    </div>
		  </div>
		 </div>
		</div>

		<div class="tab-pane fade in" id="footer">
		  <div class="form-group">
		    <label class="control-label"><?php echo T('Footer Left'); ?></label>
		    <div>
		      	<?php echo Form::textarea('footerLeft', C('app.footerLeft'), array("class"=>"form-control editor", "rows"=>"5")) ?>
		        <?php echo T('Footer left, html is allowed') ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label"><?php echo T('Footer Right'); ?></label>
		    <div>
		      	<?php echo Form::textarea('footerRight', C('app.footerRight'), array("class"=>"form-control editor", "rows"=>"5")) ?>
		      	<?php echo T('Footer right, html is allowed') ?>
		    </div>
		  </div>
		</div>

	  <div class="clearfix"></div>
	  <div class="form-group">
	    <div class="col-lg-offset-4 col-lg-8">
	      <button type="submit" class="btn btn-primary btn-md"><?php echo T('Save changes');?></button>
	    </div>
  </div>
	</div>

	</form>
</div>