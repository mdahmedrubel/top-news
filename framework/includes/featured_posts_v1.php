<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
function top_news_featured_posts_v1($top_news_post_from, $cat, $tag, $limit) {
    if ($top_news_post_from === "all") {
        $query_args = array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      =>  $limit,
            'ignore_sticky_posts' => true,
        );        
    } else if($top_news_post_from === "tag" && !empty($tag) ) {
        $query_args = array(
            'post_type'           => 'post',
            'tag__in'             => $tag,
            'post_status'         => 'publish',
            'posts_per_page'      =>  $limit,
            'ignore_sticky_posts' => true,
        );
    } else if($top_news_post_from === "category" && !empty($cat) ) {
        $query_args = array(
            'post_type'           => 'post',
            'category__in'        => $cat,
            'post_status'         => 'publish',
            'posts_per_page'      =>  $limit,
            'ignore_sticky_posts' => true,
        );
    } else {
        $query_args = array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      =>  $limit,
            'ignore_sticky_posts' => true,
        );
    }
    $the_query = new WP_Query( $query_args );
    if ( $the_query->have_posts() ) : ?>
        <div id="featured-news" class="gray-bg">
            <div class="container">
                <!-- Featured Posts -->
                <div class="featured-posts clearfix">
                    <?php
                        $count = 0;
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                            $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                            $class = '';
                            $class_x2 = '';
                            $thumb_size = '';
                            if( $count == 0 ) {
                                $class .= 'col-sm-6';
                                $class_x2 .= 'special x2 v1';
                                $thumb_size .= 'top-news-gallery-wide';
                            } else if ( $count == 1 ){
                                $class .= 'col-sm-6';
                                $class_x2 .= 'special x2 v1';
                                $thumb_size .= 'top-news-gallery-wide';
                            } else {
                                $class .= 'col-md-3 col-sm-6';
                                $thumb_size .= 'top-news-thumbnail-featured';
                            }
                        ?>
                        <div class="<?php echo esc_attr($class); ?>">
                            <div class="row">
                                <article class="post-item <?php echo esc_attr($class_x2); ?>">
                                    <div class="post-thumb">
                                        <a href="<?php the_permalink();?>">
                                            <?php the_post_thumbnail($thumb_size); ?>
                                        </a>
                                        <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                            <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                                        <?php endif; ?>
                                    </div><!-- /.thumbnail -->
                                    <div class="cat-tag-list"><?php top_news_get_terms_link('category'); ?></div>
                                    <div class="post-info">
                                        <?php top_news_share_count(); ?>
                                        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php  the_title(); ?></a>
                                        </h2>
                                        <div class="meta">
                                            <?php if (function_exists('wp_review_show_total')): wp_review_show_total(); endif;?>
                                            <span><?php esc_html__('Posted by', 'top-news'); ?> <strong><?php echo get_the_author(); ?></strong></span>
                                            <span>-</span>
                                            <span><?php echo get_the_date(); ?></span>
                                        </div><!-- /.meta -->
                                    </div><!-- /.post-info -->

                                </article><!-- /.post-item -->
                            </div><!-- /.row -->
                        </div><!-- /.col-sm-8 -->

                    <?php
                        $count++;
                        endwhile;
                        wp_reset_postdata(); ?>
                </div><!-- /.featured-posts -->
            </div><!-- /.container -->
        </div><!-- /#featured-news -->

    <?php else :
    endif;
}