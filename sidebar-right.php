<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TopNews
 */

$top_news_sidebar_meta_field = '';
if (function_exists('cs_get_option')):
    if (is_page()){
        $top_news_layout_meta_data = get_post_meta( get_the_ID(), '_custom_page_side_options', true );
        if (!empty($top_news_layout_meta_data)):
            $top_news_sidebar_meta_field = $top_news_layout_meta_data['sidebar_option_1'];
        else :
            $top_news_sidebar_meta_field = 'sidebar-right';
        endif;                                        
    } else if (is_home()){
        $top_news_sidebar_meta_field = cs_get_option( 'blog_template_sidebar_option_1' );
    } else if (class_exists( 'WooCommerce' ) && is_woocommerce()) {
        $shop_template_sidebar_option_1 = cs_get_option( 'shop_template_sidebar_option_1');
        if (!empty($shop_template_sidebar_option_1)){
            $top_news_sidebar_meta_field = cs_get_option( 'shop_template_sidebar_option_1' );
        } else {
            $top_news_sidebar_meta_field = cs_get_option( 'page_sidebar_option_1' );
        }
    } else if (is_category()){
        $category_template_sidebar_option_1 = cs_get_option( 'category_template_sidebar_option_1');
        if (!empty($category_template_sidebar_option_1)){
            $top_news_sidebar_meta_field = cs_get_option( 'page_sidebar_option_1' );
        } else {
            $top_news_sidebar_meta_field = cs_get_option( 'page_sidebar_option_1' );
        }
    } else if (is_archive()) {
        $archive_template_sidebar_option_1 = cs_get_option( 'archive_template_sidebar_option_1');
        if (!empty($archive_template_sidebar_option_1)){
            $top_news_sidebar_meta_field = cs_get_option( 'archive_template_sidebar_option_1' );
        } else {
            $top_news_sidebar_meta_field = cs_get_option( 'page_sidebar_option_1' );
        }
    } else if (is_single()) {
        $single_page_sidebar_option_1 = cs_get_option( 'single_page_sidebar_option_1');
        if (!empty($single_page_sidebar_option_1)){
            $top_news_sidebar_meta_field = cs_get_option( 'single_page_sidebar_option_1' );
        } else {
            $top_news_sidebar_meta_field = cs_get_option( 'page_sidebar_option_1' );
        }
    }
endif;

?>
<div class="col-md-4 sidebar sidebar-large">
    <div class="theiaStickySidebar">
        <div id="secondary" class="widget-area primary-sidebar" role="complementary">
                <?php                    
                    if (!empty($top_news_sidebar_meta_field)) {
                        dynamic_sidebar( $top_news_sidebar_meta_field ); 
                    } else {
                        dynamic_sidebar( 'sidebar-right' );
                    }                 
                ?>
        </div><!-- #secondary -->
    </div>
</div><!-- /.col-md-4 -->
