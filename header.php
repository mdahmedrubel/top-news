<?php
if (! defined('ABSPATH')) die('Direct access forbidden.');
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TopNews
 */
$boxed_layout = $background_image = $top_featured_post = $top_featured_post_limit = $top_featured_post_from = $top_featured_post_cat = $top_featured_post_tag = $is_header_slider = $news_ticker_enabled = $news_ticker_enabled_inner = '';
$header_style = 1;
$is_breadcrumbs = 1;


if (function_exists('cs_get_option')):
    $boxed_layout = cs_get_option('tn_boxed_layout');
    $background_image = cs_get_option('background_image');
    
    $top_featured_post = cs_get_option('tn_top_featured_post');
    $top_featured_post_limit = cs_get_option('tn_top_featured_post_limit');
    $top_featured_post_from = cs_get_option('tn_top_featured_post_from');
    $top_featured_post_cat = cs_get_option('tn_top_featured_post_cat');
    $top_featured_post_tag = cs_get_option('top_featured_post_tag');                

    $header_style = cs_get_option('header_style');    
    $is_header_slider = cs_get_option('is_header_slider');        
    $is_breadcrumbs = cs_get_option('tn_is_breadcrumbs');
    
    $news_ticker_enabled = cs_get_option('news_ticker_enabled');
    $news_ticker_enabled_inner = cs_get_option('news_ticker_enabled_innerpage');
endif;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php if ($boxed_layout == 'true'): top_news_boxed_background_image($background_image);endif; ?>>
    <?php do_action('top_news_after_body'); ?>  
    <div id="wrapper" class="site">
        <?php        
        //featured post on top 
        if (is_front_page() && $top_featured_post == 1 && $header_style != 3):
            top_news_featured_posts_top($top_featured_post_from, $top_featured_post_cat, $top_featured_post_tag, $top_featured_post_limit);
        endif;           
        
        if (! empty($header_style)):
            get_template_part('template-parts/headers/header', $header_style);
        else:
            get_template_part('template-parts/headers/header', '1');
        endif;
        
        //mobile header
        get_template_part('template-parts/headers/mobile', 'header');
        
        //header slider
        if(is_front_page() && $is_header_slider == true && ($header_style == 2 || $header_style == 3)):
            get_template_part('template-parts/headers/header', 'slider');
        endif; 
        ?>
        <div id="content">
            <?php
            if(is_front_page() && $is_header_slider == false && ($header_style == 2 || $header_style == 3)):
                top_news_header_breadcrumbs();            
            elseif(!is_front_page() && $is_breadcrumbs == true):
                top_news_header_breadcrumbs();
            endif;

            if($news_ticker_enabled == true && is_front_page()):
                get_template_part('template-parts/extras/news-ticker');
            elseif ($news_ticker_enabled == true && $news_ticker_enabled_inner == true):
                get_template_part('template-parts/extras/news-ticker');
            endif;