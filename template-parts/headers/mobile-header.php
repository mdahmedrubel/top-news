<?php 
if (function_exists('cs_get_option')):
    $site_logo = cs_get_option('site_logo');
    $site_logo_mobile = cs_get_option('site_logo_mobile');
endif;
if(! empty($site_logo_mobile)){
    $logo_url = wp_get_attachment_url($site_logo_mobile);
}else if(! empty($site_logo)){
    $logo_url = wp_get_attachment_url($site_logo);
}
?>
<!-- Mobile Menu -->
<div id="mobile-header">
    <div class="head-content">
        <div class="navigation-toggle">
            <i id="navigation-toggle" class="fa fa-bars"></i>
        </div><!-- /.navigation-toggle -->
        <div class="logo-area">
            <?php if (!empty($logo_url)): ?>
                <a class="navbar-logo" href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                </a>
            <?php endif; ?>
        </div><!-- /.logo-area -->

        <div class="search-area mobile-search">
            <?php get_search_form() ?>
        </div><!-- /.search-area -->
    </div><!-- /.head-content -->

    <div id="mobile-menu" class="mobile-menu">
        <?php
        if (has_nav_menu('mobile_menu')):
            wp_nav_menu(
                array(
                    'theme_location' => 'mobile_menu',
                    'menu_id' => 'mobile-primary-menu',
                    'menu_class' => 'nav',
                    'container' => false
               )
            );
        else:
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_id' => 'mobile-primary-menu',
                    'menu_class' => 'nav',
                    'depth' => 1,
                    'container' => false
               )
            );
        endif;
        ?>
    </div><!-- /#mobile-menu -->
    <div class="off-canvas"></div>
</div><!-- /#mobile-menu -->
