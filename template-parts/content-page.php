<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TopNews
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if( ! is_home() && ! is_front_page() && ! is_page() ) : ?>
	<header class="entry-header test">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
        <?php endif; ?>
        <div class="page-content">
            <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'top-news' ),
                        'after'  => '</div>',
                ) );
            ?>
	</div><!-- .entry-content -->

        <?php
            edit_post_link(
                sprintf(
                        /* translators: %s: Name of current post */
                        esc_html__( 'Edit %s', 'top-news' ),
                        the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ),
                '<p class="edit-link">',
                '</p>'
            );
        ?>
</article><!-- #post-## -->
