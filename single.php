<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TopNews
 */

get_header();
$top_news_single_page_post_style = '';
$single_style = '';
$single_post_style_meta = '';
if (function_exists('cs_get_option')):
    $single_page_post_style = cs_get_option( 'single_page_post_style');
    $top_news_post_option_meta_data = get_post_meta( get_the_ID(), '_post_template_options', true );
    $single_post_style_meta = isset($top_news_post_option_meta_data['single_post_style']) ? $top_news_post_option_meta_data['single_post_style'] : '';
    if (!empty($single_post_style_meta)) {
        $single_style = $single_post_style_meta;    
    }else{
        $single_style = $single_page_post_style;
    }
endif;
?>
<?php if($single_style == 'style-2' || $single_style == 'style-4'): ?>
<?php while ( have_posts() ) : the_post();
    
    if ( has_post_thumbnail() ):                     
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="single-special single-special-img-top">
                <div class="post-thumb entry-featured">
                        <?php the_post_thumbnail('full'); ?>
                </div>
                <?php if($single_style == 'style-2'): ?>
                <div class="overlay"></div>
                <div class="post-info">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <?php top_news_meta_description() ?>                      
                </div>
                <?php endif; ?>
            </div>
        </div>        
    </div>
</div>
<div class="clearfix"></div>
<?php 
        endif;
    endwhile;
?>
<?php endif; ?>
<div class="site-content <?php echo esc_attr($single_style) ?>">
    <div class="container">
        <div class="row">
            <?php
            switch ($single_style) {                                
                case "default-style" :
                    get_template_part( 'template-parts/content', 'single' );
                    break;
                
                case "style-1" :
                    get_template_part( 'template-parts/content', 'single1' );
                    break;
                
                case "style-2" :
                    get_template_part( 'template-parts/content', 'single2' );
                    break;
                
                case "style-3" :
                    get_template_part( 'template-parts/content', 'single3' );
                    break;
                
                case "style-4" :
                    get_template_part( 'template-parts/content', 'single4' );
                    break;
                
                default:
                    get_template_part( 'template-parts/content', 'single' );
                    break;
            }
            ?>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.site-content -->

<?php get_footer();
