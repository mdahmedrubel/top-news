<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

/**
 * WordPress Category or Archives Count Fix
 *
 * @param $variable
 *
 * @return mixed
 */
// Category
function top_news_cat_count_filter ($variable) {
    $variable = str_replace('(', '<span class="post_count">(', $variable);
    $variable = str_replace(')', ')</span>', $variable);
    return $variable;
}

// Archives Filter
function top_news_archives_count_filter ($variable) {
    $variable = str_replace('&nbsp;(', '<span class="post_count">(', $variable);
    $variable = str_replace(')', ')</span>', $variable);
    return $variable;
}