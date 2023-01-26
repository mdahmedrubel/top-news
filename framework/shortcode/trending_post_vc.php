<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Visual Composer Shortcode of LEFT THUMB ajax
 */
if ( function_exists( 'vc_map' ) ) {
class WPBakeryShortCode_tn_trending_post extends WPBakeryShortCode {

    protected function content($atts, $content = null) {
        extract(shortcode_atts(array(
            'title' 		=> '',           
            'time_limit' 	=> 10,
            'limit' 		=> 5,           
            'el_class' 		=> '',                
        ), $atts));
        
    	ob_start();	 		    				
        top_news_trending_post($title,$time_limit,$limit,$el_class);
        return ob_get_clean();		        	         
    }
}

vc_map( array(
    "base"                  => "tn_trending_post",
    "name"                  => esc_html__("Trending Post", 'top-news'),
    "class"                 => "",
    "category"              => esc_html__('TopNews', 'top-news'),
    "icon"                  => get_template_directory_uri().'/images/admin/left-thumb.jpg',
    "params" => array(
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Title for this block:", 'top-news'),
            "param_name"    => "title",
            "description"   => esc_html__("Enter text which will be used as this block title. Leave blank if no title is needed.", 'top-news'),
        ),                	    	
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Days Ago", 'top-news'),
            "param_name"    => "time_limit",
            "description"   => esc_html__("Trending post limitation by days Eg: 10, Default value is 10", 'top-news'),
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Limit (numeric value only)", 'top-news'),
            "param_name"    => "limit",
            "description"   => esc_html__("Limit of total post Eg: 10, Default value is 10", 'top-news'),
        ),        
    	array(
        "type"              => "textfield",
        "heading"           => esc_html__("Extra class name:", 'top-news'),
        "param_name"        => "el_class",
        "description"       => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'top-news')
      )       	    
    )
) );
}