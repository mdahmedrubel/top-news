<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
function top_news_posts_slider_v2($top_news_post_from, $cat, $tag, $limit) {
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
            <div id="slider-<?php echo esc_attr($unqID); ?>" class="flexslider flexslider-fashion">
                <ul class="slides">
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                    ?>
                    <li>
                        <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('full', array( 'class' => "")); ?>
                        <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                            <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                        <?php endif; ?>
                        <?php endif; ?>
                        
                        <div class="overlay"></div>
                        <div class="carousel-text">
                            <div class="animated fadeInUp"><?php top_news_get_terms_link('category'); ?> </div>  
                            <h1 class="title animated fadeInUp"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <div class="meta animated fadeInUp">
                                <span><?php esc_html_e('Posted by ', 'top-news'); ?> <strong><?php the_author(); ?></strong></span>
                                <span><?php get_the_date(); ?></span>
                            </div><!-- /.meta -->
                        </div>                      
                    </li>
                    <?php endwhile;
                    wp_reset_postdata(); ?>                    
                </ul>
            </div>
            <div id="carousel-<?php echo esc_attr($unqID); ?>" class="flexslider flexslider-carousel">
                <ul class="slides">
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                    ?>
                    <li>
                        <?php the_post_thumbnail('top-news-slider-thumb'); ?>
                        <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                            <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                        <?php endif; ?>                         
                    </li>
                    <?php endwhile;
                    wp_reset_postdata(); ?>                    
                </ul>
            </div>
    <?php endif;
}