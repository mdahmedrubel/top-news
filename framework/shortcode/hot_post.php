<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Display Posts row with small thumbs
 *
 * @param $args =  pass your all args
 */

function top_news_hot_post($title,$time_limit,$limit,$el_class){
    $unqID = uniqid();
    ?>
    <div id="post-widget-<?php echo esc_attr($unqID);?>" data-content-id="post-widget-<?php echo esc_attr($unqID);?>" class="posts-widget posts-lists archive-row x2 ajax block <?php echo esc_attr($el_class); ?>">
        <?php if(! empty($title)) : ?>
            <h2 class="widget-title"><span><?php echo esc_html($title); ?></span></h2>
            <div class="clearfix"></div>
        <?php endif; ?>
        <div class="rp-ajax-row">
        <?php
        $query_args = array(
            'post_type'      => 'post',
            'posts_per_page'      => $limit,
            'meta_key' => 'post_views_count', 
            'orderby' => 'meta_value_num', 
            'ignore_sticky_posts' => true,                 
            'date_query' => array(
                array(
                    'after' => esc_html($time_limit).' weeks ago',
                ),
            ),
        );

        $the_query = new WP_Query( $query_args );
        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post();
            $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
        ?>
            <article class="post-item <?php echo ( has_post_thumbnail()) ? 'has-post-thumbnail' : '' ; ?>">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumb">
                        <a href="<?php the_permalink();?>">
                            <?php the_post_thumbnail('top-news-thumbnail-x2'); ?>
                        </a>
                        <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                            <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                        <?php endif; ?>                        
                    </div> <!--.thumbnail --> 
                <?php endif; ?>

                <div class="content">
                    <h2 class="title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="meta">
                        <?php top_news_block_meta() ?>
                    </div> <!--/.meta-->              
                    <div class="excerpt">                                        
                        <?php
                            $trimexcerpt = get_the_excerpt();
                            $shortexcerpt = wp_trim_words( $trimexcerpt, $num_words = '20', $more = '&#8230;' );
                            echo $shortexcerpt;
                        ?>
                    </div> <!--/.excerpt-->                     
                </div><!-- /.content -->
            </article><!-- /.post-item -->
            <?php endwhile; wp_reset_postdata(); ?>            
        <?php else : ?>
            <p><?php esc_html__( 'Sorry, no posts matched your criteria.' , 'top-news'); ?></p>
        <?php endif; ?>
        </div>
    </div><!-- /.posts-lists --> 
<?php }