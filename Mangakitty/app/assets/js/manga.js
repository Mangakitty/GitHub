 $("[data-toggle=mangapop]").hover( function(){
	var e = $(this),
		slug =  e.attr('manga-slug');
	if ($("div[manga-slug='"+$(this).attr('manga-slug')+"']").length == 0) { 
		var popdiv = $(this).closest('#pop-href'),
			href = popdiv.data('href');
		$.post(href, { slug: slug }).done(function(data) {
			$( "body" ).append( "<div manga-slug='"+slug+"' style='display: none'>"+data+"</strong>" );
			if(e.is(":hover")){
				$(e).popover({
				trigger: "hover",
				content: function(){
					return $("div[manga-slug='"+$(this).attr('manga-slug')+"']").html();
									},
				placement: $(this).attr('data-placement'),
				html: true,
				}).popover('toggle');
			}
		});
	}else{
		$(e).popover({
			trigger: "hover",
			content: function(){
				return $("div[manga-slug='"+$(this).attr('manga-slug')+"']").html();
								},
			placement: $(this).attr('data-placement'),
			html: true,
			}).popover('toggle');
	}
 })