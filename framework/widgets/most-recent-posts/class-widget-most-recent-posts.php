<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Most_Recent_Posts extends Top_News_Widget {
    public function __construct()
    {
        parent::__construct(
            'tn_most_recent_posts',
            esc_html__('TopNews :: Most Recent Posts', 'top-news'),
            array('description' => 'Display most recent post' )
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
        if (is_single()){
            $query_args = array(
                'posts_per_page' => $limit,
                'ignore_sticky_posts' => true,
                'post__not_in' => array(get_the_ID())
            );
        } else {
            $query_args = array(
                'posts_per_page' => $limit,
                'ignore_sticky_posts' => true,
            );
        }

        $the_query = new WP_Query( $query_args );
        if ( $the_query->have_posts() ) : ?>
            <ul class="small-posts-list">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php if ($instance['post_style'] == 'left-thumb') : ?>
                <li class="item has-post-thumbnail">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumb">
                            <a href="<?php the_permalink();?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                        </div><!-- /.thumbnail -->
                    <?php endif; ?>
                    <div class="content">
                        <h4 class="title">
                            <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                        </h4>
                        <div class="meta"><?php echo get_the_date() ?></div>
                    </div><!-- /.content -->
                </li>
                <?php endif; ?>
                <?php if ($instance['post_style'] == 'top-thumb') : ?>
                    <article class="post-item">
                        <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumb">
                            <a href="<?php the_permalink();?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                        </div><!-- /.thumbnail -->
                        <?php endif; ?>
                        <div class="content">
                            <h4 class="title">
                                <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                            </h4>
                            <div class="meta"><?php echo get_the_date() ?></div>
                        </div><!-- /.content -->
                    </article><!-- /.post-item -->                
                <?php endif; ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            </ul>
        <?php else : ?>
            <p><?php esc_html__( 'Sorry, no posts matched your criteria.' , 'top-news'); ?></p>
        <?php endif; ?>


        <?php
        echo $args['after_widget'];
    }

    function get_options() {
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
            array(
                'id'           => 'post_style',
                'type'         => 'select',
                'title'        => esc_html__('Post Style', 'top-news'),
                'options'      => array(
                    'left-thumb'     => esc_html__('Thumb on left', 'top-news'),
                    'top-thumb'          => esc_html__('Thumb on top', 'top-news')
                ),
                'default'   => 'left-thumb',
            ),            
        );
    }
}