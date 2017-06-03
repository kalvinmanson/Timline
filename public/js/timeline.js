$(function() {
  $('.tr_post').click( function() {
  	var form = $(this).data('form');
  	$('.tr_form_'+form).toggle();
  });
});