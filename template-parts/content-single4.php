<?php if(! defined('ABSPATH')) die('Direct access forbidden.');
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TopNews
 */
$tn_single_top_category_list = '';
$top_news_single_page_sidebar = '';
$content_col = '';
$top_news_related_post = '';

if (function_exists('cs_get_option')):
    $tn_single_top_category_list = cs_get_option( 'tn_single_top_category_list' );
    $single_page_sidebar = cs_get_option('single_page_sidebar');
    if(!empty($single_page_sidebar)){
        $top_news_single_page_sidebar = cs_get_option('single_page_sidebar');
    }else{
        $top_news_single_page_sidebar = cs_get_option('page_sidebar');
    }
    $top_news_related_post = cs_get_option('tn_related_post');
endif;

if((!empty($top_news_single_page_sidebar)) && $top_news_single_page_sidebar == 't-style1'){
    $content_col = 'col-md-12 content-holder';
}else if((!empty($top_news_single_page_sidebar)) && $top_news_single_page_sidebar == 't-style4'){
    $content_col = 'col-md-6 content-holder';
}else{
    $content_col = 'col-md-8 content-holder';
}


if($top_news_single_page_sidebar == 't-style3'){
    get_sidebar('right');                         
}else if($top_news_single_page_sidebar == 't-style4'){
    get_sidebar('left');
}
?>
<div class="<?php echo esc_attr($content_col); ?>">
    <div class="theiaStickySidebar">
    <?php while(have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(array('single-layout6 single-post-item')); ?>>
            <header class="entry-header">
            <?php                
                if ($tn_single_top_category_list == 'true'):
                    top_news_single_cat_list($post->ID);
                endif; 
                the_title( '<h1 class="entry-title">', '</h1>' );
                top_news_single_meta_description(); 
            ?>
            </header>

            <div class="page-content">
                <?php 
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'top-news'),
                        'after'  => '</div>',
                   ));
                ?>
            </div><!-- .entry-content -->
            <?php get_template_part('template-parts/single', 'footer'); ?>

        </article><!-- #post-## -->                
        <?php get_template_part('template-parts/single', 'author'); ?>
        <div class="post-navigation">

                <div class="pull-left nav-item">
                        <?php
                                echo get_previous_post_link(
                                        '%link',
                                        '<i class="fa fa-chevron-left"></i><span>' . esc_html__('Previous Post', 'top-news') . '</span>'
                               );
                        ?>
                </div><!-- /.pull-left -->

                <div class="pull-right nav-item">
                        <?php
                                echo get_next_post_link(
                                    '%link',
                                    '<span>' . esc_html__('Next Post', 'top-news') . '</span><i class="fa fa-chevron-right"></i>'
                               );
                        ?>
                </div><!-- /.pull-left -->

        </div><!-- /.post-navigation -->
        <?php
        
        if($top_news_related_post === 'true'):
            top_news_related_posts(get_the_ID());
        endif;
        ?>

        <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if(comments_open() || get_comments_number()) :
                        comments_template();
                endif;
        ?>

    <?php endwhile; // End of the loop. ?>
    </div>
</div>
<?php 
    if($top_news_single_page_sidebar == 't-style2' || $top_news_single_page_sidebar == 't-style4'){ 
        get_sidebar('right');                         
    }
    if (!function_exists('cs_get_option')):
        get_sidebar('right');
    endif;    
?>