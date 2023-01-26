<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
//Make it Ajaxify
function top_news_tab_posts_ajaxify() {
    if( !isset($_POST['top_news_tab_posts_nonce']) || wp_verify_nonce('top_news_tab_posts_results') )
        die('Authentication Error!!!');

    $options = array(
        'offset' => '1'
    );
    if (! empty($_POST['info']['cat'])) {
        $options['cat_ids'] = $_POST['info']['cat'];
    }
    if(! empty($_POST['info']['limit'])) {
        $options['limit'] = $_POST['info']['limit'];
    }
    if(! empty($_POST['info']['thumb'])) {
        $options['thumb'] = $_POST['info']['thumb'];
    }
    if(! empty($_POST['info']['cat_meta'])) {
        $options['cat_meta'] = $_POST['info']['cat_meta'];
    }
    if(!empty($_POST['info']['meta'])) {
        $options['meta'] = $_POST['info']['meta'];
        $options['excerpt'] = $_POST['info']['excerpt']; 
        
    }
    if(!empty($_POST['info']['excerpt'])) {
        $options['excerpt'] = $_POST['info']['excerpt'];    
    }
    if(!empty($_POST['info']['class'])) {
        $options['class'] = $_POST['info']['class'];
    }
    top_news_posts_row($options);
    die();
}
add_action('wp_ajax_top_news_tab_posts_results', 'top_news_tab_posts_ajaxify');
add_action('wp_ajax_nopriv_top_news_tab_posts_results', 'top_news_tab_posts_ajaxify');

function top_news_recent_posts_ajaxify() {        
    $limit = isset($_POST['limit']) ? $_POST['limit'] : '';
    $offset = isset($_POST['offset']) ? $_POST['offset'] : '';
    $cat = isset($_POST['cat']) ? $_POST['cat'] : '';
    $post_col = isset($_POST['post_col']) ? $_POST['post_col'] : '';
    $per_row = isset($_POST['per_row']) ? $_POST['per_row'] : '';
    if( $cat == true) {
        $query_args = array(
            'offset'              => $offset,
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      =>  $limit,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $cat,
                ),
            ),
            'ignore_sticky_posts' => true,
        );
    } else {
        $query_args = array(
            'offset'              => $offset,
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      =>  $limit,
            'ignore_sticky_posts' => true,
        );
    }    
    $the_query = new WP_Query( $query_args );
    
    $counter=$offset;
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post(); $counter++;
        $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
    ?>
    
        <div class="<?php echo esc_attr($post_col); ?>">
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
                    <?php top_news_block_meta() ?>                                                                                          
                </div><!-- /.content -->
            </article><!-- /.post-item -->
        </div>
    <?php if ($counter%$per_row == 0): ?>
        <div class="clearfix"></div> 
    <?php endif; 
    endwhile;
    wp_reset_postdata();
    endif;
    die();
}
add_action( 'wp_ajax_nopriv_top_news_recent_posts_ajaxify', 'top_news_recent_posts_ajaxify' );
add_action( 'wp_ajax_top_news_recent_posts_ajaxify', 'top_news_recent_posts_ajaxify' );

function top_news_posts_left_thumb_ajaxify() {        
    $limit = isset($_POST['limit']) ? $_POST['limit'] : '';
    $offset = isset($_POST['offset']) ? $_POST['offset'] : '';
    $cat = isset($_POST['cat']) ? $_POST['cat'] : '';
    if( $cat == true) {
        $query_args = array(
            'offset'              => $offset,
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      =>  $limit,
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $cat,
                ),
            ),
            'ignore_sticky_posts' => true,
        );
    } else {
        $query_args = array(
            'offset'              => $offset,
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      =>  $limit,
            'ignore_sticky_posts' => true,
        );
    }    
    $the_query = new WP_Query( $query_args );
    
    $counter=$offset;
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post(); $counter++;
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
    <?php
    endwhile;
    wp_reset_postdata();
    endif;
    die();
}
add_action( 'wp_ajax_nopriv_top_news_posts_left_thumb_ajaxify', 'top_news_posts_left_thumb_ajaxify' );
add_action( 'wp_ajax_top_news_posts_left_thumb_ajaxify', 'top_news_posts_left_thumb_ajaxify' );