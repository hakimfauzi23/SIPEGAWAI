(function($) {
    "use strict";
    $(document).ready(function() {
        // $("select").niceSelect();

        /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            AOS Animation Activation
        <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
        AOS.init();
        window.addEventListener("load", AOS.refresh);

        if (jQuery(".testimonial-slider").length > 0) {
            $(".testimonial-slider").slick({
                dots: false,
                arrows: true,
                infinite: true,
                speed: 500,
                slidesToShow: 2,
                slidesToScroll: 2,
                prevArrow: '<button class="l2-slide-btn slick-prev focus-reset"><img src="../image/l2/png/long-arrow-left.png" alt=""></button>',
                nextArrow: '<button class="l2-slide-btn slick-next focus-reset"><img src="../image/l2/png/long-arrow-right.png" alt=""></button>',
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                }, ],
            });
        }

        if (jQuery(".testimonial-slider-2").length > 0) {
            $(".testimonial-slider-2").slick({
                dots: false,
                arrows: true,
                infinite: true,
                speed: 500,
                slidesToShow: 2,
                slidesToScroll: 2,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                }, ],
            });
        }


        // landing-9 card slider
        if (jQuery(".testimonial-card-slider").length > 0) {
            $(".testimonial-card-slider").slick({
                dots: true,
                arrows: false,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                }, ],
            });
        }
        // landing-12 testimonial-slider-3
        if (jQuery(".testimonial-slider-3").length > 0) {
            $(".testimonial-slider-3").slick({
                dots: true,
                arrows: false,
                infinite: true,
                speed: 1000,
                autoplay: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                }, ],
            });
        }

        if (jQuery(".blog-slider").length > 0) {
            $(".blog-slider").slick({
                dots: false,
                arrows: true,
                infinite: true,
                autoplay: true,
                speed: 500,
                slidesToShow: 3,
                slidesToScroll: 3,
                prevArrow: '<button class="l6-slide-btn slick-prev focus-reset circle-46 text-emerald font-size-7"><i class="icon icon-tail-left"></i></button>',
                nextArrow: '<button class="l6-slide-btn slick-next focus-reset circle-46 text-emerald font-size-7"><i class="icon icon-tail-right"></i></button>',
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    },
                }, ],
            });
        }


        if (jQuery(".screenshot-slider").length > 0) {

            $('.screenshot-slider').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                dots: true,
                arrows: true,
                prevArrow: '<button class="l7-slide-btn slick-prev focus-reset circle-46 text-black font-size-7"><i class="icon icon-stre-right"></i></button>',
                nextArrow: '<button class="l7-slide-btn slick-next focus-reset circle-46 text-black font-size-7"><i class="icon icon-stre-left"></i></button>',
                centerMode: true,
                centerPadding: '130px',
                autoplay: true,
                autoplaySpeed: 3000,
                infinite: true,
                easing: 'linear',
                speed: 800,
                appendDots: ".screenshots-dots",
                responsive: [{
                        breakpoint: 1800,
                        settings: {
                            slidesToShow: 5,
                            centerPadding: '100px',

                        }
                    },
                    {
                        breakpoint: 1750,
                        settings: {
                            slidesToShow: 5,
                            centerPadding: '20px',

                        }
                    },
                    {
                        breakpoint: 1670,
                        settings: {
                            slidesToShow: 4,
                            centerPadding: '60px',

                        }
                    },
                    {
                        breakpoint: 1640,
                        settings: {
                            slidesToShow: 3,
                            centerPadding: '20px',

                        }
                    },
                    {
                        breakpoint: 1550,
                        settings: {
                            slidesToShow: 3,
                            centerPadding: '30px',

                        }
                    },
                    {
                        breakpoint: 1450,
                        settings: {
                            slidesToShow: 3,
                            centerPadding: '10px',

                        }
                    },
                    {
                        breakpoint: 1350,
                        settings: {
                            slidesToShow: 3,
                            centerPadding: '20px',

                        }
                    },
                    {
                        breakpoint: 1250,
                        settings: {
                            slidesToShow: 3,
                            centerPadding: '10px',

                        }
                    },
                    {
                        breakpoint: 1150,
                        settings: {
                            slidesToShow: 3,
                            centerPadding: '0px',

                        }
                    },
                    {
                        breakpoint: 1050,
                        settings: {
                            slidesToShow: 1,
                            centerPadding: '10px',

                        }
                    },
                    {
                        breakpoint: 950,
                        settings: {
                            slidesToShow: 1,
                            centerPadding: '0',

                        }
                    },
                    {
                        breakpoint: 850,
                        settings: {
                            slidesToShow: 1,
                            centerPadding: '20px',
                        }
                    },
                    {
                        breakpoint: 750,
                        settings: {
                            slidesToShow: 1,
                            centerPadding: '20px',
                        }
                    },
                    {
                        breakpoint: 650,
                        settings: {
                            slidesToShow: 1,
                            centerPadding: '10px',
                        }
                    },
                    {
                        breakpoint: 515,
                        settings: {
                            slidesToShow: 1,
                            autoplay: true,
                            centerPadding: '0px',
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            autoplay: true,
                            centerPadding: '0px',
                            arrows: false,
                        }
                    }

                ]
            });



        }


        /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>      
            Bootstrap Mobile Megamenu Support
        <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/

        $(".dropdown-menu a.dropdown-toggle").on("click", function(e) {
            if (!$(this).next().hasClass("show")) {
                $(this)
                    .parents(".dropdown-menu")
                    .first()
                    .find(".show")
                    .removeClass("show");
            }
            var $subMenu = $(this).next(".dropdown-menu");
            $subMenu.toggleClass("show");

            $(this)
                .parents("li.nav-item.dropdown.show")
                .on("hidden.bs.dropdown", function(e) {
                    $(".dropdown-submenu .show").removeClass("show");
                });

            return false;
        });

        /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>      
               Sticky Header
        <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 50 ||
                document.documentElement.scrollTop > 50
            ) {
                $(".site-header--sticky").addClass("scrolling");
            } else {
                $(".site-header--sticky").removeClass("scrolling");
            }
            if (
                document.body.scrollTop > 700 ||
                document.documentElement.scrollTop > 700
            ) {
                $(".site-header--sticky.scrolling").addClass("reveal-header");
            } else {
                $(".site-header--sticky.scrolling").removeClass("reveal-header");
            }
        }



        /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>      
               Prcing Dynamic Script
        <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
        // Table BTN Trigger
        $('#table-price-value .toggle-btn').on("click", function(e) {
            console.log($(e.target).parent().parent().hasClass("monthly-active"));
            $(e.target).toggleClass("clicked");
            if ($(e.target).parent().parent().hasClass("monthly-active")) {
                $(e.target).parent().parent().removeClass("monthly-active").addClass("yearly-active");
            } else {
                $(e.target).parent().parent().removeClass("yearly-active").addClass("monthly-active");
            }
        });

        $("[data-pricing-trigger]").on("click", function(e) {
            $(e.target).addClass("active").siblings().removeClass("active");
            var target = $(e.target).attr("data-target");
            console.log($(target).attr("data-value-active") == "monthly");
            if ($(target).attr("data-value-active") == "monthly") {
                $(target).attr("data-value-active", "yearly");
            } else {
                $(target).attr("data-value-active", "monthly");
            }
        });

















        /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>      
               Smooth Scroll
        <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/

        $(".goto").on("click", function(event) {
            if (this.hash !== "") {
                event.preventDefault();
                var hash = this.hash;
                $("html, body").animate({
                        scrollTop: $(hash).offset().top,
                    },
                    2000,
                    function() {
                        window.location.hash = hash;
                    }
                );
            } // End if
        });





        $("a.popup").fancybox({
            // 'transitionIn'	:	'elastic',
            // 'transitionOut'	:	'elastic',
            // 'speedIn'		:	600, 
            // 'speedOut'		:	200, 
            // 'overlayShow'	:	false
        });

        /*---------- Counter Up ------------ */

        if ($.fn.counterUp) {
            $('.counter').counterUp({
                delay: 20,
                time: 2000
            });
        }

        // $(".accordion2-single-accordion").on("click",function() {
        //   $(this).addClass("current-collapse").next(".accordion2-single-accordion").removeClass("");
        // });

        // var $curr = $( "#start" );
        // $curr.addClass( "current-collapse" );
        // $( "button" ).click(function() {
        //   $curr = $curr.prev();
        //   $( "accordion2-single-accordion" ).css( "background", "" );
        //   $curr.toggleClass( "current-collapse" );
        //   $curr = $curr.next();
        //   $( "accordion2-single-accordion" ).css( "background", "" );
        //   $curr.removeClass( "current-collapse" );
        // });



    });





    // Table BTN Trigger
    // $('#l5-pricing-btn .toggle-btn').on("click",function(e){
    //   console.log($(e.target).parent().parent().hasClass("monthly-active"));
    //   $(e.target).toggleClass("clicked");
    //    if($(e.target).parent().parent().hasClass("monthly-active")){
    //          $(e.target).parent().parent().removeClass("monthly-active").addClass("yearly-active");
    //    }else{
    //          $(e.target).parent().parent().removeClass("yearly-active").addClass("monthly-active");
    //    }
    // })

    // $("[data-pricing-trigger]").on("click", function(e) {
    //   $(e.target).addClass("active").siblings().removeClass("active");
    //   var target = $(e.target).attr("data-target");
    //   console.log($(target).attr("data-value-active") == "monthly");
    //   if ($(target).attr("data-value-active") == "monthly") {
    //       $(target).attr("data-value-active", "yearly");
    //   } else {
    //       $(target).attr("data-value-active", "monthly");
    //   }
    // })


    /*>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>      
          Preloader Activation
    <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/

    $(window).load(function() {
        setTimeout(function() {
            $("#loading").fadeOut(500);
        }, 1000);
        setTimeout(function() {
            $("#loading").remove();
        }, 2000);
    });


}(jQuery));