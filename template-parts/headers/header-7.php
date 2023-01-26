<?php if (! defined('ABSPATH')) die('Direct access forbidden.');
/**
 * Template part for displaying Header.
 *
 * @package TopNews
 */
$top_news_logo_opt = $top_news_logo_url = $tn_viral_menu_class = $header7_quick_menus = $$header7_reaction_menus = '';

if (function_exists('cs_get_option')):
    $top_news_logo_opt = cs_get_option('site_logo');
    $tn_viral_menu = cs_get_option('tn_viral_menu');
    
    $header7_quick_menus = cs_get_option('header7_quick_menu');
    $header7_reaction_menus = cs_get_option('header7_reaction_menu');
    
    if (!empty($tn_viral_menu)){
        switch($tn_viral_menu):
            case '2':
                $tn_viral_menu_class = 'plain-v2 v4';
            break;
            case '3':
                $tn_viral_menu_class = 'plain-v2 v5';
            break;
            case '4':
                $tn_viral_menu_class = 'plain-v2 v6';
            break;
        endswitch;
    }
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
                        <?php if (!empty($top_news_logo_url)): ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo esc_url($top_news_logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        </a>
                        <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>"><h1 class="site-title"><?php echo get_bloginfo() ?></h1></a>
                        <?php endif; ?>
                    </div><!-- /#logo -->
                </div>
                <div class="col-md-9 col-sm-8">
                    <div class="popular-imo">
                        <?php if (! empty($header7_quick_menus)): ?>
                        <div class="post-popularity">
                            <ul>
                                <?php foreach($header7_quick_menus as $header7_quick_menu) : ?>
                                <li><a href="<?php echo esc_url($header7_quick_menu['menu_url']); ?>">
                                        <span class="popularity-icon"><i class="<?php echo esc_attr($header7_quick_menu['menu_icon']); ?>"></i></span>
                                    <span class="popularity-content">
                                        <h5><?php echo esc_html($header7_quick_menu['menu_name']); ?></h5>
                                    </span>
                                    </a>
                                </li>                                
                                <?php endforeach; ?>                                                              
                            </ul>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (! empty($header7_reaction_menus)): ?>
                        <div class="imo">
                            <ul>
                                <?php foreach($header7_reaction_menus as $header7_reaction_menu) : ?>
                                <li><a href="<?php echo esc_url($header7_reaction_menu['menu_url']); ?>">
                                        <span><img class="reaction-img" src="<?php echo esc_url($header7_reaction_menu['menu_icon']) ?>" alt="<?php echo esc_attr($header7_reaction_menu['menu_icon']) ?>"></span>
                                    <h5><?php echo esc_html($header7_reaction_menu['menu_name']) ?></h5>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>                                   
                </div>
            </div>
        </div><!-- /.container -->
    </div><!-- /.logo-ads-area -->
    <!-- Primary Menu -->
    <div id="primary-menu" class="primary-menu <?php echo $tn_viral_menu_class ?>">
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
