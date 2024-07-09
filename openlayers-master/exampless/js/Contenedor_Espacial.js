$(function(){
$('.menu').click(function(){
  var iframe = $(this).attr('rel');
  $('.iframe.active').slideUp(300, function(){
    $(this).removeClass('active');
    $('#'+iframe).slideDown(300, function(){
      $(this).addClass('active');
    })
  });
});
   
});