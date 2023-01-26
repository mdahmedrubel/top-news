<?php if (! defined('ABSPATH')) die('Direct access forbidden.');
$reg_link = '';
$reg_text = '';
$log_link = '';
$log_text = '';
$social_profiles = '';
if (function_exists('cs_get_option')):
    $reg_link = cs_get_option('registration_link');
    $reg_text = cs_get_option('registration_text');
    $log_link = cs_get_option('login_link');
    $log_text = cs_get_option('login_text');
    $social_profiles = cs_get_option('header_social_icons');
endif;
?>
    
    <!-- Top Mini Area -->
    <div class="top-area">
        <div class="container">
            <div class="date-weather pull-left">
                <div class="today-date">
                    <i class="fa fa-clock-o"></i>
                    <strong><?php echo date_i18n('h:i: A'); ?></strong>
                    <span><?php echo date_i18n("l F j, Y")?></span>
                </div><!-- /.today-date -->                
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