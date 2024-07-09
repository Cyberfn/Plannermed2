$(document).ready(function() {
    $('.nav-link').on('click', function(e) {
      e.preventDefault();
      $('.nav-link').removeClass('active');
      $(this).addClass('active');
      
      $('.content').hide();
      var target = $(this).attr('id').replace('-tab', '');
      $('#' + target).show();
  });
  
    var down = false;
    $('#navbarDropdown').click(function(e){
      var dropdownMenu = $(this).siblings('.dropdown-menu');
      if(down){
        dropdownMenu.removeClass('show');
        down = false;
      } else {
        dropdownMenu.addClass('show');
        down = true;
      }
    });

    $(window).click(function(e) {
      if (!$(e.target).closest('#navbarDropdown').length) {
        $('.dropdown-menu').removeClass('show');
        down = false;
      }
    });
  });