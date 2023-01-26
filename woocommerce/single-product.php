<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

$top_news_shop_sidebar = '';

if (function_exists('cs_get_option')):
    $shop_template_sidebar = cs_get_option('shop_template_sidebar');
    if(!empty($shop_template_sidebar)) {
        $top_news_shop_sidebar = cs_get_option('shop_template_sidebar');
    } else {
        $top_news_shop_sidebar = cs_get_option('page_sidebar');
    }
endif;

if ((!empty($top_news_shop_sidebar)) && $top_news_shop_sidebar == 't-style1') {
    $content_col = 'col-md-12 content-holder';
} else if ((!empty($top_news_shop_sidebar)) && $top_news_shop_sidebar == 't-style4'){
    $content_col = 'col-md-6 content-holder';
} else {
    $content_col = 'col-md-8 content-holder';
}
get_header(); ?>
    <div class="site-content">
        <div class="container">
            <div class="row">     
                <?php 
                    if ($top_news_shop_sidebar == 't-style3') { 
                        get_sidebar('right');                         
                    } else if ($top_news_shop_sidebar == 't-style4'){
                        get_sidebar('left');
                    } 
                ?>
                <div class="<?php echo esc_attr($content_col); ?>">
                        <?php
                            do_action( 'woocommerce_before_main_content' );
                        ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php wc_get_template_part( 'content', 'single-product' ); ?>

                        <?php endwhile; // end of the loop. ?>

                        <?php
                            do_action( 'woocommerce_after_main_content' );
                        ?>
                </div>
                <?php 
                    if ($top_news_shop_sidebar == 't-style2' || $top_news_shop_sidebar == 't-style4') { 
                        get_sidebar('right');                         
                    }
                    if (!function_exists('cs_get_option')):
                        get_sidebar('right');
                    endif;                    
                ?> 
            </div>
        </div>
    </div>
<?php get_footer( 'shop' ); ?>
