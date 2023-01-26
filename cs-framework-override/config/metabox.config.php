<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();

// --------- Page Layout  -----------------
$options[]    = array(
    'id'        => '_custom_page_side_options',
    'title'     => 'Select Page Layout',
    'post_type' => 'page',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

        array(
            'name'   => 'section_3',
            'fields' => array(
                array(
                    'id'        => 'section_3_image_select',
                    'type'      => 'image_select',
                    'options'   => array(
                        'v1' => get_template_directory_uri().'/images/admin/t-style-01.jpg',
                        'v2' => get_template_directory_uri().'/images/admin/t-style-02.jpg',
                        'v3' => get_template_directory_uri().'/images/admin/t-style-03.jpg',
                        'v4' => get_template_directory_uri().'/images/admin/t-style-04.jpg',
                        'v5' => get_template_directory_uri().'/images/admin/t-style-05.jpg',                        
                        'v6' => get_template_directory_uri().'/images/admin/t-style-06.jpg',
                    ),
                    'default'   => 'v2',
                ),
                array(
                    'id'             => 'sidebar_option_1',
                    'type'           => 'select',
                    'title'          => 'Sidebar 1',
                    'options'        => top_news_get_registered_sidebars(),
                    'default_option' => 'Select a sidebar',
                ),
                array(
                  'id'             => 'sidebar_option_2',
                  'type'           => 'select',
                  'title'          => 'Sidebar 2',
                  'options'        => top_news_get_registered_sidebars(),
                  'default_option' => 'Select a sidebar',
                )  
            ),
        ),

    ),
);
// -----------------------------------------
// Post Metabox Options                    -
// -----------------------------------------
$options[]      = array(
    'id'            => '_post_template_options',
    'title'         => 'Post Settings',
    'post_type'     => 'post', // or post or CPT or array( 'page', 'post' )
    'context'       => 'normal',
    'priority'      => 'default',
    'sections'      => array(
        array(
            'name'   => 'template_list',
            'fields' => array(
            array(
                'id'             => 'single_post_style',
                'type'           => 'select',
                'title'          =>  esc_html__('Post Style:', 'top-news'),
                'options'     => array(
                    ''  =>  esc_html__('Option Panel Style','top-news'),             
                    'default-style'  =>  esc_html__('Default','top-news'),             
                    'style-1'  =>  esc_html__('Style 1','top-news'),             
                    'style-2'  =>  esc_html__('Style 2','top-news'),             
                    'style-3'  =>  esc_html__('Style 3','top-news'),
                    'style-4'  =>  esc_html__('Style 4','top-news'),
                ),
                'default'       => '',
            ), 
            ),
        ),        
    ),
);

// -----------------------------------------
// Post Metabox Options                    -
// -----------------------------------------
$options[]    = array(
    'id'        => '_format_video',
    'title'     => 'Featured Video',
    'post_type' => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

        array(
            'name'   => 'video_settings',
            'fields' => array(                
                array(
                    'id'            => 'embedded_link', // another unique id
                    'type'          => 'text',
                    'title'         =>  esc_html__('Video Link','top-news'),
                    'desc'          =>  esc_html__('You can add Youtube, Vimeo or Dailymotion video link here.','top-news'),
                ),

            ),
        ),

    ),
);

CSFramework_Metabox::instance( $options );
