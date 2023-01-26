<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Latest Videos
 * @param int $cat_ids category id
 * @param bool $title widget title
 * @param int $limit limit the display posts
 */
function top_news_latest_videos($title,$cat_id,$categorie_slug,$tag,$orderby,$order,$limit,$el_class) {
    $unqID = uniqid();
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
    if ( $the_query->have_posts() ) : ?>
    <div class="col-md-12">
        <div id="recent-video-widgets-<?php echo esc_attr($unqID); ?>" class="recent-video-widget block <?php echo esc_attr($el_class); ?>">
            <?php if(! empty($title)) : ?>
                <h2 class="widget-title"><span><?php echo esc_html($title); ?></span></h2>
                <div class="clearfix"></div>
            <?php endif; ?>

            <div class="inside">

                <!-- Tab -->
                <div class="tab-content">
                    <?php
                        $count = 0;
                        while ( $the_query->have_posts() ) :
                            $the_query->the_post();
                    ?>
                        <div class="item tab-pane fade <?php echo ($count == 0) ? 'in active' : ''; ?>" id="recent-video-tabs-<?php echo get_the_ID(); ?>">
                            <?php
                                $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                                $get_data = '';
                                if( !empty($meta_data['embedded_link'])) {
                                    global $wp_embed;
                                    $get_data .= $wp_embed->run_shortcode( '[embed]'. esc_url($meta_data['embedded_link']) .'[/embed]' );
                                } else {
                                    $get_data .=  esc_html__('No Video','top-news');
                                }
                            ?>
                            <div class="video-player">
                                <?php echo $get_data; ?>
                            </div><!-- /.video-play -->
                        </div><!-- /.item -->
                    <?php
                        $count++;
                        endwhile;
                        wp_reset_postdata();
                    ?>
                </div><!-- /.tab-content -->

                <!-- Nav -->
                <ul class="navigation">
                    <?php
                        $count = 0;
                        while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <li class="<?php echo ($count == 0) ? 'active' : ''; ?>">
                            <a href="#recent-video-tabs-<?php echo get_the_ID(); ?>" aria-controls="recent-video-tabs-<?php echo get_the_ID(); ?>" data-toggle="tab">
                                <i class="fa fa-play"></i>
                                <h3 class="title"><?php the_title(); ?></h3>
                            <span class="meta">
                                <?php esc_html_e('by', 'top-news'); ?> <strong><?php echo get_the_author(); ?></strong>
                            </span>
                            </a>
                        </li>
                    <?php
                        $count++;
                        endwhile;
                        wp_reset_postdata();
                    ?>
                </ul>
            </div><!-- /.inside -->
        </div><!-- /#recent-video-widgets -->
    </div>
    <?php else :	?>
        <p><?php esc_html__( 'Sorry, no posts matched your criteria.' , 'top-news'); ?></p>
    <?php endif;
}