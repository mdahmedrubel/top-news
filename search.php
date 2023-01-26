<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package TopNews
 */

get_header(); 
$top_news_sidebar = '';
$content_col = '';
if (function_exists('cs_get_option')):
    $top_news_sidebar = cs_get_option( 'page_sidebar' );
endif;

if ((!empty($top_news_sidebar)) && $top_news_sidebar == 't-style1') {
    $content_col = 'col-md-12 content-holder';
} else if ((!empty($top_news_sidebar)) && $top_news_sidebar == 't-style4'){
    $content_col = 'col-md-6 content-holder';
} else {
    $content_col = 'col-md-8 content-holder';
}
?>
<header class="page-header">
    <div class="container">
        <h1 class="page-title search-title"><?php printf( esc_html__( 'Search Results for : %s', 'top-news' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    </div><!-- /.container -->
</header><!-- .page-header -->

<div class="site-content">
    <div class="container">
        <div class="row">
            <?php 
                if ($top_news_sidebar == 't-style3') { 
                    get_sidebar('right');                         
                } else if ($top_news_sidebar == 't-style4'){
                    get_sidebar('left');
                } 
            ?>            
            <div class="<?php echo esc_attr($content_col); ?>">
                <div class="posts-lists archive-row x2 search-page">

            <?php if ( have_posts() ) : ?>

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                        <?php
                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', 'search' );
                        ?>

                <?php endwhile; ?>
                <div class="single-pagination">                    
                    <?php the_posts_pagination(); ?>
                </div>
            <?php else : ?>

                <?php get_template_part( 'template-parts/content', 'none' ); ?>

            <?php endif; ?>

                </div> 
            </div>
            <?php 
                if ($top_news_sidebar == 't-style2' || $top_news_sidebar == 't-style4') { 
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
