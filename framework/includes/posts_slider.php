<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

function top_news_posts_slider($top_news_post_from, $cat = '', $tag, $limit = 5, $image_size) {
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
    }else {
        $query_args = array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      =>  $limit,
            'ignore_sticky_posts' => true,
        );
    }
    $the_query = new WP_Query( $query_args );
        if ( $the_query->have_posts() ) :
            $unqID = uniqid();
            ?>
            <div id="content-slider-<?php echo esc_attr($unqID); ?>" class="main-slider" data-carousel="swiper" data-autoplay="10000" data-loop="true">

                <div id="content-slider-container-<?php echo esc_attr($unqID); ?>" class="swiper-container" data-swiper="container">
                <div class="swiper-wrapper content-items">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                ?>
                    <div class="swiper-slide item">
                        <div class="slide-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail($image_size, array( 'class' => "img-responsive")); ?>                                
                            <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div><!-- /.slide-image -->

                        <div class="content">
                            <div class="container">
                                <?php top_news_get_terms_link('category'); ?>
                                <div class="title-wrap">
                                    <h1 class="title" data-animate="fadeInUp"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                                    <div class="meta" data-animate="fadeInUp" data-delay="0.5s">
                                        <span><?php esc_html_e('Posted by', 'top-news'); ?> </span>
                                        <strong><?php the_author(); ?></strong>
                                        <span> - </span>
                                        <span><?php echo get_the_date(); ?></span>
                                    </div>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-default readmore" data-animate="fadeInUp" data-delay="1.0s"><?php esc_html_e('Read More', 'top-news'); ?></a>
                            </div><!-- /.container -->
                        </div><!-- /.content -->
                        <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                            <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                        <?php endif; ?>                        
                    </div><!-- /.item -->
                <?php endwhile;
                wp_reset_postdata(); ?>
                </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container -->
                <div id="content-slider-pagination-<?php echo esc_attr($unqID); ?>" class="slider-pagination" data-swiper="pagination"></div><!-- /.slider-pagination -->
            </div><!-- /#content-slider -->
    <?php endif;
}