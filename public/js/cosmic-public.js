(function ($) {
    'use strict';
    $(document).ready(function () {



        $('.autoplay').slick({

            autoplay: true,
            autoplaySpeed: 2000,

            responsive: [

                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });


        // SQUARED RESIZE BOX 

        $(window).resize(function ()
        {
            var ratio = 4 / 4; // height / width  
            $('.square-resize').height(jQuery('.square-resize').width() * ratio);
        });

// When the page loads, trigger a window resize event  
// so our element gets resized by default. Saves having   
// to duplicate the same code on load too.  
        $(window).load(function ()
        {
            $(window).trigger('resize');
        });





    });


})(jQuery);

