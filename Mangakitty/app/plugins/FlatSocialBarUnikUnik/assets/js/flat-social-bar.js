$(document).ready(function() {
	$('.flat-social-bar-icons').hide();
    $('.flat-social-bar-trigger').click(function(){
        $('.flat-social-bar-icons').animate({height: 'toggle'}, 400);
    });
});