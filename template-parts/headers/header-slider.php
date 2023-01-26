<?php 
$header_style = cs_get_option('header_style'); 
$is_header_slider = cs_get_option('is_header_slider'); 
$slider_post_limit = cs_get_option('slider_post_limit');
$slider_post_from = cs_get_option('slider_post_from');
$slider_posts_cat = cs_get_option('slider_posts_cat');
$slider_posts_tag = cs_get_option('slider_posts_tag');
?>
<div class="top-slider">
    <?php
    if ($header_style === '2' && is_page() && $is_header_slider == true):
        top_news_posts_slider_v2($slider_post_from, $slider_posts_cat, $slider_posts_tag, $slider_post_limit);
    elseif($header_style === '3' && is_page() && $is_header_slider == true):
        top_news_posts_slider($slider_post_from, $slider_posts_cat, $slider_posts_tag, $slider_post_limit,'full');
    endif;
    ?>
</div>  

