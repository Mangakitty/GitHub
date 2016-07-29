$('.noty-btn').click(function() {
    if($(this).data('type')){ var type = $(this).data('type'); }else{ var type = 'info'; }
    if($(this).data('icon')){ var icon = $(this).data('icon'); }else{ var icon = ''; }
    if($(this).data('title')){ var title = $(this).data('title'); }else{ var title = ''; }
    if($(this).data('message')){ var message = $(this).data('message'); }else{ var message = ''; }
    $.growl({
      type: type,
      icon: icon,
      title: title,
      template: {
        title_divider: '<br/>'
      },
      message: message
    });
  });
$('.to-top').click(function() {
  $('html,body').animate({
    scrollTop: 0
  }, 1000);
});
$('.toggle-sidemenu').click(function(){
  $('#acp-menu').fadeOut();
  $('.tab-content').hide();
  $('#acp-content').css( "padding-left", "0" );
  $('#show-menu-btn').fadeIn();
});
$('#show-menu-btn').click(function(){
  $('#acp-menu').fadeIn();
  $('.tab-content').show();
  $('#acp-content').css( "padding-left", "75px" );
  $('#show-menu-btn').fadeOut();
});
$('.btn-pop').popover();

$(document).ready(function() {
  $('.count-to').countTo({
    from: 0,
    to: $(this).data('to'),
    speed: 2000, // millisec
    refreshInterval: 150
  });
});
