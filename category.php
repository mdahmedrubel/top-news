<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * The template for displaying category pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TopNews
 */

get_header();
$top_news_cat_sidebar = '';
$top_news_cat_slider = '';
$top_news_cat_slider_tag = '';
$top_news_cat_slider_limit = '';
$top_news_cat_post_style = '';
$category_column_id = '';
$content_col = '';
$top_news_cat_post_column = '';
$post_col = '';
$post_thumb = '';
$is_excerpt = '';
$is_readmore = '';
$excerpt_limit = '';

if (function_exists('cs_get_option')):
    //category sidebar
    $category_template_sidebar = cs_get_option( 'category_template_sidebar' );     
    if(!empty($category_template_sidebar)) {
        $top_news_cat_sidebar = cs_get_option( 'category_template_sidebar' );
    } else {
        $top_news_cat_sidebar = cs_get_option( 'page_sidebar' );
    }
    
    //category slider
    $top_news_cat_slider = cs_get_option( 'category_slider' );
    $top_news_cat_slider_style = cs_get_option( 'default_category_slider' );
    $top_news_cat_slider_limit = cs_get_option( 'category_slider_post_limit');    
    $top_news_cat_slider_tag = cs_get_option( 'category_slider_tag' );
    
    $top_news_cat_post_style = cs_get_option( 'category_template_post_style' );
    switch($top_news_cat_post_style){
        case 'style-2' :
            $post_class = 'posts-lists archive-row x2';
            $article_class = 'post-item';
            $content_class = 'content';
            break;
        case 'style-3' :
            $post_class = 'posts-lists featured-posts';
            $article_class = 'post-item special x2 cat-x2';
            $content_class = 'post-info';
            break;
        default:
            $post_class = 'posts-lists';
            $article_class = 'post-item';
            $content_class = 'content';
    }

    $top_news_cat_post_column = cs_get_option( 'category_column' );
    $is_excerpt = cs_get_option( 'category_excerpt' );
    $excerpt_limit = cs_get_option( 'category_excerpt_limit' );
    $is_readmore = cs_get_option( 'category_readmore' );
endif;

if ((!empty($top_news_cat_sidebar)) && $top_news_cat_sidebar == 't-style1') {
    $content_col = 'col-md-12 content-holder';
} else if ((!empty($top_news_cat_sidebar)) && $top_news_cat_sidebar == 't-style4'){
    $content_col = 'col-md-6 content-holder';
} else {
    $content_col = 'col-md-8 content-holder';
}

if ((!empty($top_news_cat_post_column)) && $top_news_cat_post_column == '1-col') {
    $post_col = 'col-md-12';
    $post_thumb = 'full';
    $perrow = 1;
} else if ((!empty($top_news_cat_post_column)) && $top_news_cat_post_column == '2-col'){
    $post_col = 'col-md-6 col-sm-6';
    $post_thumb = 'top-news-thumbnail-x2';
    $perrow = 2;
} else if ((!empty($top_news_cat_post_column)) && $top_news_cat_post_column == '3-col'){
    $post_col = 'col-md-4 col-sm-4';
    $post_thumb = 'top-news-thumbnail-x2';
    $perrow = 3;
} else {
    $post_col = 'col-md-12';
    $post_thumb = 'full';
    $perrow = 1;
}
if ($top_news_cat_post_style =='style-2'){
    $post_col = 'col-md-12';
}
if ($top_news_cat_post_style =='style-3'){
    $is_excerpt = 'no';
    $is_readmore = 'no';
}
?>
    <div class="site-content">
        <div class="container">
            <?php if($top_news_cat_slider == 'true' && (!empty($top_news_cat_slider_style)) && $top_news_cat_slider_style == 'full-width-slider'):?>
                <div class="row">
                    <div class="col-md-12">
                        <?php top_news_cat_posts_slider($this_cat_id, $top_news_cat_slider_tag, $top_news_cat_slider_limit) ?>
                    </div>                
                </div>
            <?php endif; ?>            
            <div class="row">
                <?php 
                    if ($top_news_cat_sidebar == 't-style3') { 
                        get_sidebar('right');                         
                    } else if ($top_news_cat_sidebar == 't-style4'){
                        get_sidebar('left');
                    } 
                ?>
                <div class="<?php echo esc_attr($content_col); ?> post-template">
                    <?php if($top_news_cat_slider == 'true' && (!empty($top_news_cat_slider_style)) && $top_news_cat_slider_style == 'content-slider'):?>
                        <div class="">
                            <?php top_news_cat_posts_slider($this_cat_id, $top_news_cat_slider_tag, $top_news_cat_slider_limit); ?>
                        </div>                        
                    <?php endif; ?>
                    <div class="<?php echo esc_attr($post_class); ?>">
                        <?php if ( have_posts() ) : $counter=0;?>
                        <div class="row">
                            <?php while ( have_posts() ) : the_post(); $counter++;

                                top_news_blog_posts($article_class, $post_col, $content_class, $post_thumb, $is_excerpt, $is_readmore, $excerpt_limit);                   
                                if ($counter%$perrow==0): ?>
                                <div class="clearfix"></div> 
                            <?php endif; endwhile; ?>
                        </div>                      
                        <?php endif; ?>            
                    </div>
                    <div class="category-pagination">                        
                        <?php the_posts_pagination(); ?>
                    </div>
                </div>
                <?php 
                    if ($top_news_cat_sidebar == 't-style2' || $top_news_cat_sidebar == 't-style4') { 
                        get_sidebar('right');                         
                    }
                    if (!function_exists('cs_get_option')):
                        get_sidebar('right');
                    endif;                    
                ?>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.site-content -->
<?php get_footer();
