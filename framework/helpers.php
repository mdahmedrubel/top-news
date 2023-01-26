<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Helper functions used all over the theme
 *
 * @package TopNews
 * @author Codexcoder
 */

if ( ! function_exists( 'top_news_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function top_news_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on TopNews, use a find and replace
         * to change 'top-news' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'top-news', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );
        
        /*
         * Enable support for woocommerce
         * 
         */
        add_theme_support( 'woocommerce' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        /*
         * Post Thumbnail Size
         *
         * @link https://developer.wordpress.org/reference/functions/add_image_size/
         */
        add_image_size( 'top-news-large-slider', 1140, 570, true );
        add_image_size( 'top-news-thumbnail-x2', 360, 260, true );
        add_image_size( 'top-news-slider-thumb', 368, 164, true );
        add_image_size( 'top-news-large-featured', 760, 320, true );
        add_image_size( 'top-news-thumbnail-featured', 380, 320, true );
        add_image_size( 'top-news-3-col-featured', 376, 316, true );
        add_image_size( 'top-news-gallery-wide', 555, 320, true );



        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );
        
        // Set up the WordPress core custom background feature.
    	add_theme_support( 'custom-background', apply_filters( 'top_news_custom_background_args', array(
    		'default-color' => 'ffffff',
    		'default-image' => '',
    	) ) );

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array('video'));

        /*
         * Enable support for gutenberg editor style
         * See https://wordpress.org/gutenberg/handbook/designers-developers/developers/themes/theme-support/#editor-styles
         */
        add_theme_support( 'editor-styles' );

        //add_theme_support( 'wp-block-styles' );
        
        add_theme_support( 'align-wide' );

    }
endif; // top_news_setup

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function top_news_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'top_news_content_width', 640 );
}

