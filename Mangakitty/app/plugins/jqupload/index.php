	<?php 
	if (!defined("_WASD_")) {
		echo '<br />HOME PAGE: http://codecanyon.net/user/Aincrad?ref=Aincrad' . '<br />PORTOFOLIO: http://codecanyon.net/user/Aincrad/portfolio?ref=Aincrad' . '<br />email: yearimdangtk@gmail.com' . '<br /><br />';
			include "index.html";
		exit; 	
	}

	?>
    <br>
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select manga image files / drag &amp; drop on this webpage </span>
        <!-- The file input field used as target for the file upload widget -->
		<!--
		<input class="btn btn-success fileinput-button" id="fileupload" type="file" name="files[]" data-url="../../../../app/plugins/jqupload/server/php/" data-dir="upload/manga/<?php echo $thisManga['slug'] ?>/" multiple></input>
		-->
		<input class="btn btn-success fileinput-button" id="fileupload" type="file" name="files[]" data-dir="upload/manga/<?php echo $thisManga['slug'] ?>/" multiple></input>
    </span>
        <!-- The file input field used as target for the file upload widget -->
        
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress">
        <div class="progress-bar progress-bar-success progress-animated"></div>
    </div>   
	  <!-- The extended global progress state -->
     <div id="extended" class="progress-extended">0 Mbit/s | 00:00:00 | 0 % | 0 MB / 0 MB</div>
    
	
    <!-- The container for the uploaded files -->
    <div id="files" class="files"></div>
    <br>

	
	
	
	<script>

	var chapter = $("#chapterNumber").val(); 
	
	
	
/*jslint unparam: true */
/*global window, $ */
$(function () {
	
    'use strict';

    // Initialize the jQuery File Upload widget:
    // Change this to the location of your server-side upload handler:
    var url = '../../../../admin/management/jqupload';

   $('#fileupload').fileupload({
        url: url,
        dataType: 'json',

		add: function (e, data) {
			data.submit();
        },
		
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
			
			 document.getElementById('extended').innerHTML= _renderExtendedProgress(data);
        },
		
        done: function (e, data) {
			$.each(data.result.files, function (index, file) {
				$("textarea#inputContent").val($("textarea#inputContent").val()+file.url+";");
				// document.getElementById('extended').innerHTML= "0 Mbit/s | 00:00:00 | 0 % | 0 MB / 0 MB";
            });
        }
		
    });
});
				
		function _renderExtendedProgress(data) {
            return _formatBitrate(data.bitrate) + ' | ' +
                _formatTime(
                    (data.total - data.loaded) * 8 / data.bitrate
                ) + ' | ' +
                _formatPercentage(
                    data.loaded / data.total
                ) + ' | ' +
                _formatFileSize(data.loaded) + ' / ' +
                _formatFileSize(data.total);
        }
		
		function _formatFileSize(bytes) {
            if (typeof bytes !== 'number') {
                return '';
            }
            if (bytes >= 1000000000) {
                return (bytes / 1000000000).toFixed(2) + ' GB';
            }
            if (bytes >= 1000000) {
                return (bytes / 1000000).toFixed(2) + ' MB';
            }
            return (bytes / 1000).toFixed(2) + ' KB';
        }

        function _formatBitrate(bits) {
            if (typeof bits !== 'number') {
                return '';
            }
            if (bits >= 1000000000) {
                return (bits / 1000000000).toFixed(2) + ' Gbit/s';
            }
            if (bits >= 1000000) {
                return (bits / 1000000).toFixed(2) + ' Mbit/s';
            }
            if (bits >= 1000) {
                return (bits / 1000).toFixed(2) + ' kbit/s';
            }
            return bits.toFixed(2) + ' bit/s';
        }

        function _formatTime(seconds) {
            var date = new Date(seconds * 1000),
                days = Math.floor(seconds / 86400);
            days = days ? days + 'd ' : '';
            return days +
                ('0' + date.getUTCHours()).slice(-2) + ':' +
                ('0' + date.getUTCMinutes()).slice(-2) + ':' +
                ('0' + date.getUTCSeconds()).slice(-2);
        }

        function _formatPercentage(floatValue) {
            return (floatValue * 100).toFixed(2) + ' %';
        }


</script>