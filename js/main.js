(function() {
  if (!jQuery) return;
  jQuery(function($) {





    // adding click event on menu
    $('#burger-menu').on('click',function(){
      $('body').toggleClass('open');
    });



  }); // end jQuery
})();