// codestar framework per category settings
if( ! function_exists( 'topnews_get_per_categories' ) && function_exists('cs_get_option')) {
    function top_news_get_per_categories() {
        $categoriesterms = get_categories();
        $categories = array();
        $categories[] = array(
            'type'      => 'heading',
            'content'   =>  esc_html__('Default Category Layout Settings', 'top-news'),
        );
        $categories[] = array(
          'id'         => 'cat_page_header',
          'type'       => 'switcher',
          'title'      =>  esc_html__('Page Header (for header 2 & 3)', 'top-news'),
          'default'    => true
        );
        $categories[] = array(
            'id'        => 'cat_header_bg',
            'type'      => 'image',
            'title'     =>  esc_html__('Header Background', 'top-news'),
            'add_title' => 'Add Image',
            'dependency'      => array( 'cat_page_header', '==', 'true' ),
        );
        $categories[] = array(
            'id'        => 'category_template_sidebar',
            'type'      => 'image_select',
            'title'     =>  esc_html__('Default Category Template', 'top-news'),
            'options'   => array(
                '' => get_template_directory_uri().'/images/admin/default.jpg',
                't-style1' => get_template_directory_uri().'/images/admin/t-style-01.jpg',
                't-style2' => get_template_directory_uri().'/images/admin/t-style-02.jpg',
                't-style3' => get_template_directory_uri().'/images/admin/t-style-03.jpg',
                't-style4' => get_template_directory_uri().'/images/admin/t-style-04.jpg',            
            ),
            'default'   => '',
        );
        $categories[] = array(
            'id'             => 'category_template_sidebar_option_1',
            'type'           => 'select',
            'title'          =>  esc_html__('Default Category Template Sidebar 1', 'top-news'),
            'options'        => top_news_get_registered_sidebars(),
            'default_option' =>  esc_html__('Select a sidebar', 'top-news'),
        );
        $categories[] = array(
            'id'             => 'category_template_sidebar_option_2',
            'type'           => 'select',
            'title'          =>  esc_html__('Default Category Template Sidebar 2', 'top-news'),
            'options'        => top_news_get_registered_sidebars(),
            'default_option' =>  esc_html__('Select a sidebar', 'top-news'),
        );        
        $categories[] = array(
            'id'             => 'category_template_post_style',
            'type'           => 'select',
            'title'          =>  esc_html__('Post Style:', 'top-news'),
            'options'     => array(            
                'style-1'  =>  esc_html__('Style 1 (Thumb on top)', 'top-news'),             
                'style-2'  =>  esc_html__('Style 2 (Thumb on left)', 'top-news'),            
                'style-3'  =>  esc_html__('Style 3 (Stylish)', 'top-news'),           
            ),
        );
        $categories[] = array(
            'id'            => 'category_excerpt',
            'type'          => 'select',
            'title'         =>  esc_html__('Excerpt', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes','top-news'),             
                ''  =>  esc_html__('No','top-news'),                     
            ),
            'default'       => 'true',
            'dependency'   => array( 'category_template_post_style', 'any', 'style-1,style-2' ),
        );
        $categories[] = array(
            'id'            => 'category_excerpt_limit',
            'type'          => 'text',
            'title'         =>  esc_html__('Excerpt Word Limit', 'top-news'),
            'default'       => '15',
            'dependency'   => array( 'category_template_post_style', 'any', 'style-1,style-2' ),
        );
        $categories[] = array(
            'id'            => 'category_readmore',
            'type'          => 'select',
            'title'         =>  esc_html__('Readmore', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes','top-news'),             
                ''  =>  esc_html__('No','top-news'),                     
            ),
            'default'       => 'true',
            'dependency'   => array( 'category_template_post_style', 'any', 'style-1,style-2' ),
        );
        $categories[] = array(
            'id'             => 'category_column',
            'type'           => 'select',
            'title'          =>  esc_html__('Post Column','top-news'),
            'options'        => array(
                '1-col'      =>  esc_html__('1 column','top-news'),
                '2-col'      =>  esc_html__('2 column','top-news'),
                '3-col'      =>  esc_html__('3 columon','top-news'),
            ),
            'dependency'   => array( 'category_template_post_style', 'any', 'style-1,style-3' ),
        );
        $categories[] = array(
            'id'            => 'category_slider',
            'type'          => 'switcher',
            'title'         =>  esc_html__('Category Slider', 'top-news'),
            'default'       => false
        );
        $categories[] = array(
            'id'             => 'default_category_slider',
            'type'           => 'select',
            'title'          =>  esc_html__('Deafult Slider Style:', 'top-news'),
            'options'        => array(
                'content-slider'         =>  esc_html__('Content area slider','top-news'),
                'full-width-slider'  =>  esc_html__('Full width slider','top-news'),                                                
            ),
            'dependency'     => array( 'category_slider', '==', 'true' ),
        );
        $categories[] = array(
            'id'      => 'category_slider_post_limit',
            'type'    => 'number',
            'title'   =>  esc_html__('Slider Posts Limit:', 'top-news'),
            'default'   => '5',
            'dependency'     => array( 'category_slider', '==', 'true' ),
        );
        $categories[] = array(
            'id'             => 'category_slider_tag',
            'type'           => 'select',
            'title'          =>  esc_html__('Tag:', 'top-news'),
            'options'        => 'tag',
            'query_args'     => array(
                'orderby'      => 'name',
                'order'        => 'ASC',
            ),
            'attributes' => array(
                'multiple' => 'multiple',
                'style'    => 'width: 200px; height: 100px;'
            ),
            'default_option' =>  esc_html__('Select slider tag', 'top-news'),
            'dependency'     => array( 'category_slider', '==', 'true' ),
        );
        /** 
         * Template settings for each category 
        **/
        $categories[] = array(
            'type'      => 'heading',
            'content'   =>  esc_html__('Per Category Template Settings', 'top-news'),
        );
        foreach ($categoriesterms as $categoriesterm) {
            $categories[] = array(
                'type'      => 'subheading',
                'content'   =>  $categoriesterm->name.' Category Template Settings',
            );
            $categories[] = array(
              'id'         => 'cat_page_header_'.$categoriesterm->term_id,
              'type'       => 'switcher',
              'title'      =>  esc_html__('Page Header (for header 2 & 3)', 'top-news'),
              'default'    => true
            );
            $categories[] = array(
                'id'        => 'cat_header_bg_'.$categoriesterm->term_id,
                'type'      => 'image',
                'title'     =>  esc_html__('Header Background', 'top-news'),
                'add_title' => 'Add Image',
                'dependency'      => array( 'cat_page_header_'.$categoriesterm->term_id, '==', 'true' ),
            );            
            $categories[] = array(
                    'id'        => 'category_template_sidebar_'.$categoriesterm->term_id,
                    'type'      => 'image_select',
                    'title'     => $categoriesterm->name .' Category Template Style',
                    'options'   => array(
                        '' => get_template_directory_uri().'/images/admin/default.jpg',
                        't-style1' => get_template_directory_uri().'/images/admin/t-style-01.jpg',
                        't-style2' => get_template_directory_uri().'/images/admin/t-style-02.jpg',
                        't-style3' => get_template_directory_uri().'/images/admin/t-style-03.jpg',
                        't-style4' => get_template_directory_uri().'/images/admin/t-style-04.jpg',            
                    ),
                    'default' => '',   
            );
            $categories[] = array(
                'id'             => 'category_template_sidebar_option_1_'.$categoriesterm->term_id,
                'type'           => 'select',
                'title'          =>  $categoriesterm->name .' Category Template Sidebar 1',
                'options'        => top_news_get_registered_sidebars(),
                'default_option' => 'Select a sidebar',
            );
            $categories[] = array(
                'id'             => 'category_template_sidebar_option_2_'.$categoriesterm->term_id,
                'type'           => 'select',
                'title'          =>  $categoriesterm->name .' Category Template Sidebar 2',
                'options'        => top_news_get_registered_sidebars(),
                'default_option' => 'Select a sidebar',
            );
            $categories[] = array(
                'id'             => 'category_template_post_style_'.$categoriesterm->term_id,
                'type'           => 'select',
                'title'          =>  esc_html__('Post Style:', 'top-news'),
                'options'     => array(            
                    'style-1'  =>  esc_html__('Style 1 (Thumb on top)', 'top-news'),             
                    'style-2'  =>  esc_html__('Style 2 (Thumb on left)', 'top-news'),            
                    'style-3'  =>  esc_html__('Style 3 (Stylish)', 'top-news'),           
                ),                
                'default_option' => 'Select a style',
            );
            $categories[] = array(
                'id'            => 'category_excerpt_'.$categoriesterm->term_id,
                'type'          => 'select',
                'title'         =>  esc_html__('Excerpt', 'top-news'),
                'options'     => array(
                    'true'  =>  esc_html__('Yes', 'top-news'),             
                    ''  =>  esc_html__('No', 'top-news'),                     
                ),
                'default'       => 'true',
                'dependency'   => array( 'category_template_post_style_'.$categoriesterm->term_id, 'any', 'style-1,style-2' ),
            );
            $categories[] = array(
                'id'            => 'category_excerpt_limit_'.$categoriesterm->term_id,
                'type'          => 'number',
                'title'         =>  esc_html__('Excerpt Word Limit', 'top-news'),
                'default'       => '15',
                'dependency'   => array( 'category_template_post_style_'.$categoriesterm->term_id, 'any', 'style-1,style-2' ),
            );
            $categories[] = array(
                'id'            => 'category_readmore_'.$categoriesterm->term_id,
                'type'          => 'select',
                'title'         =>  esc_html__('Readmore', 'top-news'),
                'options'     => array(
                    'true'  =>  esc_html__('Yes', 'top-news'),             
                    ''  =>  esc_html__('No', 'top-news'),                     
                ),
                'default'       => '',
                'dependency'   => array( 'category_template_post_style_'.$categoriesterm->term_id, 'any', 'style-1,style-2' ),
            );
            $categories[] = array(
                'id'             => 'category_column_'.$categoriesterm->term_id,
                'type'           => 'select',
                'title'          =>  esc_html__('Post Column', 'top-news'),
                'options'        => array(
                    '1-col'      =>  esc_html__('1 column', 'top-news'),
                    '2-col'      =>  esc_html__('2 column', 'top-news'),
                    '3-col'      =>  esc_html__('3 columon', 'top-news'),
                ),
                'default_option' => 'Select column style',
                'dependency'   => array( 'category_template_post_style_'.$categoriesterm->term_id, 'any', 'style-1,style-3' ),
            );
            $categories[] = array(
                'id'            => 'category_slider_'.$categoriesterm->term_id,
                'type'          => 'switcher',
                'title'         =>  $categoriesterm->name.' Category Slider',
                'default'       => false
            );
            $categories[] = array(
                'id'             => 'default_category_slider_'.$categoriesterm->term_id,
                'type'           => 'select',
                'title'          =>  $categoriesterm->name .' Slider Style:',
                'options'        => array(
                    'content-slider'         =>  esc_html__('Content area slider','top-news'),
                    'full-width-slider'  =>  esc_html__('Full width slider','top-news'),                                                
                ),
                'dependency'     => array( 'category_slider_'.$categoriesterm->term_id, '==', 'true' ),
            );
            $categories[] = array(
                'id'      => 'category_slider_post_limit_'.$categoriesterm->term_id,
                'type'    => 'number',
                'title'   =>  $categoriesterm->name .' Slider Posts Limit:',
                'default'   => '5',
                'dependency'     => array( 'category_slider_'.$categoriesterm->term_id, '==', 'true' ),
            );
            $categories[] = array(
                'id'             => 'category_slider_tag_'.$categoriesterm->term_id,
                'type'           => 'select',
                'title'          =>  $categoriesterm->name .' Tag:',
                'options'        => 'tag',
                'query_args'     => array(
                    'orderby'      => 'name',
                    'order'        => 'ASC',
                ),
                'attributes' => array(
                    'multiple' => 'multiple',
                    'style'    => 'width: 200px; height: 100px;'
                ),
                'default_option' =>  esc_html__('Select slider tag', 'top-news'),
                'dependency'     => array( 'category_slider_'.$categoriesterm->term_id, '==', 'true' ),
            );
        }
        return $categories;
    }
}

