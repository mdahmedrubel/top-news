<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Enqueue all theme scripts and styles on admin
 *
 * @package TopNews
 * @author CodexCoder
 */
// Admin Scripts
wp_enqueue_script( 'topnews-admin', TOPNEWS_ASSETS . '/js/admin-scripts.js', array('jquery'), false, true );