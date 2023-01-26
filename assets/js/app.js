var TOPNEWS = TOPNEWS || {};
(function($){
    // USE STRICT
    "use strict";

    TOPNEWS.initialize = {

        init: function(){

            TOPNEWS.initialize.defaults();
            TOPNEWS.initialize.flexsliderInit();
            TOPNEWS.initialize.swiperInit();
            TOPNEWS.initialize.ajaxify();
            TOPNEWS.initialize.recent_post_ajaxify();
            TOPNEWS.initialize.post_left_thumb_ajaxify();
            TOPNEWS.initialize.parallaxBGImg();
            TOPNEWS.initialize.header();
            TOPNEWS.initialize.newsTicker();
            TOPNEWS.initialize.heroFullScreen();
        },
        defaults: function() {
            // Site Preloader
            $(window).load(function () {
                $(".loader").fadeOut();
                $("#preloader").delay(350).fadeOut("slow");
            });
            
            // hp-gallary
            $(window).load(function () {               
                var swiper = new Swiper('.hp-gallary-container', {
                    paginationClickable: true,
                    slidesPerView: 6,
                    spaceBetween: 0,
                    autoplay: 9000,
                    speed: 9000,
                    breakpoints: {
                        1200: {
                            slidesPerView: 6,
                            spaceBetween: 0
                        },
                        1024: {
                            slidesPerView: 4,
                            spaceBetween: 0
                        },
                        991: {
                            slidesPerView: 4,
                            spaceBetween: 0
                        },
                        768: {
                            slidesPerView: 4,
                            spaceBetween: 0
                        }
                    }
                }); 
                $('.hp-gallary-container .swiper-slide img').css({'display': 'block','width': '100%'}); 
            });
            
            var $iW = $(window).innerWidth();
            if ($iW <= 800){
                $('.sidebar-large').insertAfter('.content-holder');
                $('.sidebar-small').insertAfter('.sidebar-large');
            }

            // Stricky Sidebar
            $('.content-holder, .sidebar-large, .sidebar-small')
                .theiaStickySidebar({
                        additionalMarginTop: 30
                });
            $('.mega-sub-cat a:first').tab('show'); 
            $('.mega-sub-cat-list a:first').tab('show'); 
            // Trigger Search form
            $("#nav-search-open").click(function () {
                $("#nav-search-form").removeClass("hidden-form");
                $("#primary-menu").addClass("menu-open");
            });
            $("#nav-search-close").click(function () {
                $("#nav-search-form").addClass("hidden-form");
                $("#primary-menu").removeClass("menu-open");
            });

            // Mobile Menu
            $(".mobile-search #nav-search-open").click(function () {
                $(".mobile-search #nav-search-form").removeClass("hidden-form");
            });
            $(".mobile-search #nav-search-close").click(function () {
                $(".mobile-search #nav-search-form").addClass("hidden-form");
            });

            $("#navigation-toggle").click(function () {
                $("body").toggleClass("mobile-menu-open");
            });

            // Open Submenu
            $("#mobile-header a").click(function () {
                $("body").toggleClass("mobile-menu-open", false);
            });
            $("#mobile-header .menu-item-has-children > a").click(function (e) {
                $(this).parent().toggleClass("active");
                e.preventDefault();
                $("body").toggleClass("mobile-menu-open", true);
            });
            $("#mobile-header > .off-canvas").click(function () {
                $("body").toggleClass("mobile-menu-open", false);
            });

            // Back to top
            if ($('#back-to-top').length) {
                var scrollTrigger = window.innerHeight, // px
                    backToTop = function () {
                        var scrollTop = $(window).scrollTop();
                        if (scrollTop > scrollTrigger) {
                            $('#back-to-top').addClass('show');
                        } else {
                            $('#back-to-top').removeClass('show');
                        }
                    };
                backToTop();
                $(window).on('scroll', function () {
                    backToTop();
                });
                $('#back-to-top').on('click', function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                        scrollTop: 0
                    }, 700);
                });
            }                    

            // BG Image
            $('[data-tp-src]').each(function() {

                var img = $(this).data('tp-src');

                $(this).css({
                    backgroundImage: 'url(' + img + ')',
                });
            });
        },
        flexsliderInit: function() {
            //var $iW = $(window).innerWidth();
            var width = $('.flexslider-carousel').width();
            var width2 = $('.flexslider-carousel2').width();
            var width3 = $('.flexslider-carousel3').width();
            var carouselwidth = '';
            var carouselwidth2 = '';
            var carouselwidth3 = '';
            
            if (width <= 360){
                carouselwidth = 100;
            } else if (width <= 480){
                carouselwidth = 120;
            } else if (width <= 800){
                carouselwidth = 150;
            } else if (width <= 1170){
                carouselwidth = 225;
            } else {
                carouselwidth = 260;
            }
            
            if (width2 <= 360){
                carouselwidth2 = 100;
            } else if (width2 <= 480){
                carouselwidth2 = 120;
            } else if (width2 <= 800){
                carouselwidth2 = 150;
            } else if (width2 <= 1170){
                carouselwidth2 = 225;
            } else if (width3 >= 1171){
                carouselwidth2 = 270;
            }
            if (width3 <= 360){
                carouselwidth3 = 100;
            } else if (width3 <= 480){
                carouselwidth3 = 120;
            } else if (width3 <= 800){
                carouselwidth3 = 150;
            } else if (width3 <= 1170){
                carouselwidth3 = 225;
            } else if (width3 >= 1171){
                carouselwidth3 = 270;
            }
            
            
            $('.flexslider-carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: true,
                slideshow: true,
                itemWidth: carouselwidth,
                itemMargin: 0,
                asNavFor: '.flexslider-fashion'                    
            });

            $('.flexslider-fashion').flexslider({
                animation: "slide",
                controlNav: false,
                directionNav: false,
                animationLoop: true,                
                slideshow: true,
                autoplay: true,
                slideshowSpeed: 7500,
                sync: ".flexslider-carousel",
                after: function(slider) {
                if (!slider.playing) {
                  slider.play();                  
                };
                }                
            });            
            $('.flexslider-carousel2').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: true,
                slideshow: true,
                itemWidth: carouselwidth2,
                itemMargin: 5,
                asNavFor: '.flexslider-fashion2'                    
            });

            $('.flexslider-fashion2').flexslider({
                animation: "slide",
                controlNav: false,
                directionNav: false,
                animationLoop: true,
                slideshow: true,
                autoplay: true,
                slideshowSpeed: 7500,
                sync: ".flexslider-carousel2",
                after: function(slider) {
                if (!slider.playing) {
                  slider.play();                  
                };
                }                
            });                                      
            $('.flexslider-carousel3').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: true,
                slideshow: true,
                itemWidth: carouselwidth3,
                itemMargin: 5,
                asNavFor: '.flexslider-fashion3'                    
            });

            $('.flexslider-fashion3').flexslider({
                animation: "slide",
                controlNav: false,
                directionNav: false,
                animationLoop: true,
                slideshow: true,
                autoplay: true,
                slideshowSpeed: 7500,
                sync: ".flexslider-carousel3",
                after: function(slider) {
                if (!slider.playing) {
                  slider.play();                  
                };
                }                
            });                                      
        },
        swiperInit: function() {
            $('[data-carousel="swiper"]').each( function() {
                // Get Config Data
                var container 	= $(this).find('[data-swiper="container"]').attr('id');
                var pagination 	= $(this).find('[data-swiper="pagination"]').attr('id');
                var prev 		= $(this).find('[data-swiper="prev"]').attr('id');
                var next 		= $(this).find('[data-swiper="next"]').attr('id');
                var items 		= $(this).data('items');
                var breakpoints = $(this).data('breakpoints');
                var autoplay 	= $(this).data('autoplay');
                var iSlide 		= $(this).data('initial');
                var loop 		= $(this).data('loop');
                var center 		= $(this).data('center');
                var effect 		= $(this).data('effect');
                var direction 	= $(this).data('direction');
                var fContainer 	= $(this).find('[data-swiper="fashion-content"]').attr('id');
                var fThumb 		= $(this).find('[data-swiper="fashion-thumb"]').attr('id');

                // Configuration
                var conf 	= {};
                var fcConf 	= {};
                var ftConf 	= {
                    slideToClickedSlide: true
                };

                if ( items ) {
                    conf.slidesPerView = items,
                        ftConf.slidesPerView = items
                };
                if ( autoplay ) {
                    conf.autoplay = autoplay,
                        fcConf.autoplay = autoplay
                };
                if ( iSlide ) {
                    conf.initialSlide = iSlide,
                        fcConf.initialSlide = iSlide,
                        ftConf.initialSlide = iSlide
                };
                if ( center ) {
                    conf.centeredSlides = center,
                        ftConf.centeredSlides = center
                };
                if ( loop ) {
                    conf.loop = loop
                };
                if ( effect ) {
                    conf.effect = effect,
                        fcConf.effect = effect
                };
                if ( direction ) {
                    conf.direction = direction
                };
                if ( prev ) {
                    conf.prevButton = '#' + prev,
                        ftConf.prevButton = '#' + prev
                };
                if ( next ) {
                    conf.nextButton = '#' + next,
                        ftConf.nextButton = '#' + next
                };
                if ( pagination ) {
                    conf.pagination = '#' + pagination,
                        conf.paginationClickable = true,
                        fcConf.pagination = '#' + pagination,
                        fcConf.paginationClickable = true
                };
                if ( breakpoints ) {
                    conf.breakpoints = breakpoints,
                        ftConf.breakpoints = breakpoints
                };

                function animated_swiper(selector, init) {
                    var animated = function animated() {
                        $(selector + ' .swiper-slide-active [data-animate]').each(function(){
                            var anim = $(this).data('animate');
                            var delay = $(this).data('delay');
                            var duration = $(this).data('duration');

                            $(this).addClass(anim + ' animated')
                                .css({
                                    webkitAnimationDelay: delay,
                                    animationDelay: delay,
                                    webkitAnimationDuration: duration,
                                    animationDuration: duration
                                })
                                .one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                                    $(this).removeClass(anim + ' animated');
                                });
                        });
                    };
                    animated();
                    // Make animated when slide change
                    init.on('SlideChangeStart', function() {
                        $(initID + ' [data-animate]').each(function(){
                            var anim = $(this).data('animate');
                            $(this).removeClass(anim + ' animated');
                        });
                    });
                    init.on('SlideChangeEnd', animated);
                };

                // Initialization
                if (container) {
                    var initID = '#' + container;
                    var init = new Swiper( initID, conf);
                    animated_swiper(initID, init);
                };

                // For Fashion Slider
                if ( fContainer && fThumb ) {
                    var fashionSliderContent = new Swiper('#' + fContainer, fcConf );
                    animated_swiper('#' + fContainer, fashionSliderContent);
                    var fashionSliderThumbs = new Swiper('#' + fThumb, ftConf );
                    fashionSliderContent.params.control = fashionSliderThumbs;
                    fashionSliderThumbs.params.control = fashionSliderContent;
                };

            });
        },        
        ajaxify: function() {

            // Load Ajax Post on Tab widget
            $('[data-tn-tab-posts-ajaxify]').each(function() {
                var content = $(this).find('.tab-content');
                var spinner = $(this).find('.spinner');
                var thumb = $(this).data('thumb');
                var limit = $(this).data('limit');
                var offset = $(this).data('offset');
                var meta = $(this).data('meta');
                var excerpt = $(this).data('excerpt');
                var cat_meta = $(this).data('cat-meta');
                var list_class = $(this).data('list-class');

                $(this).find('.tab-switcher > li > a').click(function(e) {
                    spinner.addClass('working');
                    content.addClass('working');
                    e.preventDefault();
                    var cat = $(this).data('cat-id');
                    var data = {
                        action: 'top_news_tab_posts_results',
                        top_news_tab_posts_nonce: top_news_ajax_vars.top_news_tab_posts_ajax_nonce,
                        info: {
                            cat: cat,
                            thumb: thumb,
                            limit: limit,
                            offset: offset,
                            meta: meta,
                            excerpt: excerpt,
                            cat_meta: cat_meta,
                            class: list_class
                        }
                    };
                    $.post(top_news_ajax_vars.ajax_url, data, function(response){
                        content.html(response);
                        spinner.removeClass('working');
                        content.removeClass('working');
                        console.log(data);
                    });
                });

            });
        },
        recent_post_ajaxify: function(){
            $('[data-recent-post-ajax]').each(function() {
                var cat = $(this).data('catid');
                var limit = $(this).data('limit');
                var offset = $(this).data('limit');
                var post_col = $(this).data('post-col');
                var per_row = $(this).data('per-row');
                var content = $(this).data('content-id');
                var end_message = recent_post_ajax_vars.end_message; 
                $(this).find('.block-post-load .load-more').click(function(e) {
                    e.preventDefault();
                    var load = $(this).data('load');
                    var post_type = 'post';                                       
                    jQuery.ajax({
                        url : recent_post_ajax_vars.ajax_url,
                        type : 'post',
                        data : {
                            action : 'top_news_recent_posts_ajaxify',
                            limit: limit,
                            offset: offset,
                            post_type: post_type,                                            
                            cat: cat,                                            
                            post_col: post_col,                            
                            per_row: per_row                          
                        },
                        beforeSend: function() {
                            jQuery('#'+content+' .block-post-load .load-more').hide();
                            jQuery('#'+content+' .block-post-load').append('<div class="loading"><i class="fa fa-spinner fa-spin"></i> Loading ...</div>');
                        },
                        success : function( html ) {
                            jQuery('#'+content+' .block-post-load .loading').hide();
                            jQuery('#'+content+' .rp-ajax-row').append( html );
                            offset = +offset + +limit;
                            if( load > offset){
                                jQuery('#'+content+' .block-post-load .load-more').show();
                            } else {
                                jQuery('#'+content+' .block-post-load').append('<span class="load-more">'+end_message+'</span>');                    
                            }                            
                        }                        
                    });
                });
            });
        },
        post_left_thumb_ajaxify: function(){
            $('[data-post-left-thumb-ajax]').each(function() {
                var cat = $(this).data('catid');
                var limit = $(this).data('limit');
                var offset = $(this).data('limit');
                var content = $(this).data('content-id');
                var end_message = post_left_thumb_ajax_vars.end_message; 
                $(this).find('.block-post-load .load-more').click(function(e) {
                    e.preventDefault();
                    var load = $(this).data('load');
                    var post_type = 'post';                                       
                    jQuery.ajax({
                        url : post_left_thumb_ajax_vars.ajax_url,
                        type : 'post',
                        data : {
                            action : 'top_news_posts_left_thumb_ajaxify',
                            limit: limit,
                            offset: offset,
                            post_type: post_type,                                            
                            cat: cat,                         
                        },
                        beforeSend: function() {
                            jQuery('#'+content+' .block-post-load .load-more').hide();
                            jQuery('#'+content+' .block-post-load').append('<div class="loading"><i class="fa fa-spinner fa-spin"></i> Loading ...</div>');
                        },
                        success : function( html ) {
                            jQuery('#'+content+' .block-post-load .loading').hide();
                            jQuery('#'+content+' .rp-ajax-row').append( html );
                            offset = +offset + +limit;
                            if( load > offset){
                                jQuery('#'+content+' .block-post-load .load-more').show();
                            } else {
                                jQuery('#'+content+' .block-post-load').append('<span class="load-more">'+end_message+'</span>');                    
                            }                            
                        }                        
                    });
                });
            });
        },
        parallaxBGImg: function() {

            // Make Parallax Image Background
            $('[data-parallax="image"]').each(function() {

                var actualHeight = $(this).position().top;
                var reSize = actualHeight - $(window).scrollTop();
                var makeParallax = -(reSize/5);
                var posValue = makeParallax + "px";

                // Set Background Image position
                $(this).css({
                    backgroundPosition: '50% ' + posValue,
                });

            });
        },
        header: function() {
            if ($(window).scrollTop() > 250){
                $('#header').addClass('scrolled');
            } else {
                $('#header').removeClass('scrolled');
            }
        },
        newsTicker: function() {

            var newsTicker = $('.breking-news-ticker').each( function() {
                var ticker 	 = $(this).find('.newsticker');
                var prevBtn  = $(this).find('.prev-btn');
                var nextBtn  = $(this).find('.next-btn');
                var startBtn = $(this).find('.start-btn');
                var stopBtn  = $(this).find('.stop-btn');

                var conf = {
                    row_height: 20,
                    max_rows: 1,
                    speed: 600,
                    direction: 'up',
                    duration: 4000,
                    autostart: 1,
                    pauseOnHover: 0,
                    start: function() {
                        $(startBtn).addClass('hidden');
                        $(stopBtn).removeClass('hidden');
                    },
                    stop: function() {
                        $(startBtn).removeClass('hidden');
                        $(stopBtn).addClass('hidden');
                    }
                }

                if ( prevBtn ) {
                    conf.prevButton = prevBtn
                };
                if ( nextBtn ) {
                    conf.nextButton = nextBtn
                };
                if ( startBtn ) {
                    conf.startButton = startBtn
                };
                if ( stopBtn ) {
                    conf.stopButton = stopBtn
                };

                // News Ticker
                $('.newsticker').newsTicker(conf);

            });
        },
        heroFullScreen: function() {

            // Make The Section Full Screen
            $('.fullscreen').css('height', window.innerHeight );

            // Overlay Div Full Screen
            $('.full-screen .overlay').css('height', window.innerHeight );
        }

    };

    TOPNEWS.documentOnReady = {

        init: function(){
            TOPNEWS.initialize.init();
        },
    };
    TOPNEWS.documentOnResize = {

        init: function(){
            TOPNEWS.initialize.heroFullScreen();
        }
    };
    TOPNEWS.documentOnScroll = {

        init: function(){
            TOPNEWS.initialize.header();
            TOPNEWS.initialize.parallaxBGImg();
        }
    };

    // Initialize Functions
    $(document).ready( TOPNEWS.documentOnReady.init );
    $(window).on( 'resize', TOPNEWS.documentOnResize.init );
    $(document).on( 'scroll', TOPNEWS.documentOnScroll.init );

    //  register log in 
    $(function() {                       
      $(".register-here").click(function() {  
        $('.login-registration').addClass("blue");      
      });
      $(".back-login").click(function() {  
        $('.login-registration').removeClass("blue");      
      });

    });   

})(jQuery);
