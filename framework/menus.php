<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Register Theme Navigation Menu
 *
 * @link https://codex.wordpress.org/Function_Reference/register_nav_menus
 * @package TopNews
 * @author CodexCoder
 */
// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
    'primary' => esc_html__( 'Primary Menu', 'top-news' ),
    'top_bar' => esc_html__( 'Top Bar Menu (Default)', 'top-news' ),
    'vp_guest_menu_items' => esc_html__( 'vp guest menu items', 'top-news' ),
    'vp_subscriber_menu_items' => esc_html__( 'vp subscriber menu items', 'top-news' ),
    'footer' => esc_html__( 'Footer Menu', 'top-news' ),
    'mobile_menu' => esc_html__( 'Mobile Menu', 'top-news' ),
    'top_mini_left' => esc_html__( 'Top Mini (Left)', 'top-news' ),
    'top_mini_right' => esc_html__( 'Top Mini (Right)', 'top-news' )
) );