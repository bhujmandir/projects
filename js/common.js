  jQuery(document).ready(function () {
      jQuery('header nav').meanmenu();
  });

  // end navigation 

  $('#owl-carousel').owlCarousel({
    loop:true,
    margin:1,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

  $('#owl-testimonial').owlCarousel({
    loop:true,
    margin:30,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});
  // end slider

  $(document).ready(function($) {
    $(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
            $('header').addClass('head-fix');
        } else {
            $('header').removeClass('head-fix');
        }
    });
}); 

 // end header fix

 $(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 670;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >>";
    var lesstext = "Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});

  // end content show hide

  $(document).ready(function () {

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

});

 // end click to top

 $(document).ready(function() {
        $(".fancybox").fancybox();
    });
 
 // click to popup


 