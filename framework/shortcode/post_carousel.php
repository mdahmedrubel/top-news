<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
* Display Posts row with small thumbs
*
* @param $cat_id =  int if has cat id
* @param $limit = int if limit number of posts
*/
function top_news_post_carousel($title,$cat_id,$categorie_slug,$tag,$orderby,$order,$meta,$limit,$el_class) {
    $unqID = uniqid();
    $meta_description = (($meta === 'true') ? 'yes' : null) ;
    ?>
    <!-- Posts Carousel -->
    <div id="post-carousel-<?php echo esc_attr($unqID); ?>" class="posts-widget post-carousel-widget block <?php echo esc_attr($el_class); ?>" data-carousel="swiper" data-items="3" data-breakpoints='{"320": {"slidesPerView": 1}, "768": {"slidesPerView": 2}}'>
        <?php if(! empty($title)) : ?>
        <h2 class="widget-title"><span><?php echo esc_html($title); ?></span></h2>
        <?php endif; ?> 

        <div class="controls">
            <a id="post-carousel-control-prev-unq-1" data-swiper="prev">
                    <i class="fa fa-angle-left"></i>
            </a>
            <a id="post-carousel-control-next-unq-1" data-swiper="next">
                    <i class="fa fa-angle-right"></i>
            </a>
        </div><!-- /.controls -->

        <div class="clearfix"></div>

        <div id="post-carousel-container-unq-1" class="swiper-container" data-swiper="container">
            <div class="swiper-wrapper post-items">    
                    <?php
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
                            'post_type'		=> 'post',
                            'posts_per_page'	=> $limit,
                            'order'		=> $order,
                            'orderby'		=> $orderby,                             
                            'category_name' 	=> $categorie_slug,
                        );
                    } else if( $cat_id == true && !empty($cat_id[0]) && $categorie_slug == '') {
                        $query_args = array(
                            'post_type' => 'post',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field'    => 'term_id',
                                    'terms'    => $cat_id,
                                ),
                            ),
                            'post_status'         => 'publish',
                            'posts_per_page'      =>  $limit,
                            'order'		=> $order,
                            'orderby'		=> $orderby,
                            'ignore_sticky_posts' => true,
                        );
                    } else {
                        $query_args = array(
                            'post_type' => 'post',
                            'post_status'         => 'publish',
                            'posts_per_page'      =>  $limit,
                            'order'		=> $order,
                            'orderby'		=> $orderby,
                            'ignore_sticky_posts' => true,
                        );
                    }
                    $the_query = new WP_Query( $query_args );
                   
                    if ( $the_query->have_posts() ) :
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                        $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                            ?>
                            <div class="swiper-slide item">
                                <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumb">
                                    <a href="<?php the_permalink();?>">
                                            <?php the_post_thumbnail('top-news-thumbnail-x2'); ?>
                                    </a>
                                    <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                        <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                                    <?php endif; ?>
                                    <div class="cat-tag-list"><?php top_news_get_terms_link('category'); ?></div>
                                </div><!-- /.post-thumb -->                              
                                <?php endif; ?>
                                <div class="content">
                                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php if ($meta_description === 'yes') : ?>
                                    <div class="meta">
                                            <span><?php echo get_the_date(); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div><!-- /.content -->
                            </div><!-- /.item -->                            
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <p><?php esc_html__( 'Sorry, no posts matched your criteria.' , 'top-news'); ?></p>
                    <?php endif; ?>
            </div><!-- /.swiper-wrapper -->
        </div><!-- /.swiper-container -->
    </div><!-- /#post-carousel -->  
<?php }


