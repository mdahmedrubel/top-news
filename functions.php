<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * TopNews functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package TopNews
 */

/**
  * Theme constants
 */
define( 'TOPNEWS_SLUG' , 'top-news' );
define( 'TOPNEWS_ASSETS' , get_template_directory_uri() . '/assets' );
define( 'TOPNEWS_VENDOR' , TOPNEWS_ASSETS . '/vendor' );


/**
 * Load Core
 */
require get_template_directory() . '/framework/init.php';