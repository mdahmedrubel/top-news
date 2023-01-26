<?php
if (! defined('ABSPATH')) die('Direct access forbidden.');
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TopNews
 */

get_header();
$archive_template_sidebar = '';
$top_news_archive_post_style = '';
$is_excerpt = '';
$is_readmore = '';
$post_col = '';
$post_thumb = '';
$archive_column = '';
$archive_excerpt_limit = '';

if (function_exists('cs_get_option')):
    //sidebar
    $archive_template_sidebar = cs_get_option('archive_template_sidebar');
    if(empty($archive_template_sidebar)) {
        $archive_template_sidebar = cs_get_option('page_sidebar');
    }
    
    //archive post    
    $archive_template_post_style = cs_get_option('archive_template_post_style');
    $is_excerpt = cs_get_option('archive_excerpt');
    $archive_excerpt_limit = cs_get_option('archive_excerpt_limit');
    $is_readmore = cs_get_option('archive_readmore');
    $archive_column = cs_get_option('archive_column');
    switch($archive_template_post_style){
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

    if(!empty($archive_readmore)) {
        $is_readmore = cs_get_option('archive_readmore');
    }
endif;

if ((!empty($archive_template_sidebar)) && $archive_template_sidebar == 't-style1') {
    $content_col = 'col-md-12 content-holder';
} else if ((!empty($archive_template_sidebar)) && $archive_template_sidebar == 't-style4'){
    $content_col = 'col-md-6 content-holder';
} else {
    $content_col = 'col-md-8 content-holder';
}

if ((!empty($archive_column)) && $archive_column == '1-col') {
    $post_col = 'col-md-12';
    $post_thumb = 'full';
    $perrow = 1;
} else if ((!empty($archive_column)) && $archive_column == '2-col'){
    $post_col = 'col-md-6 col-sm-6';
    $post_thumb = 'top-news-thumbnail-x2';
    $perrow = 2;
} else if ((!empty($archive_column)) && $archive_column == '3-col'){
    $post_col = 'col-md-4 col-sm-4';
    $post_thumb = 'top-news-thumbnail-x2';
    $perrow = 3;
} else {
    $post_col = 'col-md-12';
    $post_thumb = 'full';
    $perrow = 1;
}
if ($archive_template_post_style =='style-2'){
    $post_col = 'col-md-12';
}
if ($archive_template_post_style =='style-3'){
    $is_excerpt = 'no';
    $is_readmore = 'no';
}
?>
    <div class="site-content">
        <div class="container">
            <div class="row">
                <?php 
                    if ($archive_template_sidebar == 't-style3') { 
                        get_sidebar('right');                         
                    } else if ($archive_template_sidebar == 't-style4'){
                        get_sidebar('left');
                    } 
                ?>
                <div class="<?php echo esc_attr($content_col); ?> post-template">
                    <div class="<?php echo esc_attr($post_class); ?>">
                        <?php if ( have_posts() ) : $counter=0;?>
                        <div class="row">
                            <?php while ( have_posts() ) : the_post(); $counter++;

                                top_news_blog_posts($article_class, $post_col, $content_class, $post_thumb, $is_excerpt, $is_readmore, $archive_excerpt_limit);                   
                                if ($counter%$perrow==0): ?>
                                <div class="clearfix"></div> 
                            <?php endif; endwhile; ?>
                        </div>                      
                        <?php endif; ?>            
                    </div>
                    <div class="archive-pagination">                        
                        <?php the_posts_pagination(); ?>
                    </div>                    
                </div>
                <?php 
                    if ($archive_template_sidebar == 't-style2' || $archive_template_sidebar == 't-style4') { 
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
