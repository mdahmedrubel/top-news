<?php if(! defined('ABSPATH')) die('Direct access forbidden.');
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TopNews
 */
$top_news_single_page_sidebar = '';
$content_col = '';
$top_news_related_post = '';

if (function_exists('cs_get_option')):
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
        <article id="post-<?php the_ID(); ?>" <?php post_class(array('single-post-item')); ?>>
                <?php $meta_data = get_post_meta(get_the_ID(), '_format-video', true); ?>
                <header class="entry-header">                
                        <?php 
                        if(!empty($meta_data['embedded_link'])){
                            global $wp_embed;
                        ?>
                        <div class="video-player">
                            <?php echo $wp_embed->run_shortcode('[embed]'. esc_url($meta_data['embedded_link']) .'[/embed]'); ?>
                        </div>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <?php top_news_meta_description() ?>                
                        <?php }else{ 
                            if(has_post_thumbnail()){ ?>
                            <div class="single-special">
                                <div class="post-thumb">
                                        <?php the_post_thumbnail('full'); ?>
                                </div>
                                <div class="post-info">
                                    <h1 class="entry-title"><?php the_title(); ?></h1>
                                    <?php top_news_meta_description() ?>                       
                                </div>
                            </div>                        
                            <?php }else{ ?>
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                                <div class="meta entry-meta">
                                    <span><?php esc_html_e('Posted By','top-news'); ?></span>
                                    <?php the_author_posts_link(); ?>
                                    <span>-</span>
                                    <span class="mr10"><?php echo get_the_date(); ?> </span>
                                    <span class="mr10"><i class="fa fa-eye"></i> <?php if(function_exists('top_news_PostViews')){echo top_news_PostViews(get_the_ID()); }?></span>
                                    <span class="mr10">
                                        <i class="fa fa-comments-o"></i>
                                        <?php comments_popup_link(
                                            esc_html__('Leave a comment', 'top-news'),
                                            esc_html__('1 Comment', 'top-news'),
                                            esc_html__('% Comments', 'top-news')
                                       ); ?>
                                    </span>
                                </div>                    
                            <?php }                        
                            }?>
                </header><!-- /.entry-header -->

                <div class="page-content">
                        <?php the_content(); ?>
                        <?php
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