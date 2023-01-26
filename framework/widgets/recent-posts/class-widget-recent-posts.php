<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Recent_Posts extends Top_News_Widget
{
    public function __construct()
    {
        parent::__construct(
            'tn_recent_posts',
            esc_html__('TopNews :: Recent Posts', 'top-news'),
            array('description' => 'Display recent or term-targeted posts..' )
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
        if ( $instance['post_from'] == 'category' && ! empty( $instance['posts_cat'] ) ) {
            $query_args = array(
                'post_type' => 'post',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'term_id',
                        'terms'    => $instance['posts_cat'],
                    ),
                ),
                'posts_per_page'      =>  $limit,
                'ignore_sticky_posts' => true,
            );
        } else if ($instance['post_from'] == 'tag' && ! empty( $instance['posts_tag'] )) {
            $query_args = array(
                'post_type' => 'post',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'post_tag',
                        'field'    => 'term_id',
                        'terms'    => $instance['posts_tag'],
                    ),
                ),
                'posts_per_page'      =>  $limit,
                'ignore_sticky_posts' => true,
            );
        } else {
            $query_args = array(
                'post_type' => 'post',
                'posts_per_page'      =>  $limit,
                'ignore_sticky_posts' => true,
            );
        }

        $the_query = new WP_Query( $query_args );
        if ( $the_query->have_posts() ) : ?>
            <?php if ($instance['post_style'] == 'left-thumb') : ?>
            <ul class="small-posts-list">
                <?php 
                    while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                ?>                
                <li class="item has-post-thumbnail">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumb">
                            <a href="<?php the_permalink();?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                            <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                            <?php endif; ?>                            
                        </div><!-- /.thumbnail -->
                    <?php else : ?>
                        <div class="post-thumb">
                            <a href="<?php the_permalink();?>">
                                <img src="<?php echo esc_url( TOPNEWS_ASSETS . '/img/thumb.jpg'); ?>" alt="<?php the_title();?>">
                            </a>
                            <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                            <?php endif; ?>
                        </div><!-- /.thumbnail -->
                    <?php endif; ?>
                    <div class="content">
                        <h4 class="title">
                            <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                        </h4>
                        <div class="meta">
                            <?php if (function_exists('wp_review_show_total')): wp_review_show_total(); endif;?>
                            <?php echo get_the_date() ?>
                        </div>
                    </div><!-- /.content -->
                </li>               
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            </ul>
            <?php endif; ?>
            
            <?php if ($instance['post_style'] == 'top-thumb') : ?>
                <div class="row">
                    <div class="small-posts-list">
                    <?php 
                        while ( $the_query->have_posts() ) : $the_query->the_post(); 
                        $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                    ?>
                        <article class="post-item col-md-12 col-sm-6">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumb">
                                <a href="<?php the_permalink();?>">
                                    <?php the_post_thumbnail('top-news-thumbnail-x2'); ?>
                                </a>
                                <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                    <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                                <?php endif; ?> 
                            </div><!-- /.thumbnail -->
                            <?php endif; ?>
                            <div class="content">
                                <h4 class="title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                                </h4>
                                <div class="meta">
                                    <?php if (function_exists('wp_review_show_total')): wp_review_show_total(); endif;?>
                                    <?php echo get_the_date() ?>
                                </div>
                            </div><!-- /.content -->
                        </article><!-- /.post-item -->                         
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($instance['post_style'] == 'stylish') : ?>
                <div class="row">
                    <div class="small-posts-list featured-posts">
                    <?php 
                        while ( $the_query->have_posts() ) : $the_query->the_post(); 
                        $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                    ?>
                        <article class="post-item col-md-12 col-sm-6">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumb">
                                <a href="<?php the_permalink();?>">
                                    <?php the_post_thumbnail('top-news-thumbnail-x2'); ?>
                                </a>
                                <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                    <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                                <?php endif; ?> 
                            </div><!-- /.thumbnail -->
                            <?php endif; ?>
                            <div class="post-info">
                                <h4 class="title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                                </h4>
                                <div class="meta"><?php echo get_the_date() ?></div>
                            </div><!-- /.content -->
                        </article><!-- /.post-item -->                        
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>


            <div class="clearfix"></div>
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
            array(
                'id'           => 'post_style',
                'type'         => 'select',
                'title'        => esc_html__('Post Style', 'top-news'),
                'options'      => array(
                    'left-thumb'     => esc_html__('Thumb on left', 'top-news'),
                    'top-thumb'          => esc_html__('Thumb on top', 'top-news'),
                    'stylish'          => esc_html__('Stylish post', 'top-news')
                ),
                'default'   => 'category',
            ),
            array(
                'id'           => 'post_from',
                'type'         => 'radio',
                'class'        => 'horizontal',
                'title'        => esc_html__('Display Post from?', 'top-news'),
                'options'      => array(
                    'category'     => esc_html__('Category', 'top-news'),
                    'tag'          => esc_html__('Tag', 'top-news')
                ),
                'default'   => 'category',
            ),
            array(
                'id'             => 'posts_cat',
                'type'           => 'select',
                'title'          => esc_html__('Category:', 'top-news'),
                'options'        => 'categories',
                'query_args'     => array(
                    'orderby'      => 'name',
                    'order'        => 'ASC',
                ),
                'default_option' => esc_html__('Select a category', 'top-news'),                
            ),
            array(
                'id'             => 'posts_tag',
                'type'           => 'select',
                'title'          => esc_html__('Tag:', 'top-news'),
                'options'        => 'tag',
                'query_args'     => array(
                    'orderby'      => 'name',
                    'order'        => 'ASC',
                ),
                'default_option' => esc_html__('Select a tag', 'top-news'),                
            ),
        );
    }
}