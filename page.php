<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TopNews
 */

get_header();
$top_news_featured_post_grid = '';
$top_news_layout_meta_field = '';
$top_news_use_theme_option = '';
if (function_exists('cs_get_option')):

    $top_news_featured_post_grid = cs_get_option('featured_post_grid');
    $top_news_featured_post_layout = cs_get_option( 'featured_post_layout' );
    $top_news_featured_post_limit = cs_get_option( 'featured_post_limit' );
    $top_news_featured_post_from = cs_get_option( 'featured_post_from' );
    $top_news_featured_category = cs_get_option( 'featured_posts_cat' );
    $top_news_featured_tag = cs_get_option( 'featured_posts_tag' );    

    $top_news_layout_meta_data = get_post_meta( get_the_ID(), '_custom_page_side_options', true );
    if (!empty($top_news_layout_meta_data)):
        $top_news_layout_meta_field = $top_news_layout_meta_data['section_3_image_select'];
        else :
        $top_news_layout_meta_field = 'v2';
    endif;
endif;

if (is_front_page() && $top_news_featured_post_grid == 'true'){
    switch($top_news_featured_post_layout) {
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
            top_news_posts_slider($top_news_featured_post_from, $top_news_featured_category, $top_news_featured_tag, $top_news_featured_post_limit,'top-news-large-slider');
            echo '</div>'
            . '</div>'
            . '</div>';
        break;
    
        default:            
            top_news_featured_posts_v3($top_news_featured_post_from, $top_news_featured_category, $top_news_featured_tag, $top_news_featured_post_limit);
    }
}
?>  
    <div class="site-content">
        <div class="container">
            <div class="row">
            <?php                
                switch ($top_news_layout_meta_field) {
                    case 'v1' :
                        top_news_get_layouts('col-md-12 content-holder', '', '', '', '');                        
                    break;    
                    case 'v2' :
                        top_news_get_layouts('', '', '', 'col-md-8 content-holder', 'right');
                    break;    
                    case 'v3' :
                        top_news_get_layouts('', 'right', '', 'col-md-8 content-holder', '');
                    break;    
                    case 'v4' :
                        top_news_get_layouts('', '', 'left', 'col-md-6 content-holder', 'right');
                    break;    
                    case 'v5' :
                        top_news_get_layouts('', 'left', 'right', 'col-md-6 content-holder', '');
                    break;
                    case 'v6' :
                        top_news_get_layouts('col-md-6 content-holder', 'left', 'right', '', '');
                    break;
                    default:                                    
                        top_news_get_layouts('', '', '', 'col-md-8 content-holder', 'right');
                }                
            ?>                            
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.site-content -->

<?php get_footer();
