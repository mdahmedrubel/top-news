<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Custom template functions for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package TopNews
 */

/**
 * layouts
 */
if ( ! function_exists( 'top_news_get_layouts' ) ) :
    function top_news_get_layouts($col_main_left, $sidebar_left, $sidebar_left_right, $col_main, $sidebar_right) {
        if ($col_main_left !== '') : ?>
        <div class="<?php echo esc_attr($col_main_left) ?>">
            <div class="theiaStickySidebar">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'template-parts/content', 'page' ); ?>

                <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                                comments_template();
                        endif;
                ?>

            <?php endwhile; // End of the loop. ?>
            </div>
        </div>         
        <?php endif; //end of layout block 1

        if ($sidebar_left !== '') :
            get_sidebar($sidebar_left);
        endif; //end of layout block 2

        if ($sidebar_left_right !== '') :
            get_sidebar($sidebar_left_right);
        endif; //end of layout block 3

        if ($col_main !== '') :
        ?> 
        <div class="<?php echo esc_attr($col_main) ?>">
            <div class="theiaStickySidebar">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'template-parts/content', 'page' ); ?>

                <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                                comments_template();
                        endif;
                ?>

            <?php endwhile; // End of the loop. ?>
            </div>

        </div>                                
        <?php
        endif; //end of layout block 4

        if ($sidebar_right !== '') :
            get_sidebar($sidebar_right);
        endif;//end of layout block 5                               
    }
endif;


if ( ! function_exists( 'top_news_shop_layouts' ) ) :
    function top_news_shop_layouts(){ ?> 
        <div class="theiaStickySidebar">
            <?php do_action( 'woocommerce_before_main_content' ); ?>

                    <?php do_action( 'woocommerce_archive_description' ); ?>

                    <?php if ( have_posts() ) : ?>

                            <?php do_action( 'woocommerce_before_shop_loop' ); ?>

                            <?php woocommerce_product_loop_start(); ?>

                                    <?php woocommerce_product_subcategories(); ?>

                                    <?php while ( have_posts() ) : the_post(); ?>

                                            <?php wc_get_template_part( 'content', 'product' ); ?>

                                    <?php endwhile; // end of the loop. ?>

                            <?php woocommerce_product_loop_end(); ?>

                            <?php do_action( 'woocommerce_after_shop_loop' ); ?>

                    <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                            <?php wc_get_template( 'loop/no-products-found.php' ); ?>

                    <?php endif; ?>

            <?php do_action( 'woocommerce_after_main_content' ); ?>
        </div>                               
    <?php }
endif;

if ( ! function_exists( 'top_news_get_author_layouts' ) ) :
    function top_news_get_author_layouts($col_full, $col_main_left, $sidebar_left, $sidebar_left_right, $col_main, $sidebar_right) {
        if ($col_full !== '') : ?>
        <div class="<?php echo esc_attr($col_full) ?>">
            <div class="row">
            <?php top_news_get_author_list('col-md-4', 3); ?>
            </div>
        </div>        
        <?php endif; //end of layout block 1 
        
        if ($col_main_left !== '') : ?>
        <div class="<?php echo esc_attr($col_main_left) ?>">
            <div class="row">
            <?php top_news_get_author_list('col-md-6', 2); ?>
            </div>
        </div>        
        <?php endif; //end of layout block 1 
        
        if ($sidebar_left !== '') :
            get_sidebar($sidebar_left);
        endif; //end of layout block 2
        
        if ($sidebar_left_right !== '') :
            get_sidebar($sidebar_left_right);
        endif; //end of layout block 3
        
        if ($col_main !== '') :
        ?> 
        <div class="<?php echo esc_attr($col_main) ?>">
            <div class="row">
                <?php top_news_get_author_list('col-md-6', 2); ?>
            </div>

        </div>                                
        <?php
        endif; //end of layout block 4
        
        if ($sidebar_right !== '') :
            get_sidebar($sidebar_right);
        endif; //end of layout block 5    
    
    }
    
endif;


