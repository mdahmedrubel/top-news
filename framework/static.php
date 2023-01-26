<?php if (! defined('ABSPATH')) die('Direct access forbidden.');
/**
 * Enqueue all theme scripts and styles
 *
 * @package TopNews
 * @author CodexCoder
 */

/**
 * Vendor Stylesheets and Scripts
 */
function top_news_scripts(){
    wp_enqueue_style('top-news-style', get_stylesheet_uri());
    // Bootstrap
    wp_enqueue_style('bootstrap', TOPNEWS_VENDOR . '/bootstrap/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap', TOPNEWS_VENDOR . '/bootstrap/js/bootstrap.min.js', array('jquery'), false, true);

    //Media Element
    wp_enqueue_script('mediaelement');

    // Font Awesome
    wp_enqueue_style('font-awesome', TOPNEWS_VENDOR . '/fontawesome/css/font-awesome.min.css');

    // Swiper
    wp_enqueue_style('swiper', TOPNEWS_VENDOR . '/swiper/css/swiper.min.css');
    wp_enqueue_script('swiper', TOPNEWS_VENDOR . '/swiper/js/swiper.min.js', array('jquery'), false, true);


    // News Ticker
    wp_enqueue_script('newsTicker', TOPNEWS_VENDOR . '/news-ticker/jquery.newsTicker.min.js', array('jquery'), false, true);

    // Sticky Sidebar
    wp_enqueue_script('theia-sticky-sidebar', TOPNEWS_ASSETS . '/js/theia-sticky-sidebar.js', array('jquery'), false, true);

    // Flexslider
    wp_enqueue_style('top-news-flexslider', TOPNEWS_VENDOR . '/flexslider/flexslider.css');
    wp_enqueue_script('top-news-flexslider', TOPNEWS_VENDOR . '/flexslider/flexslider.js', array('jquery'), false, true);


    //Single Post Comments
    if (is_singular() && comments_open() && get_option('thread_comments')){
        wp_enqueue_script('comment-reply');
    }

    //Theme Stylesheets and Scripts
    wp_enqueue_style('top-news-theme-stylesheet', TOPNEWS_ASSETS . '/css/app.css');
    wp_enqueue_style('top-news-theme-responsive', TOPNEWS_ASSETS . '/css/responsive.css');
    wp_enqueue_style('top-news-style', get_stylesheet_uri(), null);
    wp_enqueue_script('top-news-script', TOPNEWS_ASSETS . '/js/app.js', array('jquery'), false, true);


    wp_localize_script('top-news-script', 'top_news_ajax_vars',array(
        'top_news_tab_posts_ajax_nonce' => wp_create_nonce('top_news_tab_posts_results'),    
        'ajax_url' => admin_url('admin-ajax.php')
    ));
    //create nonce for top thum recent post (recent_post_ajax.php)
    wp_localize_script('top-news-script', 'recent_post_ajax_vars',array(
        'end_message' => __('Sorry, No more post to load', 'vast-buzz'),
        'ajax_url' => admin_url('admin-ajax.php')
    ));
    //create nonce for left thumb recent post (post_left_thumb_ajax.php)
    wp_localize_script('top-news-script', 'post_left_thumb_ajax_vars',array(
        'end_message' => __('Sorry, No more post to load', 'vast-buzz'),
        'ajax_url' => admin_url('admin-ajax.php')
    ));

    // ajax load more post
    global $wp_query;
    $max_num_pages = $wp_query->max_num_pages;
    $post_per_page = get_option('posts_per_page');
    $top_news_blog_post_column = '1-col';
    $top_news_blog_post_style = 'style-1';
    $is_excerpt = 'true';
    $blog_excerpt_limit = '15';
    $is_readmore = 'true';
    if (function_exists('cs_get_option')):        
        $top_news_blog_post_column = cs_get_option('blog_column');
        $top_news_blog_post_style = cs_get_option('blog_template_post_style');
        $is_excerpt = cs_get_option('blog_excerpt');
        $blog_excerpt_limit = cs_get_option('blog_excerpt_limit');
        $is_readmore = cs_get_option('blog_readmore');
    endif;

    wp_enqueue_script( 'top-news-load-more-post',  get_template_directory_uri() . '/assets/js/load-more-post.js', array( 'jquery' ), '1.0', true );
    wp_localize_script( 'top-news-load-more-post', 'loadmorepost', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'posts_per_page' => $post_per_page,
        'blog_column' => $top_news_blog_post_column,
        'post_style' => $top_news_blog_post_style,
        'is_excerpt' => $is_excerpt,
        'excerpt_limit' => $blog_excerpt_limit,
        'is_readmore' => $is_readmore,
        'max_num_pages' => $max_num_pages,
        'end_message' => __('Sorry, No more post to load', 'top-news'),
    ));
}
add_action( 'wp_enqueue_scripts', 'top_news_scripts', 90 );


