<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Display Posts row with small thumbs
 *
 * @param $args =  pass your all args
 */

function top_news_post_default($title,$post_col,$cat_id,$categorie_slug,$tag,$orderby,$order,$meta,$limit,$show_excrpt,$excerpt,$el_class) {
    $unqID = uniqid();
    $meta_description = (($meta === 'true') ? 'yes' : null); 
    $excerpt_display = (($show_excrpt === 'true') ? 'yes' : null);
    if ($post_col =='2-column') {
        $col_md = "col-md-6";
        $perrow = 2;
    } else if ($post_col =='3-column'){
        $col_md = "col-md-4";
        $perrow = 3;
    } else if ($post_col =='4-column'){
        $col_md = "col-md-3";
        $perrow = 4;
    } else {
        $col_md = "col-md-6";
        $perrow = 2;
    }
    ?>
    <div id="post-widget-<?php echo esc_attr($unqID);?>" class="posts-widget posts-default posts-lists block <?php echo esc_attr($el_class); ?>">
        <?php if(! empty($title)) : ?>
            <h2 class="widget-title"><span><?php echo esc_html($title); ?></span></h2>
            <div class="clearfix"></div>
        <?php endif; ?>    
            <?php                   
            if($tag != ''){
                $query_args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => $limit,
                    'order'             => $order,
                    'orderby'           => $orderby,				 
                    'tag'               => $tag,
                );            
            } else if($categorie_slug != '' && $tag == ''){		
                $query_args = array(
                    'post_type'		=> 'post',
                    'post_status'       => 'publish',
                    'posts_per_page'	=> $limit,                            
                    'order'             => $order,
                    'orderby'		=> $orderby,
                    'category_name' 	=> $categorie_slug,
                );
            } else if( $cat_id == true && !empty($cat_id[0]) && $categorie_slug == '') {
                $query_args = array(
                    'post_type'         => 'post',
                    'post_status'       => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'term_id',
                            'terms'    => $cat_id,
                        ),
                    ),                            
                    'posts_per_page'    =>  $limit,
                    'order'             => $order,
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
            $counter=0;
            if ( $the_query->have_posts() ) :?> 
            <div class="row">            
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); $counter++;
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                ?>

                    <div class="<?php echo esc_attr($col_md); ?>">
                        <article class="post-item">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumb">
                                    <a href="<?php the_permalink();?>">
                                        <?php the_post_thumbnail('top-news-thumbnail-x2'); ?>
                                    </a>
                                    <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                        <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                                    <?php endif; ?>
                                    <div class="cat-tag-list"><?php top_news_get_terms_link('category'); ?></div>
                                </div> <!--.thumbnail --> 
                            <?php endif; ?>

                            <div class="content">
                                <h2 class="title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <?php if ($meta_description === 'yes') : ?>
                                <div class="meta">
                                    <?php if (function_exists('wp_review_show_total')): wp_review_show_total(); endif;?>
                                    <span><?php esc_html_e('Posted by', 'top-news'); ?></span>
                                    <?php the_author_posts_link(); ?>
                                    <span>-</span>
                                    <span><?php echo get_the_date(); ?></span>
                                </div> <!--/.meta--> 
                                <?php endif; ?>                                
                                <?php if ($excerpt_display === 'yes') : ?>
                                <div class="excerpt">
                                    <p>
                                    <?php
                                        $trimexcerpt = get_the_excerpt();
                                        $shortexcerpt = wp_trim_words( $trimexcerpt, $num_words = $excerpt, $more = '&#8230;' );
                                        echo $shortexcerpt;
                                    ?>
                                    </p>
                                </div> <!--/.excerpt-->
                                <a href="<?php the_permalink(); ?>" class="btn btn-default readmore"><?php esc_html_e('Read More', 'top-news'); ?></a>
                                <?php endif; ?>                                
                            </div><!-- /.content -->
                        </article><!-- /.post-item -->
                    </div>
                <?php 
                  //close row div and start another every 2 posts
                  if ($counter%$perrow == 0):?>
                    </div><div class="row"> 
                <?php endif; endwhile;
                wp_reset_postdata();?>
                </div> 
            <?php else : ?>            
                <p><?php esc_html__( 'Sorry, no posts matched your criteria.' , 'top-news'); ?></p>
            <?php endif; ?>

    </div><!-- /.posts-lists -->   
<?php }