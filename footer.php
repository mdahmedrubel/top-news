<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package TopNews
 */
$top_news_copyright_text = '';
if (function_exists('cs_get_option')):
    $top_news_copyright_text = cs_get_option( 'copyright_text' );
endif;
$active = (is_active_sidebar( 'footer' )) ? 'active' : 'not-activated';
?>

	    </div><!-- #content -->

        <!--==============================
        =            Footer		    	=
        ==============================-->
        <footer id="footer" class="dark site-footer <?php echo esc_attr($active); ?>">
            <?php if( is_active_sidebar( 'footer' )) : ?>
                <div class="container">
                    <div class="row">
                        <?php dynamic_sidebar( 'footer' ); ?>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            <?php endif; ?>

            <div class="dark2 footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="copyright-content">
                                <?php                                  
                                if (!empty($top_news_copyright_text)){
                                    echo wp_kses_post($top_news_copyright_text);
                                }
                                ?>
                            </p>
                        </div><!-- /.col-sm-6 -->
                        <?php if ( has_nav_menu( 'footer' ) ) : ?>
                            <div class="col-sm-6">
                                <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'footer',
                                            'menu_id' => 'footer-menu',
                                            'menu_class' => 'footer-menu text-right',
                                            'container' => false,
                                            'depth'    => 1
                                        )
                                    );
                                ?>
                            </div><!-- /.col-sm-6 -->
                        <?php endif; ?>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.footer-bottom -->
        </footer><!-- /#footer -->

    </div><!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
