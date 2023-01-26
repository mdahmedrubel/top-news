<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package topnews
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses top_news_header_style()
 */
function top_news_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'top_news_custom_header_args', array(
		'default-image'          => '',
		'width'                  => 1200,
		'height'                 => 120,
		'wp-head-callback'       => 'top_news_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'top_news_custom_header_setup' );

if ( ! function_exists( 'top_news_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see top_news_custom_header_setup().
 */
function top_news_header_style() {
	$header_image = get_header_image();

	// If no custom options for text are set, let's bail.
	if ( empty( $header_image ) ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! empty( $header_image ) ) :
	?>
		.logo-ads-area {

			/*
			 * No shorthand so the Customizer can override individual properties.
			 * @see https://core.trac.wordpress.org/ticket/31460
			 */
			background-image: url(<?php header_image(); ?>);
			background-repeat: no-repeat;
			background-position: 50% 50%;
			-webkit-background-size: cover;
			-moz-background-size:    cover;
			-o-background-size:      cover;
			background-size:         cover;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