if ( ! function_exists( 'top_news_get_author_list' ) ) :
    function top_news_get_author_list($col,$perrow){
        $number     = 12;
        $paged      = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $offset     = ($paged - 1) * $number;
        $users      = get_users();
        $query      = get_users('&offset='.$offset.'&number='.$number);
        $total_users = count($users);
        $total_query = count($query);
        $total_pages = intval($total_users / $number);

        $counter=0;
        foreach($query as $q) {                        
            $top_news_user_facebook = get_the_author_meta('tn_user_facebook', $q->ID);
            $top_news_user_twitter = get_the_author_meta('tn_user_twitter', $q->ID);
            $top_news_user_gplus = get_the_author_meta('tn_user_gplus', $q->ID);
            $top_news_user_linkedin = get_the_author_meta('tn_user_linkedin', $q->ID);
            $top_news_user_tumblr = get_the_author_meta('tn_user_tumblr', $q->ID);
            $top_news_user_vimeo = get_the_author_meta('tn_user_vimeo', $q->ID);
            $top_news_user_rss = get_the_author_meta('tn_user_rss', $q->ID);
            $top_news_user_behance = get_the_author_meta('tn_user_behance', $q->ID);
    ?>
        <div class="<?php echo esc_attr($col); ?>">
            <div class="author-info">
                <div class="author-image">
                    <a href="<?php echo get_author_posts_url($q->ID);?>"><?php echo get_avatar( $q->ID, 150 ); ?></a>
                </div><!-- /.author-image -->
                <div class="content">
                    <h4 class="author-title"><a href="<?php echo get_author_posts_url($q->ID);?>"><?php echo get_the_author_meta('display_name', $q->ID);?></a></h4>                                
                    <p><?php echo get_the_author_meta('description', $q->ID); ?></p>

                    <div class="social-profiles">
                        <ul class="social-icons">
                            <?php 
                            if(! empty ($top_news_user_facebook)): 
                                echo '<li><a href="'.esc_url($top_news_user_facebook).'"><i class="fa fa-facebook"></i></a></li>';
                            endif;
                            if(! empty ($top_news_user_twitter)):
                                echo '<li><a href="'.esc_url($top_news_user_twitter).'"><i class="fa fa-twitter"></i></a></li>';
                            endif;
                            if(! empty ($top_news_user_gplus)):
                                echo '<li><a href="'.esc_url($top_news_user_gplus).'"><i class="fa fa-google-plus"></i></a></li>';
                            endif;
                            if(! empty ($top_news_user_linkedin)):
                                echo '<li><a href="'.esc_url($top_news_user_gplus).'"><i class="fa fa-linkedin"></i></a></li>';
                            endif;
                            if(! empty ($top_news_user_tumblr)):
                                echo '<li><a href="'.esc_url($top_news_user_gplus).'"><i class="fa fa-vimeo-square"></i></a></li>';
                            endif;
                            if(! empty ($top_news_user_vimeo)):
                                echo '<li><a href="'.esc_url($top_news_user_gplus).'"><i class="fa fa-tumblr"></i></a></li>';
                            endif;
                            if(! empty ($top_news_user_rss)):
                                echo '<li><a href="'.esc_url($top_news_user_gplus).'"><i class="fa fa-rss"></i></a></li>';
                            endif;
                            if(! empty ($top_news_user_behance)):
                                echo '<li><a href="'.esc_url($top_news_user_behance).'"><i class="fa fa-behance"></i></a></li>';
                            endif;
                            ?>
                        </ul><!-- /.social-icons -->
                    </div><!-- /.social-profiles -->
                </div><!-- /.content -->
            </div><!-- /.author-bio -->
        </div><!-- /.col-md-6 --> 
        <?php 
        $counter++;
        //close row div and start another every 2 posts
          if ($counter%$perrow==0):?>
            <div class="clearfix"></div> 
        <?php endif;

        }

        if ($total_users > $total_query) {
        echo '<div class="col-md-12">';
          $current_page = max(1, get_query_var('paged'));
          $big = 999999999; 
          echo paginate_links(array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => $current_page,
                'total' => $total_pages,
                'type'         => 'list',
            ));
        echo '</div>';
        }   
    }
endif;

