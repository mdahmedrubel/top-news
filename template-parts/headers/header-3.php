<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Template part for displaying Header.
 *
 * @package TopNews
 */
$top_news_logo_opt = $reg_link = $reg_text = $log_link = $log_text = '';

if (function_exists('cs_get_option')):
    $top_news_logo_opt = cs_get_option('site_logo');
    $reg_link = cs_get_option( 'registration_link' );
    $reg_text = cs_get_option( 'registration_text' );
    $log_link = cs_get_option( 'login_link' );
    $log_text = cs_get_option( 'login_text' );    
endif;
?>
<!--==============================
=            Header            =
==============================-->
<header id="header" class="site-header transparent fixed-v3">
    <!-- Logo and Search (Middle) -->
    <div class="middle-area">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div id="logo">
                            <?php                            
                                if (! empty($top_news_logo_opt)) {
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
                    </div><!-- /.col-md-4 -->

                    <div class="col-md-3 col-md-offset-3">
                        <div class="search-form-area">
                            <?php top_news_search_from_h3() ?>
                        </div><!-- /.search-area -->
                    </div><!-- /.col-md-4 -->

                    <div class="col-md-2">
                        <div class="account-links">
                            <?php if (is_user_logged_in()):
                                $current_user = wp_get_current_user();
                                echo esc_html('Hello,','topnews').' '.$current_user->display_name ;
                            else : ?>
                            <?php if (!empty($log_text)): ?>
                            <a href="<?php echo esc_url($log_link); ?>"><?php echo esc_attr($log_text); ?></a>
                            <?php endif; ?>
                            <?php if (!empty($reg_text)): ?>
                            <span>or</span>
                            <a href="<?php echo esc_url($reg_link); ?>"><?php echo esc_attr($reg_text); ?></a>
                            <span class="top-bar-sep">|</span>
                            <?php endif; ?>
                            <?php endif; ?>                    
                        </div><!-- /.account-links -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.content -->
        </div><!-- /.container -->

    </div><!-- /.middle-area -->

    <!-- Primary Menu -->
    <div id="primary-menu" class="primary-menu plain-v2">
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
                </div><!-- /.menu-inside -->
                <?php endif; ?>
            </div><!-- /.navbar-collapse -->

        </div><!-- /.container -->
    </div><!-- /#primary-menu -->

</header><!-- /#header -->