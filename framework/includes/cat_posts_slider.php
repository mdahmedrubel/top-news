<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

function top_news_cat_posts_slider($cat, $tag, $limit) {
    if(!empty($tag) ) {
        $query_args = array(
            'post_type'           => 'post',
            'cat'                 => $cat,
            'tag__in'             => $tag,
            'post_status'         => 'publish',
            'posts_per_page'      =>  $limit,
            'ignore_sticky_posts' => true,
        );
    } else {
        $query_args = array(
            'post_type'           => 'post',
            'cat'                 => $cat,
            'post_status'         => 'publish',
            'posts_per_page'      =>  $limit,
            'ignore_sticky_posts' => true,
        );
    }
    $the_query = new WP_Query( $query_args );
        if ( $the_query->have_posts() ) :
            $unqID = uniqid();
            ?>
            <div id="content-slider-<?php echo esc_attr($unqID); ?>" class="main-slider cat-main-slider" data-carousel="swiper" data-autoplay="10000" data-loop="true">

                <div id="content-slider-container-<?php echo esc_attr($unqID); ?>" class="swiper-container" data-swiper="container">
                <div class="swiper-wrapper content-items">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                ?>
                    <div class="swiper-slide item">
                        <div class="slide-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail('top-news-large-slider', array( 'class' => "img-responsive")); ?>                                
                            <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div><!-- /.slide-image -->
                        <div class="overlay"></div>
                        <div class="content cat-slider">
                            <h1 class="title" data-animate="fadeInUp"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

                            <div class="meta" data-animate="fadeInUp" data-delay="0.5s">
                                <span><?php esc_html_e('Posted by', 'top-news'); ?> </span>
                                <strong><?php the_author(); ?></strong>
                                <span> - </span>
                                <span><?php echo get_the_date(); ?></span>
                            </div>
                        </div><!-- /.content -->
                        <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                            <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                        <?php endif; ?>                        
                    </div><!-- /.item -->
                <?php endwhile;
                wp_reset_postdata(); ?>
                </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container -->
                <div id="content-slider-pagination-<?php echo esc_attr($unqID); ?>" class="slider-pagination" data-swiper="pagination"></div>
                <div id="content-slider-swiper-button-next-<?php echo esc_attr($unqID); ?>" class="swiper-button-next" data-swiper="next"></div>
                <div id="content-slider-swiper-button-prev-<?php echo esc_attr($unqID); ?>" class="swiper-button-prev" data-swiper="prev"></div>
            </div><!-- /#content-slider -->
    <?php endif;
}