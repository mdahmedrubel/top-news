<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Template part for displaying Header.
 *
 * @package TopNews
 */
$top_news_logo_opt = '';

if (function_exists('cs_get_option')):
    $top_news_logo_opt = cs_get_option('site_logo');
endif;
$class = '';
$class2 = '';
if( ! is_home() && ! is_front_page() && ! is_page() ) {
    $class .= 'fixed-v2';
} else {
    $class2 .= 'transparent';
    $class .= 'fixed';
}
?>
<header id="header" class="site-header <?php echo esc_attr($class); ?>">
    <?php         
        if (function_exists('cs_get_option')):
            top_news_top_bar();
        else :
            get_template_part('template-parts/headers/top', '1');
        endif;
    ?>
    <!-- Primary Menu -->
    <div id="primary-menu" class="primary-menu plain dark column-2-menu <?php echo esc_attr($class2); ?>">
        <div class="container">

            <!-- Menu Links -->
            <div class="menu-container">
                <div class="menu-inside">
                    <?php
                    if ( has_nav_menu( 'top_mini_left' ) ):
                        wp_nav_menu( array( 
                            'menu_id' => 'top-mini-left', 
                            'menu_class' => 'nav navbar-nav pull-left', 
                            'container' => false,
                            'theme_location' => 'top_mini_left', 
                            'walker' => new top_news_mega_menu_walker(), 
                            'fallback_cb'=> false) );
                    endif;
                    ?>

                    <?php                  
                    if (! empty($top_news_logo_opt)) {
                        $top_news_logo_url = wp_get_attachment_url($top_news_logo_opt);
                    }
                    ?>
                    <?php if (!empty($top_news_logo_opt)): ?>
                    <a id="logo" href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo esc_url($top_news_logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>"><h1 class="site-title"><?php echo get_bloginfo() ?></h1></a>
                    <?php endif; ?>
                    <?php
                    if ( has_nav_menu( 'top_mini_right' ) ):
                        wp_nav_menu( array( 
                            'menu_id' => 'top-mini-right', 
                            'menu_class' => 'nav navbar-nav pull-right right-search', 
                            'container' => false,
                            'theme_location' => 'top_mini_right', 
                            'walker' => new top_news_mega_menu_walker(), 
                            'fallback_cb'=> false) 
                        );                        
                    ?>
                    <div class="search-area">
                        <?php get_search_form() ?>
                    </div><!-- /.search-area -->
                    <?php endif; ?>
                </div><!-- /.menu-inside -->
            </div><!-- /.navbar-collapse -->

        </div><!-- /.container -->
    </div><!-- /#primary-menu -->

</header><!-- /#header -->
