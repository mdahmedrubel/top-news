<?php if (! defined('ABSPATH')) die('Direct access forbidden.'); 
$top_news_header_top_bar = '';
$tn_latest_link = '';
$tn_popular_link = '';
$tn_hot_link = '';
$tn_trending_link = '';
$reg_link = '';
$reg_text = '';
$log_link = '';
$log_text = '';
$social_profiles = '';
if (function_exists('cs_get_option')):
    $top_news_header_top_bar = cs_get_option('header_top_bar');
    $tn_latest_link = cs_get_option('tn_latest_link');
    $tn_popular_link = cs_get_option('tn_popular_link');
    $tn_hot_link = cs_get_option('tn_hot_link');
    $tn_trending_link = cs_get_option('tn_trending_link');
    $reg_link = cs_get_option('registration_link');
    $reg_text = cs_get_option('registration_text');
    $log_link = cs_get_option('login_link');
    $log_text = cs_get_option('login_text');
    $social_profiles = cs_get_option('header_social_icons');
endif;
?>
<!-- Top Mini Area -->
    <div class="top-area top-area2">
        <div class="container">
            <div class="quick-nav pull-left">
                <ul class="list-inline">
                    <?php if (!empty($tn_latest_link)): ?>
                    <li><i class="fa fa-clock-o"></i><a href="<?php echo esc_url($tn_latest_link) ?>"><?php esc_html_e('Latest', 'top-news') ?></a></li>
                    <?php endif; ?>
                    <?php if (!empty($tn_popular_link)): ?>
                    <li><i class="fa fa-star-o"></i><a href="<?php echo esc_url($tn_popular_link) ?>"><?php esc_html_e('Popular', 'top-news') ?></a></li>
                    <?php endif; ?>
                    <?php if (!empty($tn_hot_link)): ?>
                    <li><i class="fa fa-fire"></i><a href="<?php echo esc_url($tn_hot_link) ?>"><?php esc_html_e('Hot ', 'top-news') ?></a></li>
                    <?php endif; ?>
                    <?php if (!empty($tn_trending_link)): ?>
                    <li><i class="fa fa-bolt"></i><a href="<?php echo esc_url($tn_trending_link) ?>"><?php esc_html_e('Trending', 'top-news') ?></a></li>
                    <?php endif; ?>
                </ul>
            </div><!-- /.date-weather -->

            <div class="account-social pull-right">
                <div class="account-links">
                    <?php if (is_user_logged_in()):
                        $current_user = wp_get_current_user();
                        echo __('Hello, ', 'top-news').$current_user->display_name;
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
                
                <?php if (!empty($social_profiles)) : ?>
                <div class="social-profiles">
                    <ul class="social-icons">
                        <?php foreach($social_profiles as $profile) : ?>
                        <li><a href="<?php echo esc_url($profile['link']); ?>" title="<?php echo esc_attr($profile['name']); ?>"><i class="<?php echo esc_attr($profile['icon']); ?>"></i></a></li>
                        <?php endforeach; ?>
                    </ul><!-- /.social-icons -->
                </div><!-- /.social-profiles -->
                <?php endif; ?>
            </div><!-- /.account-social -->
        </div><!-- /.container -->
    </div><!-- /.top-area -->