<?php
if (! defined('ABSPATH')) die('Direct access forbidden.');
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TopNews
 */
get_header();
$top_news_blog_slider = $blog_template_sidebar = $top_news_blog_sidebar = $top_news_blog_slider_style = $top_news_blog_slider_limit = $top_news_blog_slider_tag = $top_news_blog_post_style = $post_col = $is_excerpt = $is_readmore = $post_thumb = $blog_excerpt_limit = $top_news_blog_post_column = $top_news_featured_post_grid = $perrow = $tn_blog_pagination = '';

$content_class = 'content';
$article_class = 'posts-lists';

if (function_exists('cs_get_option')):
    //sidebar
    $top_news_blog_sidebar = cs_get_option('blog_template_sidebar');
    if(empty($top_news_blog_sidebar)){
        $top_news_blog_sidebar = cs_get_option('page_sidebar');
    }
    
    //slider area
    if(cs_get_option('blog_slider') == 'true'){
        $top_news_blog_slider = cs_get_option('blog_slider');
        $top_news_blog_slider_style = cs_get_option('blog_slider_style');
        $top_news_blog_slider_limit = cs_get_option('blog_slider_post_limit');    
        $top_news_blog_slider_tag = cs_get_option('blog_slider_tag');  
    }

    //featured post area
    $top_news_featured_post_grid = cs_get_option('blog_featured_post_grid');
    $top_news_featured_post_layout = cs_get_option('blog_featured_post_layout');
    $top_news_featured_post_limit = cs_get_option('blog_featured_post_limit');
    $top_news_featured_post_from = cs_get_option('blog_featured_post_from');
    $top_news_featured_category = cs_get_option('blog_featured_posts_cat');
    $top_news_featured_tag = cs_get_option('blog_featured_posts_tag'); 
    
    //blog post area
    $top_news_blog_post_column = cs_get_option('blog_column');
    $top_news_blog_post_style = cs_get_option('blog_template_post_style');
    $is_excerpt = cs_get_option('blog_excerpt');
    $blog_excerpt_limit = cs_get_option('blog_excerpt_limit');
    $is_readmore = cs_get_option('blog_readmore');
    $tn_blog_pagination = cs_get_option('tn_blog_pagination');
    switch($top_news_blog_post_style){
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
endif;

if ((!empty($top_news_blog_sidebar)) && $top_news_blog_sidebar == 't-style1'){
    $content_col = 'col-md-12 content-holder';
} else if ((!empty($top_news_blog_sidebar)) && $top_news_blog_sidebar == 't-style4'){
    $content_col = 'col-md-6 content-holder';
} else{
    $content_col = 'col-md-8 content-holder';
}

if ((!empty($top_news_blog_post_column)) && $top_news_blog_post_column == '1-col'){
    $post_col = 'col-md-12';
    $post_thumb = 'full';
    $perrow = 1;
}else if ((!empty($top_news_blog_post_column)) && $top_news_blog_post_column == '2-col'){
    $post_col = 'col-md-6 col-sm-6';
    $post_thumb = 'top-news-thumbnail-x2';
    $perrow = 2;
}else if ((!empty($top_news_blog_post_column)) && $top_news_blog_post_column == '3-col'){
    $post_col = 'col-md-4 col-sm-4';
    $post_thumb = 'top-news-thumbnail-x2';
    $perrow = 3;
}else{
    $post_col = 'col-md-12';
    $post_thumb = 'full';
    $perrow = 1;
}
if ($top_news_blog_post_style =='style-2'){
    $post_col = 'col-md-12';
}
if ($top_news_blog_post_style =='style-3'){
    $is_excerpt = 'no';
    $is_readmore = 'no';
}

//featured post area
if ($top_news_featured_post_grid == 'true'):
    switch($top_news_featured_post_layout){
        case '2-4-col' :
            top_news_featured_posts($top_news_featured_post_from, $top_news_featured_category, $top_news_featured_tag, $top_news_featured_post_limit);
        break;
    
        case '2-4-col-v2' :
            top_news_featured_posts_v1($top_news_featured_post_from, $top_news_featured_category, $top_news_featured_tag, $top_news_featured_post_limit);
        break;
        
        case '2-3-col' :
            top_news_featured_posts_v2($top_news_featured_post_from, $top_news_featured_category, $top_news_featured_tag, $top_news_featured_post_limit);
        break;            
    
        case 'slider-thumb' :
            echo '<div id="featured-news" class="gray-bg">'
            . '<div class="container">'
                . '<div class="featured-posts clearfix">';
            top_news_featured_posts_thumbslider($top_news_featured_post_from, $top_news_featured_category, $top_news_featured_tag, $top_news_featured_post_limit);
            echo '</div></div></div>';
        break;
    
        case 'slider-no-thumb' :
            echo '<div id="featured-news" class="gray-bg">'
            . '<div class="container">'
                . '<div class="featured-posts clearfix">';
            top_news_posts_slider($top_news_featured_post_from, $top_news_featured_category, $top_news_featured_tag, $top_news_featured_post_limit, 'top-news-large-slider');
            echo '</div>'
            . '</div>'
            . '</div>';
        break;
    
        default:            
            top_news_featured_posts_v3($top_news_featured_post_from, $top_news_featured_category, $top_news_featured_tag, $top_news_featured_post_limit);
    }
endif;
?>
    <div class="site-content">
        <div class="container">
            <?php if($top_news_blog_slider == 'true' && (!empty($top_news_blog_slider_style)) && $top_news_blog_slider_style == 'full-width-slider'):?>
                <div class="row">
                    <div class="col-md-12">
                        <?php top_news_cat_posts_slider('', $top_news_blog_slider_tag, $top_news_blog_slider_limit) ?>
                    </div>                
                </div>
            <?php endif; ?>             
            <div class="row">
                <?php 
                    if ($top_news_blog_sidebar == 't-style3'){
                        get_sidebar('right');                         
                    } else if ($top_news_blog_sidebar == 't-style4'){
                        get_sidebar('left');
                    } 
                ?>
                <div class="<?php echo esc_attr($content_col); ?> post-template">
                <?php if($top_news_blog_slider == 'true' && (!empty($top_news_blog_slider_style)) && $top_news_blog_slider_style == 'content-slider'):?>
                    <div class="">
                        <?php top_news_cat_posts_slider('', $top_news_blog_slider_tag, $top_news_blog_slider_limit); ?>
                    </div>                        
                <?php endif; ?>
                    <div class="blog-post-area <?php echo esc_attr($post_class); ?>">
                        <?php if ( have_posts() ) : $counter=0;?>
                        <div class="row">
                            <?php while ( have_posts() ) : the_post(); $counter++;

                                top_news_blog_posts($article_class, $post_col, $content_class, $post_thumb, $is_excerpt, $is_readmore, $blog_excerpt_limit);                   
                                if ($counter%$perrow==0): ?>
                                <div class="clearfix"></div> 
                            <?php endif; endwhile; ?>
                        </div>                      
                        <?php endif; ?>            
                    </div>
                    <div class="clearfix"></div>
                    <div class="single-pagination">
                        <?php if($tn_blog_pagination == 'ajax-load'): ?>
                        <a class="load-more" href="#"><i class="fa fa-spinner"></i> <?php esc_html_e('Load More', 'top-news'); ?></a>
                        <a class="loading" href="#"><i class="fa fa-spinner fa-spin"></i> <?php esc_html_e('Loading ....', 'top-news'); ?></a>
                        <?php else : the_posts_pagination(); endif;?>
                    </div>                      
                </div>
                <?php 
                    if ($top_news_blog_sidebar == 't-style2' || $top_news_blog_sidebar == 't-style4'){ 
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
