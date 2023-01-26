<?php if (! defined('ABSPATH')) die('Direct access forbidden.');
/**
 * Template part for displaying Header.
 *
 * @package TopNews
 */
$top_news_logo_opt = $header_add_code = $header_ads_image = $header_ads_image_url = '';

if (function_exists('cs_get_option')):
    $top_news_logo_opt = cs_get_option('site_logo');
    $header_add_code = cs_get_option('header_add_code');
    $header_ads_image = cs_get_option('header_ads_image');
    $header_ads_image_url = cs_get_option('header_ads_image_url');
endif;
?>
<!--==============================
=            Header            =
==============================-->
<header id="header" class="site-header">    
    <?php         
        if (function_exists('cs_get_option')):
            top_news_top_bar();
        else :
            get_template_part('template-parts/headers/top', '1');
        endif;
    ?>
    <!-- Logo and Ads (Middle) -->
    <div class="logo-ads-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <div id="logo" class="pull-left">
                        <?php                  
                            if (! empty($top_news_logo_opt)){
                                $top_news_logo_url = wp_get_attachment_url($top_news_logo_opt);
                            }
                        ?>
                        <?php if (!empty($top_news_logo_opt)): ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo esc_url($top_news_logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        </a>
                        <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>"><h1 class="site-title"><?php echo get_bloginfo() ?></h1></a>
                        <?php endif; ?>
                    </div><!-- /#logo -->
                </div>
                <div class="col-md-9 col-sm-8">
                    <div id="banner-ads" class="pull-right">
                        <?php
                            if (!empty($header_add_code)){
                                echo $header_add_code;
                            } else if(empty($header_add_code) && !empty($header_ads_image)){
                                echo '<a href="'.$header_ads_image_url.'" target="_blank"><img src="'.$header_ads_image.'" alt="" class="img-responsive ads" /></a>';
                            }
                        ?>
                    </div><!-- /#banner-ads -->                
                </div>
            </div>
        </div><!-- /.container -->
    </div><!-- /.logo-ads-area -->
    <!-- Primary Menu -->
    <div id="primary-menu" class="primary-menu">
        <div class="container">           
            <!-- Menu Links -->
            <div class="menu-container">
                <?php if (has_nav_menu('primary')): ?>
                <div class="menu-inside">
                    <?php
                    wp_nav_menu(array(
                        'menu_id' => 'main-menu', 
                        'menu_class' => 'nav navbar-nav right-search', 
                        'container' => false,
                        'theme_location' => 'primary', 
                        'walker' => new top_news_mega_menu_walker(), 
                        'fallback_cb'=> false)
                    );
                    ?>
                    <div class="search-area">
                        <?php echo get_search_form() ?>
                    </div><!-- /.search-area -->
                </div><!-- /.menu-inside -->
                <?php endif; ?>
            </div><!-- /.navbar-collapse -->            
        </div><!-- /.container -->
    </div><!-- /#primary-menu -->

</header><!-- /#header -->
