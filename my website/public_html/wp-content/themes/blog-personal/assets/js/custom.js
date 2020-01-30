$=jQuery
jQuery(document).ready(function () {

    // slider
    var owllogo = $(".owl-slider-demo, .unique-post-slider");
    owllogo.owlCarousel({
        items:1,
        loop:true,
        nav:false,
        dots:true,
        smartSpeed:900,
        autoplay:true,
        autoplayTimeout:5000,
        fallbackEasing: 'easing',
        transitionStyle : "fade",
        autoplayHoverPause:true,
        animateOut: 'fadeOut'
    });


    // search toggle
    var removeClass = true;
    $(".search-icon").click(function () {
      $(".search-section").toggleClass('search-open');
      removeClass = false;
    });

    // when clicking the div : never remove the class
    $(".search-header input").click(function() {
      removeClass = false;
    });

    // when click event reaches "html" : remove class if needed, and reset flag
    $("html, .close-icon").click(function () {
      if (removeClass) {
          $(".search-section").removeClass('search-open');
      }
      removeClass = true;
    });

    jQuery('.menu-top-menu-container').meanmenu({
        meanMenuContainer: '.main-navigation',
        meanScreenWidth:"767",
        meanRevealPosition: "right",
    });

    /* back-to-top button*/
    $('.back-to-top').hide();
    $('.back-to-top').on("click",function(e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });


    $(window).scroll(function(){
        var scrollheight =400;
        if( $(window).scrollTop() > scrollheight ) {
            $('.back-to-top').fadeIn();
        }
        else {
            $('.back-to-top').fadeOut();
        }
    });

    $('.play').on('click', function() {
        owl.trigger('play.owl.autoplay', [1000])
    })
    $('.stop').on('click', function() {
        owl.trigger('stop.owl.autoplay')
    })

    // sticky sidebar
    jQuery('#primary , #secondary').theiaStickySidebar({
          // Settings
        additionalMarginTop: 30
    });
});

    $('.top-menu-toggle_bar_wrapper').on('click', function(){
      $(this).toggleClass('close');
      $(this).siblings('.top-menu-toggle_body_wrapper').slideToggle().toggleClass('hide-menu');
    });

    $(window).resize(function(){
        var winWidth = $(window).width();
        if(winWidth>1023){
            $('.top-menu-toggle_body_wrapper').remove('style');
            $('.top-menu-toggle_bar_wrapper').removeClass('close');
        }
    });

