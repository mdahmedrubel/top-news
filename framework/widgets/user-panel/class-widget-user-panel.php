<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_User_Panel extends Top_News_Widget
{
    public function __construct()
    {
        parent::__construct(
            'tn_user_panel',
            esc_html__('TopNews :: User Panel', 'top-news'),
            array('description' => 'Display user login form or dashboard link.' )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
        }
    ?>
        <div class="content">
        <?php if (is_user_logged_in()) : ?>
            <?php
                $current_user = wp_get_current_user();
                $user_message = sprintf( esc_html__( 'Welcome %1$s.', 'top-news' ), $current_user->display_name );
            ?>
            <h3 class="title"> <?php echo wp_kses_post( $user_message ); ?> </h3>
        <?php else : ?>
            <?php if (! empty($instance['guest_note'])) : ?>
            <h3 class="title"><?php echo esc_attr($instance['guest_note']); ?></h3>
            <?php endif; ?>
            <form class="login-form" name="loginform" action="<?php echo wp_login_url(); ?>" method="post">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" name="log" class="form-control" placeholder="you@yourmail.com">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="password" name="pwd" class="form-control" placeholder="Password">
                </div>
                <div class="check-submit">
                    <div class="remember">
                        <label for="remember-me">
                            <input type="checkbox" name="rememberme" id="remember-me" checked="1" value="forever">
                            <span><?php esc_html_e( 'Remember Me', 'top-news' ); ?></span>
                        </label>
                    </div>
                    <div class="submit">
                        <input type="hidden" name="redirect_to" value="<?php echo ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                        <button type="submit" name="wp-submit" class="btn btn-default"><?php esc_html_e( 'Sign In', 'top-news' ); ?></button>
                    </div>
                </div>
            </form><!-- /.login-form -->
        <?php endif; ?>
        </div><!-- /.content -->
    <?php
        echo $args['after_widget'];
    }

    function get_options()
    {
        return array(
            array(
                'id'      => 'title',
                'type'    => 'text',
                'title'   => 'Title:',
            ),
            array(
                'id'      => 'guest_note',
                'type'    => 'text',
                'title'   => esc_html__('Guest Note:', 'top-news'),
                'default' => esc_html__('Hi there! Login to get started!', 'top-news'),
            ),
            array(
                'id'      => 'user_note',
                'type'    => 'text',
                'title'   => esc_html__('User Note:', 'top-news'),
                'default' => esc_html__('Here quick links', 'top-news')
            ),
        );
    }
}