if ( ! function_exists( 'top_news_blog_posts' ) ) :
    function top_news_blog_posts($article_class, $post_col, $class_info, $thumbnail, $is_excerpt, $is_readmore, $excerpt_limit) { ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(array($article_class, $post_col)); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumb">
                    <a href="<?php the_permalink();?>">
                        <?php the_post_thumbnail($thumbnail); ?>
                    </a>
                    <?php $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                    if( !empty($meta_data['embedded_link'])) : ?> 
                        <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                    <?php endif; ?>
                </div><!-- /.thumbnail -->                                         
            <?php endif; ?>

            <div class="<?php echo esc_attr($class_info) ?>">
                <?php top_news_share_count(); ?>
                <h2 class="title">
                    <a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="meta">
                    <?php if (function_exists('wp_review_show_total')): wp_review_show_total(); endif;?>
                    <span><?php esc_html_e('Posted by', 'top-news'); ?></span>
                    <?php the_author_posts_link(); ?>
                    <span>-</span>
                    <span><?php echo get_the_date(); ?></span>
                </div><!-- /.meta -->
                <?php if ($is_excerpt === 'true'): ?>
                <div class="excerpt">
                    <?php 
                    if (!empty($excerpt_limit)):
                        echo wp_trim_words(get_the_excerpt(), $excerpt_limit, '&#8230;' );
                    else :
                        the_excerpt();
                    endif;

                    ?>
                </div><!-- /.excerpt -->
                <?php endif; ?>
                <?php if ($is_readmore === 'true'): ?>
                <a href="<?php the_permalink(); ?>" class="btn btn-default readmore"><?php esc_html_e('Read More', 'top-news'); ?></a>
                <?php endif; ?>
            </div><!-- /.content -->
        </article><!-- /.post-item -->
    <?php }
endif;

if ( ! function_exists( 'top_news_category_template_posts' ) ) :
    function top_news_category_template_posts($class_list, $class_article, $post_col, $class_info, $thumbnail, $is_excerpt, $is_readmore, $top_news_cat_post_column, $top_news_blog_excerpt_limit) {    
    $perrow = '';
    if ($top_news_cat_post_column == '1-col'){
        $perrow = 1;
    } else if ($top_news_cat_post_column == '2-col') {
        $perrow = 2;
    } else if ($top_news_cat_post_column == '3-col') {
        $perrow = 3;
    } else {
        $perrow = 1;
    }
    ?>
    <div class="<?php echo esc_attr($class_list); ?>">
        <?php $counter=0; if ( have_posts() ) : ?>
        <div class="row">
            <?php                 
            while ( have_posts() ) : the_post(); $counter++;
            $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
            ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(array($class_article, $post_col)); ?>>
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumb">
                            <a href="<?php the_permalink();?>">
                                <?php the_post_thumbnail($thumbnail); ?>
                            </a>
                            <?php if( !empty($meta_data['embedded_link'])) : ?> 
                                <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                            <?php endif; ?>
                        </div><!-- /.thumbnail -->                                         
                    <?php endif; ?>

                    <div class="<?php echo esc_attr($class_info) ?>">
                        <?php top_news_share_count(); ?>
                        <h2 class="title">
                            <a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="meta">
                            <?php if (function_exists('wp_review_show_total')): wp_review_show_total(); endif;?>
                            <span><?php esc_html_e('Posted by', 'top-news'); ?></span>
                            <?php the_author_posts_link(); ?>
                            <span>-</span>
                            <span><?php echo get_the_date(); ?></span>
                        </div><!-- /.meta -->
                        <?php if ($is_excerpt === 'true'): ?>
                        <div class="excerpt">
                            <?php 
                            if (!empty($top_news_blog_excerpt_limit)):
                                echo wp_trim_words(get_the_excerpt(), $top_news_blog_excerpt_limit, '&#8230;' );
                            else :
                                the_excerpt();
                            endif;

                            ?>
                        </div><!-- /.excerpt -->
                        <?php endif; ?>
                        <?php if ($is_readmore === 'true'): ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-default readmore"><?php esc_html_e('Read More', 'top-news'); ?></a>
                        <?php endif; ?>
                    </div><!-- /.content -->
                </article><!-- /.post-item --> 

                
            <?php if ($counter%$perrow==0): ?>
                </div><div class="row"> 
            <?php endif; endwhile; ?>
        </div>                      
        <?php endif; ?>            
    </div>
    <?php }
endif;
