$(function() {
  $('.icon').hover(function() {
    $(this).siblings('.caption').show();
  }, function() {
    $(this).siblings('.caption').hide();
  });
});