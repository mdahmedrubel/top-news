<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Timeline extends Top_News_Widget
{
    public function __construct()
    {
        parent::__construct(
            'tn_timeline',
            esc_html__('TopNews :: Timeline', 'top-news'),
            array('description' => 'Display your latest post as timeline.' )
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
        $limit = '';
        if (! empty( $instance['limit'] ) ) {
            $limit .= $instance['limit'];
        } else {
            $limit .= '5';
        }
        $query_args = array(
            'post_type' => 'post',
            'posts_per_page'      =>  $limit,
            'ignore_sticky_posts' => true,
        );

        $the_query = new WP_Query( $query_args );
        if ( $the_query->have_posts() ) : ?>
            <ul class="timeline-posts">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <li>
                        <div class="meta">
                            <span><strong><?php echo get_the_time(); ?></strong></span>
                            <span> - </span>
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                        <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    </li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
        <?php else : ?>
            <p><?php esc_html__( 'Sorry, no posts matched your criteria.' , 'top-news'); ?></p>
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
                'title'   => esc_html__('Title:', 'top-news'),
            ),
            array(
                'id'      => 'limit',
                'type'    => 'number',
                'title'   => esc_html__('Limit Posts:', 'top-news'),
                'default'   => '5'
            ),
        );
    }
}