//Register Fonts
function top_news_fonts_url(){
    $top_news_font = cs_get_option('tn_font_family');    
    $top_news_font_family = $top_news_font['family'];
    
    $top_news_title_font = cs_get_option('tn_title_font_family');           
    $top_news_title_font_family = $top_news_title_font['family'];
    
    $top_news_menu_font = cs_get_option('tn_menu_font_family');           
    $top_news_menu_font_family = $top_news_menu_font['family'];
    
    $font_url = '';
    
    //Translators: If there are characters in your language that are not supported
    //by chosen font(s), translate this to 'off'. Do not translate into your own language.
    
    if ('off' !== _x('on', 'Google font: on or off', 'top-news')){
        $font_families = array();
        if (!empty($top_news_font_family)){
        $font_families[] = $top_news_font_family;        
        } 
        if(!empty($top_news_title_font_family) && ($top_news_title_font_family != $top_news_font_family)){
            $font_families[] = $top_news_title_font_family;
        } 
        if(!empty($top_news_menu_font_family) && ($top_news_menu_font_family != $top_news_font_family) && ($top_news_menu_font_family != $top_news_title_font_family)){
            $font_families[] = $top_news_menu_font_family;
        } 
        if (empty($top_news_font_family) && empty($top_news_title_font_family) && empty($top_news_menu_font_family)){
            $font_families[] = 'Roboto';
        }
        $query_args = implode('|', $font_families);
        $font_url = add_query_arg('family', urlencode(''.$query_args.':400,300,300italic,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic&subset=latin,latin-ext'), "//fonts.googleapis.com/css");
    }
    return $font_url;
}

