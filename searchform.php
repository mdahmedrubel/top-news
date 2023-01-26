<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
* The template for displaying search form.
*
* @package TopNews
*/
?>
    <i id="nav-search-open" class="fa fa-search"></i>
    <form id="nav-search-form" class="nav-search hidden-form search-form" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'top-news' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'top-news' ); ?>" />
        <i id="nav-search-close" class="fa fa-close"></i>
        <button type="submit" class="submit">
            <span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'top-news' ); ?></span>
            <i class="fa fa-search"></i>
        </button>
    </form>