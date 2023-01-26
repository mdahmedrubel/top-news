<?php if (! defined('ABSPATH')) die('Direct access forbidden.');
/**
 * Template part for displaying Header.
 *
 * @package TopNews
 */
$top_news_logo_opt = $top_news_logo_url = $header7_quick_menus = '';

if (function_exists('cs_get_option')):
    $top_news_logo_opt = cs_get_option('site_logo');    
    $header7_quick_menus = cs_get_option('header7_quick_menu');
    
endif;
?>
<!--==============================
=            Header            =
==============================-->
<header id="header" class="site-header header-news-world dark">
    <?php         
        if (function_exists('cs_get_option')):
            top_news_top_bar();
        else :
            get_template_part('template-parts/headers/top', '1');
        endif;
    ?>
    <!-- Logo and Ads (Middle) -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <?php if (! empty($header7_quick_menus)): ?>
                    <ul class="quick-post-menu col-md-4">
                        <?php foreach($header7_quick_menus as $header7_quick_menu) : ?>
                        <li><a href="<?php echo esc_url($header7_quick_menu['menu_url']); ?>">
                            <i class="<?php echo esc_attr($header7_quick_menu['menu_icon']); ?>" aria-hidden="true"></i>
                            <span><?php echo esc_html($header7_quick_menu['menu_name']); ?></span>
                            </a>
                        </li>                                
                        <?php endforeach; ?>                                                              
                    </ul>                    
                <?php endif; ?>                
                <div class=" logo col-md-4">
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
                </div><!-- /.logo -->

                <div class="search-world pull-right col-md-4">
                    <div class="search-from">
                        <?php echo get_search_form() ?>
                    </div>
                </div><!-- /#banner-ads -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.logo-ads-area -->   
    <!-- Primary Menu -->
    <div id="primary-menu" class="primary-menu plain-v2 v8">
        <div class="container">

            <!-- Menu Links -->
            <div class="menu-container">
                <?php if (has_nav_menu('primary')): ?>
                <div class="menu-inside">
                    <?php
                    wp_nav_menu(array(
                        'menu_id' => 'main-menu', 
                        'menu_class' => 'nav navbar-nav', 
                        'container' => false,
                        'theme_location' => 'primary', 
                        'walker' => new top_news_mega_menu_walker(), 
                        'fallback_cb'=> false)
                    );
                    ?>
                </div><!-- /.menu-inside -->
                <?php endif; ?>
            </div><!-- /.navbar-collapse -->

        </div><!-- /.container -->
    </div><!-- /#primary-menu -->

</header><!-- /#header -->