//Enqueue scripts and styles.
function top_news_custom_header(){
    $top_news_font = cs_get_option('tn_font_family');    
    $top_news_font_family = $top_news_font['family'];
    $top_news_font_size = cs_get_option('tn_font_size');

    $top_news_title_font = cs_get_option('tn_title_font_family');           
    $top_news_title_font_family = $top_news_title_font['family'];
    $top_news_title_font_weight = cs_get_option('tn_title_font_weight'); 
    $top_news_title_font_style = cs_get_option('tn_title_font_style');
    $top_news_title_transform = cs_get_option('tn_title_transform');
    
    $top_news_menu_font = cs_get_option('tn_menu_font_family');           
    $top_news_menu_font_family = $top_news_menu_font['family'];
    $top_news_menu_font_weight = cs_get_option('tn_menu_font_weight'); 
    $top_news_menu_font_style = cs_get_option('tn_menu_font_style');
    $top_news_menu_transform = cs_get_option('tn_menu_transform');
    $top_news_theme_color = cs_get_option('tn_theme_color');
    $top_news_theme_hover_color = cs_get_option('tn_theme_hover_color');
    
    
    $tn_theme_sidebar_bg_color = cs_get_option('tn_theme_sidebar_bg_color');
    $tn_theme_footer_top_bg_color = cs_get_option('tn_theme_footer_top_bg_color');
    $tn_theme_copy_footer_bg_color = cs_get_option('tn_theme_copy_footer_bg_color');
    
    $tn_top_bar_bg_color = cs_get_option('tn_top_bar_bg_color');
    $tn_top_bar_font_color = cs_get_option('tn_top_bar_font_color');
    
    $tn_custom_css = cs_get_option('tn_custom_css');
    $header8_header_bg_color = cs_get_option('header8_header_bg_color');
    $header9_header_bg_color = cs_get_option('header9_header_bg_color');
    $header8_menu_bg_color = cs_get_option('header8_menu_bg_color');
    ?>
    <style type="text/css">
        body{
            font-family: '<?php echo esc_attr($top_news_font_family); ?>', sans-serif;
            font-size: <?php echo esc_attr($top_news_font_size); ?>px;
        }
        h1, h2, h3, h4, h5, h6,
        .featured-posts .post-item.special > .post-info > .title,
        .small-posts-list .title,
        .timeline-posts > li > .title,
        .featured-posts .post-item.special > .post-info > .title,
        .page-header .title,
        .entry-header .entry-title,
        .posts-lists .post-item > .content > .title,
        .posts-lists .post-item > .content > .title,
        .featured-posts .post-item > .post-info > .title,
        .post-carousel-widget .post-items > .item > .content > .title,
        .posts-lists .post-item > .content > .title{
            font-family: '<?php echo esc_attr($top_news_title_font_family); ?>', sans-serif;
            font-weight: <?php echo esc_attr($top_news_title_font_weight); ?>;
            font-style: <?php echo esc_attr($top_news_title_font_style); ?>;
            text-transform: <?php echo esc_attr($top_news_title_transform); ?>;
        }
        .primary-menu .menu-container > .menu-inside > .nav > li > a{
            font-family: '<?php echo esc_attr($top_news_menu_font_family); ?>', sans-serif;
            font-weight: <?php echo esc_attr($top_news_menu_font_weight); ?>;
            font-style: <?php echo esc_attr($top_news_menu_font_style); ?>;
            text-transform: <?php echo esc_attr($top_news_menu_transform); ?>;
        }
        .cat-tag, .primary-menu .menu-container > .menu-inside > .nav > li > a:hover, .primary-menu .menu-container > .menu-inside > .nav > li > a:focus,.primary-menu .menu-container > .menu-inside > .nav > li.dropdown:hover > a, .primary-menu .menu-container > .menu-inside > .nav > li.menu-item-has-children:hover > a,.primary-menu .menu-container > .menu-inside > .nav > li.mega-menu:hover>a, a.readmore:hover, .tagcloud > a:hover,.primary-menu.plain-v2 .menu-container > .menu-inside,.swiper-button-prev, .swiper-button-next, .taglist > li > a:hover,.comment-respond > form > .form-submit input[type="submit"],.breking-news-ticker > .control > i:hover,.primary-menu .menu-container > .menu-inside > .nav > li.current-menu-item > a,.primary-menu .menu-container > .menu-inside > .nav > li.active > a, .menu-inside .nav li.current-menu-ancestor>a:not(.mega-links-head), .navigation.pagination > .nav-links > a:hover,.primary-menu.plain-v2.v6 .menu-container > .menu-inside,.primary-menu .menu-container>.menu-inside>.nav>li.current-menu-ancestor>a:before,.primary-menu.v5 .menu-container > .menu-inside .search-area > i,.navigation.pagination > .nav-links span.current,.shortcode-gallery-container .tn-gallery-item > .overlay .action:hover, .primary-menu .menu-container > .menu-inside .nav .current-menu-ancestor .menu-item.current-menu-item a,.primary-menu .menu-container > .menu-inside > .nav > li ul.sub-menu > li > a:hover,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.widget .woocommerce-product-search input[type="submit"],#bbp_search_submit,span.popularity-icon,.top-area3 .top-bar-menu>li:hover>a,.top-area3 .top-bar-menu li .sub-menu,#TB_ajaxContent .login-form-container form#loginform input[type="submit"],#TB_ajaxContent form#signupform input[type="submit"],.vp_login .register-form-container form#signupform input[type="submit"],.vp_login .login-form-container form#loginform input[type="submit"],#password-lost-form #lostpasswordform input[type="submit"],#TB_ajaxContent form#lostpasswordform input[type="submit"],.share-icon,.block-post-load .load-more,.sh-style6 .widget-title {
            background-color: <?php echo esc_attr($top_news_theme_color); ?>;
        }
        a:hover, a:focus, .small-posts-list > li > .content > .meta > a, .breking-news-ticker > ul > li > span, .meta > a, .social-icons > li > a:hover, .mega-menu-post .post-box-title a:hover, .mega-recent-post .post-box-title a:hover, .primary-menu.plain-v2 .menu-container > .menu-inside > .nav > li.mega-menu:hover > a, .primary-menu.plain-v2 .menu-container > .menu-inside > .nav > li.mega-menu:hover > a::after,.primary-menu.plain-v2 .menu-container > .menu-inside > ul > li.dropdown > a:hover, .primary-menu.plain-v2 .menu-container > .menu-inside > ul > li > a:hover,.primary-menu.plain-v2 .menu-container > .menu-inside > .nav > li.dropdown:hover > a, .primary-menu.plain-v2 .menu-container > .menu-inside > .nav > li.menu-item-has-children:hover > a,.post-share.social-icons > li > a:hover,.post-navigation > .nav-item > a:hover, .primary-menu.plain-v2 .menu-container > .menu-inside > .nav > li.current-menu-ancestor.dropdown > a, .primary-menu.plain-v2 .menu-container > .menu-inside > .nav > li.current-menu-ancestor.menu-item-has-children > a,.primary-menu.plain-v2 .menu-container > .menu-inside > ul > li.current-menu-ancestor.mega-menu>a:after, .primary-menu.plain-v2 .menu-container > .menu-inside > ul > li.current-menu-ancestor .menu-item-has-children>a:after,.primary-menu.plain-v2 .menu-container > .menu-inside > .nav > li.dropdown:hover > a, .primary-menu.plain-v2 .menu-container > .menu-inside > .nav > li.menu-item-has-children:hover > a:after,.site-footer.dark a:hover, .fixed-v3 .primary-menu.plain-v2 .menu-container > .menu-inside > ul > li.current-menu-item > a,.error-content p a, .error-content .number .opps, .navigation.pagination > .nav-links span.current,.site-header.fixed-v3 .middle-area .content a:hover, .posts-lists .post-item.sticky > .content > .title a,.quick-nav ul li i.fa-clock-o,.single-pagination .loading{
            color: <?php echo esc_attr($top_news_theme_color); ?>;
        }
        .timeline-posts > li:after, .flexslider-carousel .slides li.flex-active-slide, .flexslider-carousel2 .slides li.flex-active-slide, .flexslider-carousel3 .slides li.flex-active-slide, .site-header .top-area, .comment-respond > form > .form-submit input[type="submit"],.navigation.pagination > .nav-links span.current, .comment-respond > form > input:focus, .comment-respond > form > textarea:focus,.primary-menu.v4 .menu-sub-content,.primary-menu.v4 .menu-container > .menu-inside > .nav > li > ul, .primary-menu.plain-v2.v5 .menu-container > .menu-inside,.primary-menu.v5 .menu-container > .menu-inside .search-area > .nav-search > input,.primary-menu.v6 .menu-container > .menu-inside .search-area > .nav-search > input,.primary-menu.v5 .menu-container > .menu-inside .search-area > .nav-search > i,.primary-menu.v6 .menu-container > .menu-inside .search-area > .nav-search > i,.shortcode-gallery-container .tn-gallery-item > .overlay .action:hover,.primary-menu .menu-container > .menu-inside > .nav > li > ul{
            border-color: <?php echo esc_attr($top_news_theme_color); ?>;
        }                
        .cat-tag:hover, .primary-menu .menu-container > .menu-inside > .nav > li > a:hover::before,.primary-menu .menu-container > .menu-inside > .nav > li.current-menu-item > a:before, .primary-menu .menu-container > .menu-inside > .nav > li > a:focus::before,.primary-menu .menu-container > .menu-inside > .nav > li.mega-menu:hover>a:before,.primary-menu .menu-container > .menu-inside > .nav > li.dropdown:hover > a:before, .primary-menu .menu-container > .menu-inside > .nav > li.menu-item-has-children:hover > a:before,.swiper-button-prev:hover, .swiper-button-next:hover,.comment-respond > form > .form-submit input[type="submit"]:hover,.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.widget .woocommerce-product-search input[type="submit"]:hover, #bbp_search_submit:hover,.top-area3 .top-bar-menu li .sub-menu li>a:hover,#TB_ajaxContent .login-form-container form#loginform input[type="submit"]:hover,#TB_ajaxContent form#signupform input[type="submit"]:hover,.vp_login .register-form-container form#signupform input[type="submit"]:hover,.vp_login .login-form-container form#loginform input[type="submit"]:hover,#password-lost-form #lostpasswordform input[type="submit"]:hover,#TB_ajaxContent form#lostpasswordform input[type="submit"]:hover{
            background-color: <?php echo esc_attr($top_news_theme_hover_color); ?>;
        }
        .meta > a:hover, .small-posts-list > li > .content > .meta > a:hover{
            color: <?php echo esc_attr($top_news_theme_hover_color); ?>;
        }
        .comment-respond > form > .form-submit input[type="submit"]:hover{
            border: 1px solid <?php echo esc_attr($top_news_theme_hover_color); ?>;
        }
        span.popularity-icon:before{
            border-right: 15px solid <?php echo esc_attr($top_news_theme_color); ?>;
        }
        .share-icon:before{
            border-right: 10px solid <?php echo esc_attr($top_news_theme_color); ?>;
        }
        .primary-sidebar {
            background-color: <?php echo esc_attr($tn_theme_sidebar_bg_color); ?>;
        }
        .site-footer.dark {
            background-color: <?php echo esc_attr($tn_theme_footer_top_bg_color); ?>;
        }
        .site-footer.dark {
            background-color: <?php echo esc_attr($tn_theme_footer_top_bg_color); ?>;
        }
        .site-footer .dark2 {
            background-color: <?php echo esc_attr($tn_theme_copy_footer_bg_color); ?>;
        }
        .site-header .top-area3 {
            background-color: <?php echo esc_attr($tn_top_bar_bg_color); ?>;
        }
        .top-area3 .top-bar-menu li a, .site-header .top-area3 .account-social .account-links, .site-header .top-area3 .account-social .account-links a, .site-header .top-area3 .account-social .social-icons > li > a, .site-header .top-area3 .account-social .account-links > span, .top-area3 .top-bar-menu.date-time li{
            color: <?php echo esc_attr($tn_top_bar_font_color); ?>;
        }
        .top-area3 .top-bar-menu li.menu-item-has-children > a::after{
            border-bottom: 2px solid <?php echo esc_attr($tn_top_bar_font_color); ?>;
            border-right: 2px solid <?php echo esc_attr($tn_top_bar_font_color); ?>;
        }
        .header-news-world.dark .header-top {
            background-color: <?php echo esc_attr($header8_header_bg_color); ?>;
        }
        .header-news-world.light .header-top {
            background-color: <?php echo esc_attr($header9_header_bg_color); ?>;
        }
        .header-news-world .primary-menu {
            background-color: <?php echo esc_attr($header8_menu_bg_color); ?>;
        }
        .quick-post-menu li a i {
            color: <?php echo esc_attr($header8_menu_bg_color); ?>;
        }
        <?php
        if (!empty($tn_custom_css)){
            echo wp_kses_post($tn_custom_css);
        }
        ?>
    </style>
    <?php    
}
if (function_exists('cs_get_option')):
    wp_enqueue_style('top-news-fonts', top_news_fonts_url());
    add_action('wp_head' , 'top_news_custom_header');
endif;