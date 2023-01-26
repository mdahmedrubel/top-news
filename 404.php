<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package TopNews
 */

get_header(); ?>

<div class="site-content ">
    <div class="container">
        <div class="row">
            <div class="error-content">
                <div class="number">
                    <span class="left-number"><?php esc_html_e( '4', 'top-news' ) ?></span> 
                    <div class="opps-outer">
                        <div class="opps">
                            <div class="opps-inner"><?php esc_html_e( 'OOPS', 'top-news' ) ?></div>
                        </div> 
                    </div>
                    <span class="right-number"><?php esc_html_e( '4', 'top-news' ) ?></span>
                </div>
                <h2><?php esc_html_e( 'Page not found', 'top-news' ) ?></h2>
                <p><?php esc_html_e( 'The Page you are looking for can&#8217;t be found. Go home by ', 'top-news' ) ?><a href="<?php echo esc_url(home_url('/')) ?>"><?php esc_html_e( 'clicking here!', 'top-news' ) ?></a></p>
            </div><!-- /.error-content -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.site-content -->

<?php get_footer(); ?>
