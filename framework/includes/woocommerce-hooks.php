<?php
/** Remove breadcrumbs from woocommerce pages */
add_action( 'init', 'top_news_remove_wc_breadcrumbs' );
function top_news_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}


/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'top_news_loop_columns');
if (!function_exists('top_news_loop_columns')) {
	function top_news_loop_columns() {
		return 3; // 3 products per row
	}
}



