<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

function top_news_post_col2_tab($title,$categorie_slug,$orderby,$order,$thumb,$meta,$limit,$excerpt,$el_class) {
    $unqID = uniqid();
    $meta_description = (($meta === 'true') ? 'yes' : null) ;    
    $list_thumb = (($thumb === 'true') ? 'yes' : null) ;      
    ?>
    <div id="tabbed-posts-widget-<?php echo esc_attr($unqID); ?>" class="posts-widget tabbed-posts-widget block <?php echo esc_attr($el_class); ?>"
        <?php
            $cat_ids = explode(',', $categorie_slug);
            @$getcatids = top_news_get_category_id_from_slug($cat_ids);
            $data_limit = $limit - 1;
        ?> 
        <?php echo $post_ajaxify = 'data-tn-tab-posts-ajaxify'; ?>
        <?php echo $post_limit = (! empty($limit)) ? 'data-limit="' . $data_limit . '"' : '' ; ?>
        <?php echo $post_thumb = ($thumb === 'true') ? 'data-thumb="yes"' : 'data-thumb="no"' ; ?>
        <?php echo $post_meta = ($meta === 'true') ? 'data-meta="yes"' : 'data-meta="no"' ; ?>
        <?php echo $post_excerpt =  'data-excerpt="'.$excerpt.'"'; ?>
    >
        <?php if(! empty($title)) : ?>
            <h2 class="widget-title"><span><?php echo esc_html($title); ?></span></h2>
            <div class="clearfix"></div>
        <?php endif; ?>

        <?php if($categorie_slug != '') { ?>
            <ul class="tab-switcher">
                <li>
                    <a href="#" class="cat-tag" data-cat-id="<?php echo esc_attr($getcatids); ?>"
                    >
                        <?php esc_html_e('All', 'top-news'); ?>
                    </a>
                </li>
                <?php
                $cat_idsmenu = explode(',', $getcatids);
                foreach( $cat_idsmenu as $cat ) :
                    $top_news_term = get_term($cat, 'category');
                    ?>
                    <li>
                        <a
                            href="<?php echo esc_url(get_term_link($top_news_term)); ?>"
                            class="cat-tag <?php echo esc_attr($top_news_term->slug); ?>"
                            data-cat-id="<?php echo esc_attr($cat); ?>">
                            <?php echo esc_attr($top_news_term->name); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul><!-- /.tab-switcher -->
        <?php } else { ?>
            <ul class="tab-switcher">
                <li>
                    <a href="#" class="cat-tag" data-cat-id="<?php echo esc_attr($getcatids); ?>"
                    >
                        <?php esc_html_e('All', 'top-news'); ?>
                    </a>
                </li>
                <?php 
                    $terms = get_terms('category');
                    $count = count($terms);
                    if ( $count > 0 ){
                        foreach ( $terms as $term ) {
                            ?>                                
                            <li>
                                <a
                                    href="<?php echo esc_url(get_term_link($term)); ?>"
                                    class="cat-tag <?php echo esc_attr($term->slug); ?>"
                                    data-cat-id="<?php echo esc_attr($term->term_id); ?>">
                                    <?php echo esc_attr($term->name); ?>
                                </a>
                            </li>                            
                        <?php }
                    }
                ?>                 
            </ul><!-- /.tab-switcher -->            
        <?php } ?>

        <div class="tab-content">            
            <div class="row">
                <div class="col-md-6">
                    <div class="posts-lists">
                        <?php                  
                        if($categorie_slug != ''){		
                            $query_args = array(
                                'post_type'		=> 'post',
                                'posts_per_page'	=> 1,
                                'order'                 => $order,
                                'orderby'		=> $orderby,				 
                                'paged'                 => 1, 
                                'category_name' 	=> $categorie_slug,
                            );
                        } else if( $cat_ids == true && !empty($cat_ids[0]) && $categorie_slug == '') {
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
                                'posts_per_page'      =>  1,
                                'order'		=> $order,
                                'orderby'		=> $orderby,
                                'ignore_sticky_posts' => true,
                            );
                        } else {
                            $query_args = array(
                                'post_type' => 'post',
                                'post_status'         => 'publish',
                                'posts_per_page'      =>  1,
                                'order'		=> $order,
                                'orderby'		=> $orderby,
                                'ignore_sticky_posts' => true,
                            );
                        }
                        $the_query = new WP_Query( $query_args );
                        $count_posts = $the_query->found_posts;
                        if ($count_posts < $limit){
                            $limit = $count_posts;
                        }
                        $limitrow =  $limit - 1;
                        if ( $the_query->have_posts() ) :
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                            $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                                ?>
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

                                        <div class="excerpt">                                        
                                            <?php
                                                $trimexcerpt = get_the_excerpt();
                                                $shortexcerpt = wp_trim_words( $trimexcerpt, $num_words = $excerpt, $more = '&#8230;' );
                                                echo $shortexcerpt;
                                            ?>
                                        </div> <!--/.excerpt--> 

                                        <a href="<?php the_permalink(); ?>" class="btn btn-default readmore"><?php esc_html_e('Read More', 'top-news'); ?></a>
                                    </div> <!--/.content -->
                                </article> <!--/.post-item -->
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <p><?php esc_html__( 'Sorry, no posts matched your criteria.' , 'top-news'); ?></p>
                        <?php endif; ?>
                    </div> <!--.posts-lists --> 
                </div> <!--.col-md-6 --> 

                <div class="col-md-6">
                    <?php
                        top_news_small_posts_list(array(
                            'cat_ids'       => '',
                            'tag'           => '',
                            'limit'         => $limitrow,
                            'order'         => $order,
                            'orderby'	=> $orderby,
                            'offset'        => 1,
                            'category_name' => $categorie_slug,
                            'thumb'     => $list_thumb,
                            'meta'      => $meta_description,
                        )); 
                    ?>
                </div> <!--/.col-md-6 --> 
            </div> <!--/.row -->
        </div>
        <div class="spinner">
            <img src="<?php echo get_template_directory_uri(); ?>/images/pie.gif" alt="">
        </div>

    </div><!-- /.tabbed-posts-widget --> 
<?php }


