<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
* Display Posts row with small thumbs
*
* @param $cat_id =  int if has cat id
* @param $limit = int if limit number of posts
*/
function top_news_posts_slider_shortcode($title,$cat_id,$categorie_slug,$tag,$orderby,$order,$thumb,$meta,$limit,$el_class){
    $meta_description = (($meta === 'true') ? 'yes' : null);
    $list_thumb = (($thumb === 'true') ? 'yes' : null);
?>
    <div class="posts-widget slider-posts-widget block <?php echo esc_attr($el_class); ?>">
        <?php if(! empty($title)) : ?>
            <h2 class="widget-title"><span><?php echo esc_html($title); ?></span></h2>
            <div class="clearfix"></div>
        <?php endif; 
        if($tag != ''){
            $query_args = array(
                'post_type'         => 'post',
                'posts_per_page'    => $limit,
                'order'             => $order,
                'orderby'           => $orderby,				 
                'tag'            => $tag,
            );            
        } else if($categorie_slug != '' && $tag == ''){		
            $query_args = array(
                'post_type'         => 'post',
                'posts_per_page'    => $limit,
                'order'             => $order,
                'orderby'           => $orderby,
                'category_name'     => $categorie_slug,
            );
        } else if( $cat_id == true && !empty($cat_id[0]) && $tag == '' && $categorie_slug == '') {
            $query_args = array(
                'post_type' => 'post',
                'tax_query' => array(
                    array(
                        'taxonomy'  => 'category',
                        'field'     => 'term_id',
                        'terms'     => $cat_id,
                    ),
                ),
                'post_status'       => 'publish',                
                'order'             => $order,
                'orderby'           => $orderby,
                'ignore_sticky_posts' => true,
            );
        } else {
            $query_args = array(
                'post_type'         => 'post',
                'post_status'       => 'publish',
                'posts_per_page'    => $limit,
                'order'             => $order,
                'orderby'           => $orderby,
                'ignore_sticky_posts' => true,
            );
        }
        $the_query = new WP_Query( $query_args );                  
        if ( $the_query->have_posts() ) :
            $unqID = uniqid();
            if ($list_thumb === 'yes') :
        ?>
            <div id="slider-<?php echo esc_attr($unqID); ?>" class="flexslider flexslider-fashion3">
                <ul class="slides">
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                    ?>
                    <li>
                        <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('top-news-large-featured', array( 'class' => "img-responsive")); ?>
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
            <div id="carousel-<?php echo esc_attr($unqID); ?>" class="flexslider flexslider-carousel3">
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
        <?php else : ?>
        <div id="content-slider-<?php echo esc_attr($unqID); ?>" class="magazine-slider" data-carousel="swiper" data-autoplay="10000" data-loop="true">
            <div id="content-slider-container-<?php echo esc_attr($unqID); ?>" class="swiper-container" data-swiper="container">
                <div class="swiper-wrapper content-items">            
                    <?php
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                        $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                    ?>
                        <div class="swiper-slide item">
                            <div class="slide-image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('top-news-large-featured', array( 'class' => "img-responsive")); ?>                                
                                <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                    <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                                <?php endif; ?>
                                <?php else : ?>
                                <img src="<?php echo esc_url( TOPNEWS_ASSETS . '/img/thumb-x2.jpg'); ?>" alt="<?php the_title();?>" class="img-responsive" />
                                <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                    <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="content">
                                <?php top_news_get_terms_link('category'); ?>
                                <h1 class="title" data-animate="fadeInUp"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                                <?php if ($meta_description === 'yes') : ?>
                                <div class="meta" data-animate="fadeInUp" data-delay="0.5s">
                                    <span><?php esc_html_e('Posted by ', 'top-news'); ?> <strong><?php the_author(); ?></strong></span>
                                    <span><?php get_the_date(); ?></span>
                                </div><!-- /.meta -->
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-default readmore" data-animate="fadeInUp" data-delay="1.0s"><?php esc_html_e('Read More', 'top-news'); ?></a>
                            </div><!-- /.slide-caption -->
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div><!-- /.swiper-wrapper -->
            </div><!-- /.swiper-container -->
            <div id="content-slider-pagination-<?php echo esc_attr($unqID); ?>" class="slider-pagination" data-swiper="pagination"></div><!-- /.slider-pagination -->
        </div><!-- /#content-slider -->
        <?php endif; ?>
        <?php else : ?>
            <p><?php esc_html__( 'Sorry, no posts matched your criteria.' , 'top-news'); ?></p>
        <?php endif; ?>        
    </div><!-- /.posts-widget -->   
<?php }

