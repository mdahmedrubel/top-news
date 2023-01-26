<?php if (! defined('ABSPATH')) die('Direct access forbidden.');
/**
 * Template part for displaying newsticker.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TopNews
 */
$top_news_limit = '';
$top_news_posts_from = '';
$top_news_posts_cat = '';
$top_news_posts_tag = '';
$limit = '';

if (function_exists('cs_get_option')):
    $top_news_limit = cs_get_option('news_ticker_limit');
    $top_news_posts_from = cs_get_option('news_ticker_post_from');
    $top_news_posts_cat = cs_get_option('news_ticker_posts_cat');
    $top_news_posts_tag = cs_get_option('news_ticker_posts_tag');
endif;

if (! empty($top_news_limit)){
    $limit .= $top_news_limit;
} else{
    $limit .= '5';
}
if ($top_news_posts_from == 'category' && ! empty($top_news_posts_cat)){
    $query_args = array(
        'post_type' => 'post',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $top_news_posts_cat,
           ),
       ),
        'posts_per_page'      =>  $limit,
        'ignore_sticky_posts' => true,
   );
} else if ($top_news_posts_from == 'tag' && ! empty($top_news_posts_tag)){
    $query_args = array(
        'post_type' => 'post',
        'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'term_id',
                'terms'    => $top_news_posts_tag,
           ),
       ),
        'posts_per_page'      =>  $limit,
        'ignore_sticky_posts' => true,
   );
} else{
    $query_args = array(
        'post_type' => 'post',
        'posts_per_page'      =>  $limit,
        'ignore_sticky_posts' => true,
   );
}

$the_query = new WP_Query($query_args);
?>
<div id="news-ticker" class="gray-bg">
    <div class="container">

        <!-- News Ticker -->
        <div class="breking-news-ticker">
            <div class="info">
                <span><?php esc_html_e('Breaking News', 'top-news'); ?></span>
            </div><!-- /.info -->
            <ul class="newsticker">
                <?php
                    if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) : $the_query->the_post();
                ?>
                <li><span class="time"><?php echo get_the_time(); ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php
                    endwhile;
                    wp_reset_postdata();
                    else :
                ?>
                    <li><a><?php esc_html_e('No Post Found', 'top-news'); ?></a></li>
                <?php endif; ?>
            </ul>
            <div class="control">
                <i class="fa fa-pause stop-btn"></i>
                <i class="fa fa-play start-btn"></i>
                <i class="fa fa-angle-left prev-btn"></i>
                <i class="fa fa-angle-right next-btn"></i>
            </div><!-- /.control -->
        </div><!-- /.news-ticker -->

    </div><!-- /.container -->
</div><!-- /#news-ticker -->