if ( ! function_exists( 'top_news_get_registered_sidebars' ) ) {
  function top_news_get_registered_sidebars() {

    global $wp_registered_sidebars;
    $sidebars = array();

    if( ! empty( $wp_registered_sidebars ) ) {
      foreach ( $wp_registered_sidebars as $sidebar_key => $sidebar_value ) {
        $sidebars[$sidebar_key] = $sidebar_value['name'];
      }
    }

    return array_reverse( $sidebars );

  }
}

if ( ! function_exists( 'top_news_boxed_background_image' ) ) {
    function top_news_boxed_background_image($top_news_group_items) {
        if(! empty($top_news_group_items)) {
            $color      = ! empty($top_news_group_items['color']) ? 'background-color: '. $top_news_group_items['color'] .';' : '';
            $image      = ! empty($top_news_group_items['image']) ? 'background-image: url('. $top_news_group_items['image'] .');' : '';
            $cover      = ! empty($top_news_group_items['size']) ? 'background-size: '. $top_news_group_items['size'] .';' : '';
            $repeat     = ! empty($top_news_group_items['repeat']) ? 'background-repeat: '. $top_news_group_items['repeat'] .';' : '';
            $position   = ! empty($top_news_group_items['position']) ? 'background-position: '. $top_news_group_items['position'] .';' : '';
            $attachment = ! empty($top_news_group_items['attachment']) ? 'background-attachment: '. $top_news_group_items['attachment'] .';' : '';                
            echo 'style="'. $color . $image . $cover . $repeat . $position . $attachment .'"';
        }
    }
}