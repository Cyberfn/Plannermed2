$(document).ready(function() {
    $('.nav-link').on('click', function(e) {
      e.preventDefault();
      $('.nav-link').removeClass('active');
      $(this).addClass('active');
      
      $('.content').hide();
      var target = $(this).attr('id').replace('-tab', '');
      $('#' + target).show();
    });
  });