<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Social_Profiles extends Top_News_Widget
{
    public function __construct()
    {
        parent::__construct(
            'tn_social_counters',
            esc_html__('TopNews :: Social Counters', 'top-news'),
            array('description' => 'Display your social profiles with followers count.' )
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
            <ul class="social-followers">
                <?php if (!empty($instance['fb-count'])): ?>
                <li>
                    <a href="<?php echo esc_url($instance['fb-link']); ?>" title="<?php echo esc_html('Facebook','top-news'); ?>">
                        <i class="fa fa-facebook"></i>
                        <span class="name"><?php echo esc_attr($instance['fb-count']); ?></span>
                        <span class="title"><?php echo esc_attr($instance['fb-info']); ?></span>
                    </a>
                </li>
                <?php endif; ?>
                
                <?php if (!empty($instance['twt-count'])): ?>
                <li>
                    <a href="<?php echo esc_url($instance['twt-link']); ?>" title="<?php echo esc_html('Twitter','top-news'); ?>">
                        <i class="fa fa-twitter"></i>
                        <span class="name"><?php echo esc_attr($instance['twt-count']); ?></span>
                        <span class="title"><?php echo esc_attr($instance['twt-info']); ?></span>
                    </a>
                </li>
                <?php endif; ?>
                
                <?php if (!empty($instance['li-count'])): ?>
                <li>
                    <a href="<?php echo esc_url($instance['li-link']); ?>" title="<?php echo esc_html('Linked In','top-news'); ?>">
                        <i class="fa fa-linkedin"></i>
                        <span class="name"><?php echo esc_attr($instance['li-count']); ?></span>
                        <span class="title"><?php echo esc_attr($instance['li-info']); ?></span>
                    </a>
                </li>
                <?php endif; ?>
                
                <?php if (!empty($instance['gp-count'])): ?>
                <li>
                    <a href="<?php echo esc_url($instance['gp-link']); ?>" title="<?php echo esc_html('Google Plus','top-news'); ?>">
                        <i class="fa fa-google-plus"></i>
                        <span class="name"><?php echo esc_attr($instance['gp-count']); ?></span>
                        <span class="title"><?php echo esc_attr($instance['gp-info']); ?></span>
                    </a>
                </li>
                <?php endif; ?>
                
                <?php if (!empty($instance['dr-count'])): ?>
                <li>
                    <a href="<?php echo esc_url($instance['dr-link']); ?>" title="<?php echo esc_html('Dribble','top-news'); ?>">
                        <i class="fa fa-dribbble"></i>
                        <span class="name"><?php echo esc_attr($instance['dr-count']); ?></span>
                        <span class="title"><?php echo esc_attr($instance['dr-info']); ?></span>
                    </a>
                </li>
                <?php endif; ?>
                
                <?php if (!empty($instance['pin-count'])): ?>
                <li>
                    <a href="<?php echo esc_url($instance['pin-link']); ?>" title="<?php echo esc_html('Pinterest','top-news'); ?>">
                        <i class="fa fa-pinterest"></i>
                        <span class="name"><?php echo esc_attr($instance['pin-count']); ?></span>
                        <span class="title"><?php echo esc_attr($instance['pin-info']); ?></span>
                    </a>
                </li>
                <?php endif; ?>
                
                <?php if (!empty($instance['insta-count'])): ?>
                <li>
                    <a href="<?php echo esc_url($instance['insta-link']); ?>" title="<?php echo esc_html('Pinterest','top-news'); ?>">
                        <i class="fa fa-instagram"></i>
                        <span class="name"><?php echo esc_attr($instance['insta-count']); ?></span>
                        <span class="title"><?php echo esc_attr($instance['insta-info']); ?></span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>            
        <?php
        echo $args['after_widget'];
    }

    function get_options()
    {
        return array(
            array(
                'id'      => 'title',
                'type'    => 'text',
                'title'   => 'Widget Title:',
            ),
            array(
                'id'      => 'fb-title',
                'type'    => 'heading',
                'content'   =>  esc_html__('Facebook', 'top-news'),
            ),
            array(
                'id'          => 'fb-count',
                'type'        => 'text',
                'title'       => esc_html__('Counter', 'top-news'),
            ),
            array(
                'id'          => 'fb-info',
                'type'        => 'text',
                'title'       => esc_html__('Info', 'top-news'),
            ),            
            array(
                'id'          => 'fb-link',
                'type'        => 'text',
                'title'       => esc_html__('Profile Link', 'top-news'),
            ),            
            array(
                'id'      => 'twt-title',
                'type'    => 'heading',
                'content'   =>  esc_html__('Twitter', 'top-news'),
            ),
            array(
                'id'          => 'twt-count',
                'type'        => 'text',
                'title'       => esc_html__('Counter', 'top-news'),
            ),
            array(
                'id'          => 'twt-info',
                'type'        => 'text',
                'title'       => esc_html__('Info', 'top-news'),
            ),            
            array(
                'id'          => 'twt-link',
                'type'        => 'text',
                'title'       => esc_html__('Profile Link', 'top-news'),
            ),           
            array(
                'id'      => 'li-title',
                'type'    => 'heading',
                'content'   =>  esc_html__('Linked In', 'top-news'),
            ),
            array(
                'id'          => 'li-count',
                'type'        => 'text',
                'title'       => esc_html__('Counter', 'top-news'),
            ),
            array(
                'id'          => 'li-info',
                'type'        => 'text',
                'title'       => esc_html__('Info', 'top-news'),
            ),            
            array(
                'id'          => 'li-link',
                'type'        => 'text',
                'title'       => esc_html__('Profile Link', 'top-news'),
            ),           
            array(
                'id'      => 'gp-title',
                'type'    => 'heading',
                'content'   =>  esc_html__('Google Plus', 'top-news'),
            ),
            array(
                'id'          => 'gp-count',
                'type'        => 'text',
                'title'       => esc_html__('Counter', 'top-news'),
            ),
            array(
                'id'          => 'gp-info',
                'type'        => 'text',
                'title'       => esc_html__('Info', 'top-news'),
            ),            
            array(
                'id'          => 'gp-link',
                'type'        => 'text',
                'title'       => esc_html__('Profile Link', 'top-news'),
            ),           
            array(
                'id'      => 'dr-title',
                'type'    => 'heading',
                'content'   =>  esc_html__('Dribble', 'top-news'),
            ),           
            array(
                'id'          => 'dr-count',
                'type'        => 'text',
                'title'       => esc_html__('Counter', 'top-news'),
            ),
            array(
                'id'          => 'dr-info',
                'type'        => 'text',
                'title'       => esc_html__('Info', 'top-news'),
            ),            
            array(
                'id'          => 'dr-link',
                'type'        => 'text',
                'title'       => esc_html__('Profile Link', 'top-news'),
            ),           
            array(
                'id'      => 'pin-title',
                'type'    => 'heading',
                'content'   =>  esc_html__('Pinterest', 'top-news'),
            ),
            array(
                'id'          => 'pin-count',
                'type'        => 'text',
                'title'       => esc_html__('Counter', 'top-news'),
            ),
            array(
                'id'          => 'pin-info',
                'type'        => 'text',
                'title'       => esc_html__('Info', 'top-news'),
            ),            
            array(
                'id'          => 'pin-link',
                'type'        => 'text',
                'title'       => esc_html__('Profile Link', 'top-news'),
            ),           
            array(
                'id'      => 'insta-title',
                'type'    => 'heading',
                'content'   =>  esc_html__('Instagram', 'top-news'),
            ),
            array(
                'id'          => 'insta-count',
                'type'        => 'text',
                'title'       => esc_html__('Counter', 'top-news'),
            ),
            array(
                'id'          => 'insta-info',
                'type'        => 'text',
                'title'       => esc_html__('Info', 'top-news'),
            ),            
            array(
                'id'          => 'insta-link',
                'type'        => 'text',
                'title'       => esc_html__('Profile Link', 'top-news'),
            ),           
        );
    }
}