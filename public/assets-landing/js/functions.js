/*global jQuery */
/* Contents
// ------------------------------------------------>
	1.  LOADING SCREEN
	2.  BACKGROUND INSERT
	3.	MODULE SEARCH
	4.	MODULE CART
	5.	MODULE SIDEAREA
	6.	POPUP HEADER
	7.	MODULE CANCEL
	8.  MOBILE MENU
	9.  NAVBAR STICKY
	10. COUNTER UP              
    11. COUNTDOWN DATE  
	12. AJAX MAILCHIMP         
	13. AJAX CAMPAIGN MONITOR
	14. OWL CAROUSEL
	15. CIRCULAR PROGRESS
	16. MAGNIFIC POPUP
	17. MAGNIFIC POPUP VIDEO
	18. BACK TO TOP
	19. GALLERY FLITER
	20. WORK FLITER
	21. WORK MASONRY
	22. FOLLOW INSTAGRAM
	23. SCROLL TO
	24. PROGRESS BAR
	25. SLIDER RANGE            
	26. AJAX CONTACT FORM       
	27. GOOGLE MAP
	28. PARALLAX FOOTER
	29. NICE SELECT
	30. SHOP PRODUCT QUANTITY
	31. PARALLAX FOOTER
*/
(function($) {
    "use strict";
    /* ------------------  LOADING SCREEN ------------------ */

    $(window).on("load", function() {
        $(".preloader").fadeOut(5000);
        $(".preloader").remove();
    });

    /* ------------------  Background INSERT ------------------ */

    var $bgSection = $(".bg-section");
    var $bgPattern = $(".bg-pattern");
    var $colBg = $(".col-bg");

    $bgSection.each(function() {
        var bgSrc = $(this).children("img").attr("src");
        var bgUrl = 'url(' + bgSrc + ')';
        $(this).parent().css("backgroundImage", bgUrl);
        $(this).parent().addClass("bg-section");
        $(this).remove();
    });

    $bgPattern.each(function() {
        var bgSrc = $(this).children("img").attr("src");
        var bgUrl = 'url(' + bgSrc + ')';
        $(this).parent().css("backgroundImage", bgUrl);
        $(this).parent().addClass("bg-pattern");
        $(this).remove();
    });

    $colBg.each(function() {
        var bgSrc = $(this).children("img").attr("src");
        var bgUrl = 'url(' + bgSrc + ')';
        $(this).parent().css("backgroundImage", bgUrl);
        $(this).parent().addClass("col-bg");
        $(this).remove();
    });

    /* ------------------  MODULE SEARCH  ------------------ */

    var $moduleSearch = $("#moduleSearchIcon"),
        $searchWarp = $(".module-search-warp");

    $moduleSearch.on("click", function() {
        $(this).parent().addClass("module-active");
        $(this).parent().siblings().removeClass("module-active");
        $searchWarp.addClass("search-warp-active");
    });

    /* ------------------  MODULE CART ------------------ */

    var $moduleCart = $("#moduleCartICon");

    $moduleCart.on("click", function() {
        $(this).parent().toggleClass("module-active");
        $(this).parent().siblings().removeClass("module-active");
    });

    /* ------------------  MODULE SIDEAREA  ------------------ */

    var $moduleSideArea = $("#moduleSideAreaIcon"),
        $sideareaOverlay = $(".sidearea-overlay"),
        $SideAreaWarp = $(".module-sidearea-wrap");

    $moduleSideArea.on("click", function() {
        $(this).parent().addClass("module-active");
        $(this).parent().siblings().removeClass("module-active");
        $SideAreaWarp.addClass("sidearea-wrap-active");
        $sideareaOverlay.addClass("sidearea-overlay-active");
    });


    /* ------------------  POPUP HEADER ------------------ */

    var $popMenuIcon = $("#popupMenuIcon"),
        $popMenuWarp = $('.popup-menu-warp');

    $popMenuIcon.on('click', function() {
        $popMenuWarp.addClass("popup-menu-warp-active");
    });

    /* ------------------  MODULE CANCEL ------------------ */

    var $module = $(".module"),
        $moduleWarp = $(".module-warp"),
        $moduleCancel = $(".module-cancel");
    $moduleCancel.on("click", function(e) {
        $module.removeClass("module-active");
        $SideAreaWarp.removeClass("sidearea-wrap-active");
        $sideareaOverlay.removeClass("sidearea-overlay-active");
        $searchWarp.removeClass("search-warp-active");
        $popMenuWarp.removeClass("popup-menu-warp-active");
        e.stopPropagation();
        e.preventDefault();
    });

    $(document).keyup(function(e) {
        if (e.key === "Escape") {
            $module.removeClass("module-active");
            $moduleWarp.removeClass("active");
            $sideareaOverlay.removeClass("sidearea-overlay-active");
            $SideAreaWarp.removeClass("sidearea-wrap-active");
            $searchWarp.removeClass("search-warp-active");
            $popMenuWarp.removeClass("popup-menu-warp-active");
        }
    });

    /* ------------------  MOBILE MENU ------------------ */

    var $dropToggle = $("[data-toggle='dropdown']");
    $dropToggle.on("click", function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass("show");
        $(this).parent().toggleClass("show");
    });

    /* ------------------ NAVBAR STICKY ------------------ */

    $(window).scroll(function() {
        if ($(document).scrollTop() > 100) {
            $('.navbar-sticky').addClass('navbar-fixed');
        } else {
            $('.navbar-sticky').removeClass('navbar-fixed');
        }
    });

    /* ------------------  COUNTER UP ------------------ */

    $(".counting").counterUp({
        delay: 10,
        time: 1000
    });

    /* ------------------ COUNTDOWN DATE ------------------ */

    if ($(".countdown").length > 0) {
        $(".countdown").each(function() {
            var $countDown = $(this),
                countDate = $countDown.data("count-date"),
                newDate = new Date(countDate);
            $countDown.countdown({
                until: newDate,
                format: "MMMM Do , h:mm:ss a"
            });
        });
    }
    /* ------------------  AJAX MAILCHIMP ------------------ */

    $('.mailchimp').ajaxChimp({
        url: "http://wplly.us5.list-manage.com/subscribe/post?u=91b69df995c1c90e1de2f6497&id=aa0f2ab5fa", //Replace with your own mailchimp Campaigns URL.
        callback: chimpCallback

    });

    function chimpCallback(resp) {
        if (resp.result === 'success') {
            $('.subscribe-alert').html('<div class="alert alert-success">' + resp.msg + '</div>').fadeIn(1000);
            //$('.subscribe-alert').delay(6000).fadeOut();

        } else if (resp.result === 'error') {
            $('.subscribe-alert').html('<div class="alert alert-danger">' + resp.msg + '</div>').fadeIn(1000);
        }
    }

    /* ------------------  AJAX CAMPAIGN MONITOR  ------------------ */

    $('#campaignmonitor').submit(function(e) {
        e.preventDefault();
        $.getJSON(
            this.action + "?callback=?",
            $(this).serialize(),
            function(data) {
                if (data.Status === 400) {
                    alert("Error: " + data.Message);
                } else { // 200
                    alert("Success: " + data.Message);
                }
            });
    });

    /* ------------------ OWL CAROUSEL ------------------ */

    var $carouselDirection = $("html").attr("dir");
    if ($carouselDirection === "rtl") {
        var $carouselrtl = true;
    } else {
        var $carouselrtl = false;
    }

    $(".carousel").each(function() {
        var $Carousel = $(this);
        $Carousel.owlCarousel({
            loop: $Carousel.data('loop'),
            autoplay: $Carousel.data("autoplay"),
            margin: $Carousel.data('space'),
            nav: $Carousel.data('nav'),
            dots: $Carousel.data('dots'),
            center: $Carousel.data('center'),
            dotsSpeed: $Carousel.data('speed'),
            animateOut: 'fadeOut',
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: $Carousel.data('slide-rs'),
                },
                1000: {
                    items: $Carousel.data('slide'),
                }
            }
        });
    });

    $(".testimonial-slider").each(function() {
        var $Slider = $(this);
        $Slider.owlCarousel({
            thumbs: true,
            thumbsPrerendered: true,
            loop: true,
            margin: 0,
            autoplay: true,
            nav: true,
            dots: false,
            center: true,
            dotsSpeed: 3000,
            rtl: $carouselrtl,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    });

    /* ------------------ CIRCULAR PROGRESS ------------------ */

    if ($('.circle-prog').length > 0) {
        $('.circle-prog').circleProgress({
            fill: {
                color: "#f9bc01"
            },
            thickness: 5,
            emptyFill: "transparent",
        });
    }

    /* ------------------ MAGNIFIC POPUP ------------------ */

    var $imgPopup = $(".img-popup");
    $imgPopup.magnificPopup({
        type: "image"
    });
    $('.img-gallery-item').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    /* ------------------  MAGNIFIC POPUP VIDEO ------------------ */

    $('.popup-video,.popup-gmaps').magnificPopup({
        disableOn: 700,
        mainClass: 'mfp-fade',
        removalDelay: 0,
        preloader: false,
        fixedContentPos: false,
        type: 'iframe',
        iframe: {
            markup: '<div class="mfp-iframe-scaler">' +
                '<div class="mfp-close"></div>' +
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                '</div>',
            patterns: {
                youtube: {
                    index: 'youtube.com/',
                    id: 'v=',
                    src: '//www.youtube.com/embed/%id%?autoplay=1'
                }
            },
            srcAction: 'iframe_src',
        }
    });

    /* ------------------  BACK TO TOP ------------------ */

    var backTop = $('#back-to-top');

    if (backTop.length) {
        var scrollTrigger = 200, // px
            backToTop = function() {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    backTop.addClass('show');
                } else {
                    backTop.removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function() {
            backToTop();
        });
        backTop.on('click', function(e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }

    /* ------------------ GALLERY FLITER ------------------ */

    var $galleryFilter = $(".gallery-filter"),
        galleryLength = $galleryFilter.length,
        protfolioFinder = $galleryFilter.find("a"),
        $galleryAll = $("#gallery-all");

    // init Isotope For gallery
    protfolioFinder.on("click", function(e) {
        e.preventDefault();
        $galleryFilter.find("a.active-filter").removeClass("active-filter");
        $(this).addClass("active-filter");
    });
    if (galleryLength > 0) {
        $galleryAll.imagesLoaded().progress(function() {
            $galleryAll.isotope({
                filter: "*",
                animationOptions: {
                    duration: 750,
                    itemSelector: ".gallery-item",
                    easing: "linear",
                    queue: false,
                }
            });
        });
    }
    protfolioFinder.on("click", function(e) {
        e.preventDefault();
        var $selector = $(this).attr("data-filter");
        $galleryAll.imagesLoaded().progress(function() {
            $galleryAll.isotope({
                filter: $selector,
                animationOptions: {
                    duration: 750,
                    itemSelector: ".gallery-item",
                    easing: "linear",
                    queue: false,
                }
            });
            return false;
        });
    });

    /* ------------------ WORK FLITER ------------------ */

    var $workFilter = $(".work-filter"),
        workLength = $workFilter.length,
        workFinder = $workFilter.find("a"),
        $workAll = $("#work-all");

    // init Isotope For gallery
    workFinder.on("click", function(e) {
        e.preventDefault();
        $workFilter.find("a.active-filter").removeClass("active-filter");
        $(this).addClass("active-filter");
    });
    if (workLength > 0) {
        $workAll.imagesLoaded().progress(function() {
            $workAll.isotope({
                filter: "*",
                animationOptions: {
                    duration: 750,
                    itemSelector: ".work-item",
                    easing: "linear",
                    queue: false,
                }
            });
        });
    }
    workFinder.on("click", function(e) {
        e.preventDefault();
        var $selector = $(this).attr("data-filter");
        $workAll.imagesLoaded().progress(function() {
            $workAll.isotope({
                filter: $selector,
                animationOptions: {
                    duration: 750,
                    itemSelector: ".work-item",
                    easing: "linear",
                    queue: false,
                }
            });
            return false;
        });
    });
    /* ------------------  WORK MASONRY ------------------ */

    $('.work-masonry-layout').imagesLoaded().progress(function() {
        $('.work-masonry-layout').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: '.grid-sizer',
                gutter: 30
            }
        });
    });

    /* ------------------  FOLLOW INSTAGRAM ------------------ */

    var instafeedModule = $("#instafeedModule").length,
        instafeedFooter = $("#instafeedFooter").length,
        InstaUserID = "17841403625658279" /*YOUR_USER_ID*/ ,
        InstaAccessToken = "IGQVJXemRJZAUdRZAnNJc0NEcUpLclZAaaUpBaWRENXRQbUl6ZAlBNaTZAsX1huclk2OWRLMXNEZAEtIMDBtbjF3cWRCMlFjY19iS0NWRnJyV2pRajlYSjllWDUxdjlVcG1zWm9GSXdJRTlOWGVMWjJvZAGZA5WQZDZD"; /*YOUR_ACCESS_TOKEN*/
    if (instafeedModule > 0) {
        var userFeedModule = new Instafeed({
            target: "instafeedModule",
            get: "user",
            userId: InstaUserID,
            accessToken: InstaAccessToken,
            limit: $(".instafeed").data("insta-number"),
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /><div class="insta-hover"><i class="fab fa-instagram"></i></div></a>',
            resolution: "low_resolution"
        });

        userFeedModule.run();
    }

    if (instafeedFooter > 0) {
        var userFeedFooter = new Instafeed({
            target: "instafeedFooter",
            get: "user",
            userId: InstaUserID,
            accessToken: InstaAccessToken,
            limit: $(".instafeed").data("insta-number"),
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /><div class="insta-hover"><i class="fa fa-plus"></i></div></a>',
            resolution: "low_resolution"
        });
        userFeedFooter.run();
    }

    /* ------------------  SCROLL TO ------------------ */

    var aScroll = $('a[data-scroll="scrollTo"]');
    aScroll.on('click', function(event) {
        var target = $($(this).attr('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 1000);
            if ($(this).hasClass("menu-item")) {
                $(this).parent().addClass("active");
                $(this).parent().siblings().removeClass("active");
            }
        }
    });

    /* ------------------ PROGRESS BAR ------------------ */

    $(".progressbar").each(function() {
        $(this).waypoint(function() {
            var progressBar = $(".progress-bar"),
                progressBarTitle = $(".progress-title .value");
            progressBar.each(function() {
                $(this).css("width", $(this).attr("aria-valuenow") + "%");
            });
            progressBarTitle.each(function() {
                $(this).css('opacity', 1);
            });
        }, {
            triggerOnce: true,
            offset: 'bottom-in-view'
        });
    });

    /* ------------------ SLIDER RANGE ------------------ */

    var $sliderRange = $("#slider-range"),
        $sliderAmount = $("#amount");
    $sliderRange.slider({
        range: true,
        min: 0,
        max: 500,
        values: [50, 300],
        slide: function(event, ui) {
            $sliderAmount.val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
    $sliderAmount.val("$" + $sliderRange.slider("values", 0) + " - $" + $sliderRange.slider("values", 1));

    /* ------------------  AJAX CONTACT FORM  ------------------ */

    var contactForm = $(".contactForm"),
        contactResult = $('.contact-result');
    contactForm.validate({
        debug: false,
        submitHandler: function(contactForm) {
            $(contactResult, contactForm).html('Please Wait...');
            $.ajax({
                type: "POST",
                url: "assets/php/contact.php",
                data: $(contactForm).serialize(),
                timeout: 20000,
                success: function(msg) {
                    $(contactResult, contactForm).html('<div class="alert alert-success" role="alert"><strong>Thank you. We will contact you shortly.</strong></div>').delay(3000).fadeOut(2000);
                },
                error: $('.thanks').show()
            });
            return false;
        }
    });

    /* ------------------  PARALLAX FOOTER ------------------ */

    siteFooter();
    $(window).resize(function() {
        siteFooter();
    });

    function siteFooter() {
        var siteContent = $('#wrapperParallax');

        var siteFooter = $('#footerParallax');
        var siteFooterHeight = siteFooter.height();

        siteContent.css({
            "margin-bottom": siteFooterHeight
        });
    };

    /* ------------------  NICE SELECT ------------------ */

    $('select').niceSelect();

    /* ------------------  SHOP PRODUCT QUANTITY ------------------ */

    $('.product-quantity form.cart').on('click', 'input.plus, input.minus', function() {
        // Get current quantity values
        var qty = $(this).parents('.product-quantity').find('.qty');
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr('max'));
        var min = parseFloat(qty.attr('min'));
        var step = parseFloat(qty.attr('step'));

        // Check If Quantity value is undefined or non numeric 
        if (isNaN(val)) {
            var val = 0;
        }

        // Change the value if plus or minus
        if ($(this).is('.plus')) {
            if (max && (max <= val)) {
                qty.val(max);
            } else {
                qty.val(val + step);
            }
        } else {
            if (min && (min >= val)) {
                qty.val(min);
            } else if (val > 1) {
                qty.val(val - step);
            }
        }
    });

    /* ------------------  WOW ------------------ */

    var wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 50, // distance to the element when triggering the animation (default is 0)
        mobile: false, // trigger animations on mobile devices (default is true)
        live: true // act on asynchronously loaded content (default is true)

    });
    wow.init();

}(jQuery));