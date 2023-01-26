<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Sponsor extends Top_News_Widget
{
    public function __construct()
    {
        parent::__construct(
            'tn_sponsor',
            esc_html__('TopNews :: Sponsor', 'top-news'),
            array('description' => 'Display your ads.' )
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

        <?php if( ! empty($instance['sponsor_content']) ) : ?>
            <div class="content">
                <?php echo wp_kses_post($instance['sponsor_content']); ?>                
            </div>
        <?php endif; ?>

        <?php if( ! empty($instance['sponsor_image']) && empty($instance['content']) ) : ?>
            <div class="content">
                <a href="<?php echo wp_kses_post($instance['sponsor_link']); ?>" <?php if($instance['sponsor_newtab'] == '1') : echo 'target="_blank"'; endif; ?>>
                    <img src="<?php echo wp_kses_post($instance['sponsor_image']); ?>" alt="" class="img-responsive">
                </a>
            </div>
        <?php endif; ?>
        <?php
        echo $args['after_widget'];
    }

    function get_options()
    {
        return array(
            array(
                'id'      => 'title',
                'type'    => 'text',
                'title'   => esc_html__('Title:', 'top-news')
            ),
            array(
                'id'            => 'sponsor_image',
                'type'          => 'upload',
                'title'         => esc_html__('Upload Image', 'top-news'),
                'settings'      => array(
                    'upload_type'  => 'image',
                    'button_title' => 'Upload',
                    'frame_title'  => 'Select an image',
                    'insert_title' => 'Use this image',
                  ),
            ),
            array(
                'id'      => 'sponsor_link',
                'type'    => 'text',
                'title'   => esc_html__('Sponsor Link:', 'top-news')
            ),
            array(
              'id'      => 'sponsor_newtab',
              'type'    => 'checkbox',
              'title'   => esc_html__('Checkbox Field', 'top-news'),
              'label'   =>  esc_html__('Open links in a new window', 'top-news'),
            ),            
            array(
                'id'      => 'sponsor_content',
                'type'    => 'textarea',
                'title'   => esc_html__('Ad Codes', 'top-news')
            ),

        );
    }
}