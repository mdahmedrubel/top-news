<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package TopNews
 * @author CodexCoder
 */
register_sidebar(
    array(
        'name'          => esc_html__( 'Sidebar 1 Primary', 'top-news' ),
        'id'            => 'sidebar-right',
        'description'   => 'It is the primary sidebar area of TOp News. Widgets from this sidebar will displayed on left sidebar as default',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2><div class="clearfix"></div>',
    )
);
register_sidebar(
    array(
        'name'          => esc_html__( 'Sidebar 2 Primary', 'top-news' ),
        'id'            => 'sidebar-left',
        'description'   => 'Widgets from this sidebar will displayed on right sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2><div class="clearfix"></div>',
    )
);
register_sidebar(
    array(
        'name'          => esc_html__( 'Footer', 'top-news' ),
        'id'            => 'footer',
        'description'   => 'Widgets from this sidebar will displayed on footer',
        'before_widget' => '<div class="col-md-4"><div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2><div class="clearfix"></div>',
    )
);
$sidebars = '';
if (function_exists('cs_get_option')):
    $sidebars = cs_get_option('custom_sidebars');
endif;

if(!empty($sidebars) ){
  foreach ($sidebars as $sidebar) {
    if( !empty($sidebar['sidebar_name']) ) {
      register_sidebar(array(
        'name' => $sidebar['sidebar_name'],
        'id' => sanitize_title($sidebar['sidebar_name']),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2><div class="clearfix"></div>',
      ));
    }
  }
}