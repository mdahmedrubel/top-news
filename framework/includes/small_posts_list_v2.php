<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Small Posts Lists
 *
 * @param $args = Pass your all args
 */
function top_news_small_posts_list_v2($args) {
    $defaults = array(
        'cat_ids'       => 0,
        'tag'           => '',
        'offset'        => 0,
        'limit'         => 5,
        'order'         => '',
        'orderby'       => '',        
        'thumb'         => '',
        'meta'          => '',
        'category_name' => '',
        'class'         => '',
    );

    $args = wp_parse_args( $args, $defaults );        
    
    if($args['tag'] != ''){
        $query_args = array(
            'post_type'           => 'post',
            'tag'                 => $args['tag'],
            'post_status'         => 'publish',
            'order'               => $args['order'],
            'orderby'             => $args['orderby'],
            'posts_per_page'      =>  $args['limit'],
            'ignore_sticky_posts' => true,
            'offset'              => $args['offset']
        );        
    } else if($args['category_name'] != ''){
        $query_args = array(
            'post_type'           => 'post',
            'category_name'       => $args['category_name'],
            'post_status'         => 'publish',
            'order'               => $args['order'],
            'orderby'             => $args['orderby'],
            'posts_per_page'      =>  $args['limit'],
            'ignore_sticky_posts' => true,
            'offset'              => $args['offset']
        );        
    } else if ( $args['cat_ids'] == true && !empty($args['cat_ids'][0]) && $args['category_name'] == ''){
        $query_args = array(
            'post_type' => 'post',
            'tax_query' => array(
                array(
                    'taxonomy'    => 'category',
                    'field'       => 'term_id',
                    'terms'       => $args['cat_ids'],
                ),
            ),
            'post_status'         => 'publish',
            'order'               => $args['order'],
            'orderby'             => $args['orderby'],
            'posts_per_page'      =>  $args['limit'],
            'ignore_sticky_posts' => true,
            'offset'              => $args['offset']
        );
    } else {        
        $query_args = array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'order'               => $args['order'],
            'orderby'             => $args['orderby'],
            'posts_per_page'      =>  $args['limit'],
            'ignore_sticky_posts' => true,
            'offset'              => $args['offset']
        );
    }
    $the_query = new WP_Query( $query_args );
    $counter=0;
    if ( $the_query->have_posts() ) :?>            
            <div class="boxed small-posts-list <?php echo esc_attr($args['class']); ?>">
            <div class="row">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); $counter++ ?>
                <div class="col-md-6 item <?php echo ($args['thumb'] === 'yes' ) ? 'has-post-thumbnail' : '' ; ?>">
                    <?php
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );   
                    if( $args['thumb'] === 'yes' ) :
                        if ( has_post_thumbnail() ) :
                    ?>
                        <div class="post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('top-news-thumbnail-x2'); ?>
                            </a>
                            <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                            <?php endif; ?>
                        </div><!-- /.thumbnail -->                    
                    <?php
                        endif;
                     endif;
                     ?>
                    <div class="content">
                        <h4 class="title test">
                            <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                        </h4>
                        <?php if($args['meta'] === 'yes') : ?>
                        <div class="meta">
                            <?php if (function_exists('wp_review_show_total')): wp_review_show_total(); endif;?>
                            <span><?php echo get_the_date() ?></span>
                            <?php
                                $get_cats = get_the_terms(get_the_ID(), 'category');
                            ?>
                            <span>-</span>
                            <?php top_news_get_terms_link2('category'); ?>
                        </div>
                        <?php endif; ?>
                    </div><!-- /.content -->
                </div>
                <?php 
                  //close row div and start another every 2 posts
                  if ($counter%2 == 0):?>
                    <div class="clearfix"></div> 
                <?php endif; endwhile;
                wp_reset_postdata();?>
            </div>
        <?php endif; ?>
<?php }