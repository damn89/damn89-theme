(function() {
  if (!jQuery) return;
  jQuery(function($) {

    
    // för få alla rätt storlek

    $( window ).resize(function() {

      var windowWidth = $(window).outerWidth();

      if(windowWidth > 768){
        var height = $('.box').first().find('.portfolio-object:nth-child(1)').outerHeight();
        // console.log(height);

        $('.box:nth-child(even)').css('height', height);
      }


      if(windowWidth < 769){
        $('.box:nth-child(even)').css('height', '');

      }

    }).trigger('resize');

    // ajax anrop för kategorier
    var $link = $('.multiple-items').find('a');
    var $link2 = $('.filter-menu').find('a');

    $($link).on('click', function(event){
      event.preventDefault();

     var category = $(this).attr("data-category");

      $.ajax({
        url : "http://localhost/minnyahemsida/",
        type : 'post',
        data : {
          category : category,
          requestType : 'filter'
        },
        success : function( response ) {
            // console.log(response);
          $('main').html(response);
          $(window).resize();

        }

        });// slut ajax 

      });// slut click-event

    $($link2).on('click', function(event){
      event.preventDefault();

     var category = $(this).attr("data-category");

      $.ajax({
        url : "http://localhost/minnyahemsida/",
        type : 'post',
        data : {
          category : category,
          requestType : 'filter'
        },
        success : function( response ) {
            // console.log(response);
          $('main').html(response);
          (window).resize();

        }

        });// slut ajax 

      });// slut click-event

    $('#burger-menu').on('click',function(){
      $('body').toggleClass('open');
    });


    //slick slide 

  $('.multiple-items').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3
  });
      




  }); // slut för jQuery
})();





