<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array(
  'menu_title' =>  esc_html__('TopNews Panel', 'top-news'),
  'menu_type'       => 'menu', // menu, submenu, options, theme, etc.
  'menu_slug'  => 'topnews-settings',
  'ajax_save'       => false,
  'show_reset_all'  => false,
  'framework_title' => 'Top News <small>by Codexcoder</small>',
);
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

$options[]      = array(
    'name'        => 'tn_general_seetings',
    'title'       =>  esc_html__('General Settings', 'top-news'),
    'icon'          => 'fa fa-cogs',
    'fields'      => array(        
        array(
            'type'    => 'heading',
            'content'   =>  esc_html__('Layout', 'top-news'),
        ),
        array(
          'id'         => 'tn_boxed_layout',
          'type'       => 'switcher',
          'title'      =>  esc_html__('Boxed Layout', 'top-news'),
          'default'    => false
        ),
        array(
            'id'    => 'background_image',
            'type'  => 'background',
            'title' =>  esc_html__('Background Field','top-news'),
            'default' => array(
                'repeat'     => 'no-repeat',
                'position'   => 'center center',
                'attachment' => 'fixed',
                'size' => 'cover',
                'color'      => '#fff',
            ),
        ),
        array(
            'id'           => 'tn_section_header_style',
            'type'         => 'select',
            'title'        =>  esc_html__('Section Title Style','top-news'),
            'options'   => array(
                'style1' => 'Style 1 (Ash Background)',                       
                'style2' => 'Style 2 (Black Border)',                         
                'style3' => 'Style 3 (TopNews Style)',                         
                'style4' => 'Style 4 (Black Background)',                         
                'style5' => 'Style 5 (Ash Border Bottom)',                         
                'style6' => 'Style 6 (Theme Color Background)',                         
            ),
            'default'   => 'style3',
        ),
        array(
          'id'              => 'custom_sidebars',
          'type'            => 'group',
          'title'           =>  esc_html__('Custom Sidebars','top-news'),
          'button_title'    =>  esc_html__('Add Sidebar','top-news'),
          'accordion_title' =>  esc_html__('Add Sidebar','top-news'),
          'fields'          => array(
            array(
              'id'          => 'sidebar_name',
              'type'        => 'text',
              'title'       =>  esc_html__('Sidebar Name','top-news'),
            ),

          )
        ),        
        array(
            'id'           => 'page_sidebar',
            'type'         => 'image_select',
            'title'        =>  esc_html__('Template Style','top-news'),
            'options'   => array(
                't-style1' => get_template_directory_uri().'/images/admin/t-style-01.jpg',
                't-style2' => get_template_directory_uri().'/images/admin/t-style-02.jpg',
                't-style3' => get_template_directory_uri().'/images/admin/t-style-03.jpg',
                't-style4' => get_template_directory_uri().'/images/admin/t-style-04.jpg',            
            ),
            'default'   => 't-style2',
        ),
        array(
            'id'             => 'page_sidebar_option_1',
            'type'           => 'select',
            'title'          =>  esc_html__('Sidebar 1','top-news'),
            'options'        => top_news_get_registered_sidebars(),
            'default_option' =>  esc_html__('Select a sidebar','top-news'),
        ),
        array(
            'id'             => 'page_sidebar_option_2',
            'type'           => 'select',
            'title'          =>  esc_html__('Sidebar 2','top-news'),
            'options'        => top_news_get_registered_sidebars(),
            'default_option' =>  esc_html__('Select a sidebar','top-news'),
        ),
        array(
            'id'    => 'tn_is_sharecount',
            'type'  => 'switcher',
            'title' => 'Display sharecount on featured post / blog',            
            'default' => false
        ),
        array(
            'id'      => 'tn_custom_css',
            'type'    => 'textarea',
            'title'   =>  esc_html__('Add Custom CSS','top-news'),            
            'sanitize' => false,
        ),
        array(
            'id'      => 'copyright_text',
            'type'    => 'textarea',
            'title'   =>  esc_html__('Copyright text','top-news'),
            'desc'    =>  esc_html__('Write your copyright text for footer. It is a html tag supported area.','top-news'),
            'sanitize' => false,
        ),
    ),
);
// ----------------------------------------
// a option section for Typography        -
// ----------------------------------------
$options[]      = array(
    'name'        => 'tn_typography',
    'title'       =>  esc_html__('Typography', 'top-news'),
    'icon'          => 'fa fa-check',
    'fields'      => array(        
        array(
            'type'    => 'heading',
            'content'   =>  esc_html__('Body', 'top-news'),
        ),        
        array(
            'id'        => 'tn_font_family',
            'type'      => 'typography',
            'title'     =>  esc_html__('Body font family:', 'top-news'),
            'default'   => array(
                'family'  => 'Roboto',
                'font'    => 'google', // this is helper for output ( google, websafe, custom )                
            ),
            'variant'   => false,
        ),
        array(
            'id'      => 'tn_font_size',
            'type'    => 'number',
            'title'   =>  esc_html__('Body font size:', 'top-news'),
            'default'   => '14',
            'after'   => ' <i class="cs-text-muted">(px)</i>',                
        ),
        array(
            'id'      => 'tn_theme_color',
            'type'    => 'color_picker',
            'title'   =>  esc_html__('Theme Primary Color', 'top-news'),
            'default' => '#e44332',
        ),
        array(
            'id'      => 'tn_theme_hover_color',
            'type'    => 'color_picker',
            'title'   =>  esc_html__('Theme Secondary Color', 'top-news'),
            'default' => '#b22617',
        ),
        array(
            'id'      => 'tn_theme_sidebar_bg_color',
            'type'    => 'color_picker',
            'title'   =>  esc_html__('Theme Sidebar Bakground Color', 'top-news'),
            'default' => '#F2F2F2',
        ),
        array(
            'id'      => 'tn_theme_footer_top_bg_color',
            'type'    => 'color_picker',
            'title'   =>  esc_html__('Theme Top Footer Bakground Color', 'top-news'),
            'default' => '#262626',
        ),
        array(
            'id'      => 'tn_theme_copy_footer_bg_color',
            'type'    => 'color_picker',
            'title'   =>  esc_html__('Theme Copyright Footer Bakground Color', 'top-news'),
            'default' => '#1A1A1A',
        ),
        array(
            'type'    => 'heading',
            'content'   =>  esc_html__('Title', 'top-news'),
        ),
        array(
            'id'        => 'tn_title_font_family',
            'type'      => 'typography',
            'title'     =>  esc_html__('Title font family:', 'top-news'),
            'default'   => array(
                'family'  => 'Roboto',
                'font'    => 'google', // this is helper for output ( google, websafe, custom )
            ),
            'variant'   => false,
        ),
        array(
            'id'             => 'tn_title_font_weight',
            'type'           => 'select',
            'title'          =>  esc_html__('Title font-weight:', 'top-news'),
            'options'     => array(
                '500'  =>  esc_html__('500', 'top-news'),
                '100'  =>  esc_html__('100', 'top-news'),                
                '300'  =>  esc_html__('300', 'top-news'),                              
                '400'  =>  esc_html__('400', 'top-news'),                
                '600'  =>  esc_html__('600', 'top-news'),
                '700'  =>  esc_html__('700', 'top-news'),                
                '800'  =>  esc_html__('800', 'top-news'),                
                '900'  =>  esc_html__('900', 'top-news'),                
            ),
            'default'    => '500'
        ),
        array(
            'id'          => 'tn_title_font_style',
            'type'        => 'select',
            'title'       =>  esc_html__('Title font-style:', 'top-news'),
            'options'     => array(
                'normal'  =>  esc_html__('Normal', 'top-news'),
                'italic'  =>  esc_html__('Italic', 'top-news'),
                'oblique' =>  esc_html__('Oblique', 'top-news'),                               
            ),
            'default'    => 'normal'
        ),
        array(
            'id'             => 'tn_title_transform',
            'type'           => 'select',
            'title'          =>  esc_html__('Title text-transform:', 'top-news'),
            'options'     => array(
                'none'       => 'None',
                'capitalize' =>  esc_html__('Capitalize', 'top-news'),
                'uppercase'  =>  esc_html__('Uppercase', 'top-news'),
                'lowercase'  =>  esc_html__('Lowercase', 'top-news'),
            ),
            'default'    => 'none'
        ),
        array(
            'type'    => 'heading',
            'content'   =>  esc_html__('Menu', 'top-news'),
        ),
        array(
            'id'        => 'tn_menu_font_family',
            'type'      => 'typography',
            'title'     =>  esc_html__('Menu font family:', 'top-news'),
            'default'   => array(
                'family'  => 'Roboto',
                'font'    => 'google', // this is helper for output ( google, websafe, custom )
            ),
            'variant'   => false,
        ),
        array(
            'id'             => 'tn_menu_font_weight',
            'type'           => 'select',
            'title'          =>  esc_html__('Menu font-weight:', 'top-news'),
            'options'     => array(                
                '700'  =>  esc_html__('700', 'top-news'),
                '100'  =>  esc_html__('100', 'top-news'),                
                '300'  =>  esc_html__('300', 'top-news'),                              
                '400'  =>  esc_html__('400', 'top-news'),
                '500'  =>  esc_html__('500', 'top-news'),
                '600'  =>  esc_html__('600', 'top-news'),                                
                '800'  =>  esc_html__('800', 'top-news'),                
                '900'  =>  esc_html__('900', 'top-news'),                
            ),
            'default'    => '700'
        ),
        array(
            'id'          => 'tn_menu_font_style',
            'type'        => 'select',
            'title'       =>  esc_html__('Menu font-style:', 'top-news'),
            'options'     => array(
                'normal'  =>  esc_html__('Normal', 'top-news'),
                'italic'  =>  esc_html__('Italic', 'top-news'),
                'oblique' =>  esc_html__('Oblique', 'top-news'),                               
            ),
            'default'    => 'normal'
        ),
        array(
            'id'             => 'tn_menu_transform',
            'type'           => 'select',
            'title'          =>  esc_html__('Menu text-transform:', 'top-news'),
            'options'     => array(
                'uppercase'  =>  esc_html__('Uppercase', 'top-news'),
                'none'       =>  esc_html__('None', 'top-news'),
                'capitalize' =>  esc_html__('Capitalize', 'top-news'),                
                'lowercase'  =>  esc_html__('Lowercase', 'top-news'),
            ),
            'default'    => 'normal'
        ),
    ),        
);
// ----------------------------------------
// a option section for header            -
// ----------------------------------------
$options[]      = array(
    'name'        => 'header',
    'title'       =>  esc_html__('Header', 'top-news'),
    'icon'        => 'fa fa-bars',
    'sections' => array(
        array(
            'name'      => 'text_options',
            'title'     => 'General Settings',
            'icon'      => 'fa fa-check',
            // begin: fields
            'fields'      => array(
                array(
                    'type'    => 'heading',
                    'content'   =>  esc_html__('Header Style', 'top-news'),
                ),
                array(
                    'id'         => 'header_style',
                    'type'       => 'radio',
                    'title'      =>  esc_html__('Header Style', 'top-news'),
                    'class'      => 'horizontal',
                    'options'    => array(
                        '1'    =>  esc_html__('Header 1 (Default)', 'top-news'),
                        '2'    =>  esc_html__('Header 2 (Fashion)', 'top-news'),
                        '3'    =>  esc_html__('Header 3 (Sports)', 'top-news'),                        
                        '4'    =>  esc_html__('Header 4 (Black Menu)', 'top-news'),                        
                        '5'    =>  esc_html__('Header 5 (Black Menu 2)', 'top-news'),                        
                        '6'    =>  esc_html__('Header 6 (Theme Color Menu)', 'top-news'),
                        '7'    =>  esc_html__('Header 7 (Viral & Buzz)', 'top-news'),                        
                        '8'    =>  esc_html__('Header 8 (Dark Header with custom color menu)', 'top-news'),                        
                        '9'    =>  esc_html__('Header 9 (Light Header with costom color menu)', 'top-news'),                        
                    ),
                    'default'    => '1',
                    'attributes' => array(
                        'data-depend-id' => 'header_style',
                      ),
                ),
                array(
                    'id'      => 'header8_header_bg_color',
                    'type'    => 'color_picker',
                    'title'   =>  esc_html__('Header 8 Background Color', 'top-news'),
                    'default' => '#252525',
                    'dependency'   => array( 'header_style', 'any', '8' ),
                ), 
                array(
                    'id'      => 'header9_header_bg_color',
                    'type'    => 'color_picker',
                    'title'   =>  esc_html__('Header 9 Background Color', 'top-news'),
                    'default' => '#fff',
                    'dependency'   => array( 'header_style', 'any', '9' ),
                ), 
                array(
                    'id'      => 'header8_menu_bg_color',
                    'type'    => 'color_picker',
                    'title'   =>  esc_html__('Menu Background Color', 'top-news'),
                    'default' => '#c32031',
                    'dependency'   => array( 'header_style', 'any', '8,9' ),
                ), 
                array(
                    'id'         => 'tn_viral_menu',
                    'type'       => 'radio',
                    'title'      =>  esc_html__('Menu Style', 'top-news'),
                    'class'      => 'horizontal',
                    'options'    => array(
                        '1'    =>  esc_html__('Default', 'top-news'),                       
                        '2'    =>  esc_html__('Black Menu', 'top-news'),                        
                        '3'    =>  esc_html__('Black Menu 2', 'top-news'),                        
                        '4'    =>  esc_html__('Theme Color Menu', 'top-news'),                     
                    ),
                    'default'    => '1',
                    'dependency'   => array( 'header_style', 'any', '7' ),
                ),
                array(
                    'id'              => 'header7_quick_menu',
                    'type'            => 'group',
                    'title'           => esc_html__('Quick Menu', 'top-news'), 
                    'button_title'    => esc_html__('Add New', 'top-news'), 
                    'accordion_title' => esc_html__('Add New Menu', 'top-news'),
                    'dependency'   => array( 'header_style', 'any', '7,8,9' ),
                    'fields'          => array(

                        array(
                            'id'          => 'menu_name',
                            'type'        => 'text',
                            'title'       => esc_html__('Write Name', 'top-news'), 
                        ),
                        array(
                            'id'          => 'menu_url',
                            'type'        => 'text',
                            'title'       => esc_html__('Menu URL', 'top-news'),
                            'default'     => '#',
                        ),

                        array(
                            'id'          => 'menu_icon',
                            'type'        => 'icon',
                            'title'       => esc_html__('Upload Icon', 'top-news'), 
                        ),

                    ),                    
                ),
                array(
                    'id'              => 'header7_reaction_menu',
                    'type'            => 'group',
                    'title'           => esc_html__('Reaction Menu', 'top-news'),                    
                    'button_title'    => esc_html__('Add New', 'top-news'), 
                    'accordion_title' => esc_html__('Add New Menu', 'top-news'), 
                    'fields'          => array(
                        array(
                            'id'          => 'menu_name',
                            'type'        => 'text',
                            'title'       => esc_html__('Write Name', 'top-news'), 
                        ),
                        array(
                            'id'          => 'menu_url',
                            'type'        => 'text',
                            'title'       => esc_html__('Menu URL', 'top-news'),
                            'default'     => '#',
                        ),
                        array(
                            'id'          => 'menu_icon',
                            'type'        => 'upload',
                            'title'       => esc_html__('Upload Icon', 'top-news'), 
                        ),

                    ),
                    'dependency'   => array( 'header_style', 'any', '7' ),
                ),                 

                array(
                    'id'    => 'tn_is_breadcrumbs',
                    'type'  => 'switcher',
                    'title' => 'Breadcrumb and Page Title',
                    'label' => 'if you want to disable Breadcrumbs for this site switch "off" to this button',
                    'default' => true,
                    'dependency'   => array( 'header_style', 'any', '1,4,5,6,7,8,9' ),
                ),
                array(
                    'id'             => 'tn_breadcrumbs_style',
                    'type'           => 'select',
                    'title'          =>  esc_html__('Breadcrumbs and Page Title style:', 'top-news'),
                    'options'     => array(
                        'style1'  =>  esc_html__('Style 1', 'top-news'),
                        'style2'  =>  esc_html__('Style 2', 'top-news'),                        
                    ),
                    'default'    => 'style1',
                    'dependency'   => array( 'header_style', 'any', '1,4,5,6,7,8,9' ),
                ),
                array(
                    'id'        => 'header_bg',
                    'type'      => 'image',
                    'title'     =>  esc_html__('Header Background Image','top-news'),
                    'add_title' => 'Add Image',
                    'dependency'   => array( 'header_style', 'any', '2,3' ),
                ),
                array(
                    'id'        => 'header_ads_image',
                    'type'      => 'upload',
                    'title'     =>  esc_html__('Header ads image','top-news'),
                    'add_title' => 'Add Image',
                    'dependency'   => array( 'header_style', 'any', '1,4,5,6' ),
                ),
                array(
                    'id'        => 'header_ads_image_url',
                    'type'      => 'text',
                    'title'     =>  esc_html__('Header ads image url','top-news'),
                    'dependency'   => array( 'header_style', 'any', '1,4,5,6' ),
                ),

                array(
                    'id'      => 'header_add_code',
                    'type'    => 'textarea',
                    'title'   =>  esc_html__('Header ads code','top-news'),
                    'desc'    => esc_html__('The following code will add to the right side of logo. Useful if you need html/js ad code on header 1. If there have any value in this field image from above field will not show.','top-news'),
                    'sanitize' => false,
                    'dependency'   => array( 'header_style', 'any', '1,4,5,6' ),
                ),                
                array(
                    'type'    => 'subheading',
                    'content'   =>  esc_html__('Header (2,3) Slider Settings', 'top-news'),
                    'dependency'   => array( 'header_style', 'any', '2,3' ),
                ),
                array(
                    'id'    => 'is_header_slider',
                    'type'  => 'switcher',
                    'title' => 'Header Slider',
                    'default' => true,
                    'dependency'   => array( 'header_style', 'any', '2,3' ),
                ),
                array(
                    'id'      => 'slider_post_limit',
                    'type'    => 'number',
                    'title'   =>  esc_html__('Slider Post Limit:', 'top-news'),
                    'default'   => '5',
                    'dependency'   => array( 'is_header_slider', '==', 'true' ),
                ),
                array(
                    'id'           => 'slider_post_from',
                    'type'         => 'radio',
                    'class'        => 'horizontal',
                    'title'        =>  esc_html__('Display slider post from?', 'top-news'),
                    'options'      => array(
                        'category'     =>  esc_html__('Category', 'top-news'),
                        'tag'          =>  esc_html__('Tag', 'top-news'),
                        'all'          =>  esc_html__('All', 'top-news'),
                    ),
                    'default'   => 'all',
                    'dependency'   => array( 'is_header_slider', '==', 'true' ),
                ),
                array(
                    'id'             => 'slider_posts_cat',
                    'type'           => 'select',
                    'title'          =>  esc_html__('Category:', 'top-news'),
                    'options'        => 'categories',
                    'query_args'     => array(
                        'orderby'      => 'name',
                        'order'        => 'ASC',
                    ),
                    'attributes' => array(
                        'multiple' => 'multiple',
                        'style'    => 'width: 200px; height: 200px;'
                    ),
                    'default_option' =>  esc_html__('Select category', 'top-news'),
                    'dependency'      => array( 'is_header_slider|slider_post_from_category', '==|==', 'true|true' ),

                ),
                array(
                    'id'             => 'slider_posts_tag',
                    'type'           => 'select',
                    'title'          =>  esc_html__('Tag:', 'top-news'),
                    'options'        => 'tag',
                    'query_args'     => array(
                        'orderby'      => 'name',
                        'order'        => 'ASC',
                    ),
                    'attributes' => array(
                        'multiple' => 'multiple',
                        'style'    => 'width: 200px; height: 200px;'
                    ),
                    'default_option' =>  esc_html__('Select tag', 'top-news'),
                    'dependency'      => array( 'is_header_slider|slider_post_from_tag', '==|==', 'true|true' ),
                ),                                

                /**
                 * Middle Area
                 */
                array(
                    'type'    => 'subheading',
                    'content'   =>  esc_html__('Logo Settings', 'top-news'),
                ),
                array(
                    'id'        => 'site_logo',
                    'type'      => 'image',
                    'title'     =>  esc_html__('Site Logo', 'top-news'),
                    'add_title' => 'Add Logo',
                ),
                array(
                    'id'        => 'site_logo_mobile',
                    'type'      => 'image',
                    'title'     =>  esc_html__('Mobile Logo', 'top-news'),
                    'add_title' => 'Add Logo',
                ),                
            ), // end: fields            
        ),
        /**
         * Top Area
         */
        array(
            'name'      => 'top_area',
            'title'     => 'Top Area',
            'icon'      => 'fa fa-check',
            // begin: fields
            'fields'      => array(
                array(
                    'type'    => 'heading',
                    'content'   =>  esc_html__('Top Featured Post', 'top-news'),
                ),
                array(
                  'id'         => 'tn_top_featured_post',
                  'type'       => 'switcher',
                  'title'      =>  esc_html__('Featured post on top', 'top-news'),
                  'default'    => false,
                  'desc'    => esc_html__('Featured post on top is not applicable for Header 3(Sports)','top-news'),
                ),
                array(
                    'id'      => 'tn_top_featured_post_limit',
                    'type'    => 'number',
                    'title'   =>  esc_html__('Posts Limit:', 'top-news'),
                    'default'   => '6'
                ),
                array(
                    'id'           => 'tn_top_featured_post_from',
                    'type'         => 'radio',
                    'class'        => 'horizontal',
                    'title'        =>  esc_html__('Display Post from?', 'top-news'),
                    'options'      => array(
                        'category'     =>  esc_html__('Category', 'top-news'),
                        'tag'          =>  esc_html__('Tag', 'top-news'),
                        'all'          =>  esc_html__('All', 'top-news'),
                    ),
                    'default'   => 'all',
                ),
                array(
                    'id'             => 'tn_top_featured_post_cat',
                    'type'           => 'select',
                    'title'          =>  esc_html__('Category:', 'top-news'),
                    'options'        => 'categories',
                    'query_args'     => array(
                        'orderby'      => 'name',
                        'order'        => 'ASC',
                    ),
                    'attributes' => array(
                        'multiple' => 'multiple',
                        'style'    => 'width: 200px; height: 200px;'
                    ),
                    'default_option' =>  esc_html__('Select a category', 'top-news'),
                    'dependency'      => array( 'tn_top_featured_post_from_category', '==', 'true' ),

                ),
                array(
                    'id'             => 'top_featured_post_tag',
                    'type'           => 'select',
                    'title'          =>  esc_html__('Tag:', 'top-news'),
                    'options'        => 'tag',
                    'query_args'     => array(
                        'orderby'      => 'name',
                        'order'        => 'ASC',
                    ),
                    'attributes' => array(
                        'multiple' => 'multiple',
                        'style'    => 'width: 200px; height: 200px;'
                    ),
                    'default_option' =>  esc_html__('Select a tag', 'top-news'),
                    'dependency'      => array( 'tn_top_featured_post_from_tag', '==', 'true' ),
                ),
                array(
                    'type'    => 'subheading',
                    'content'   =>  esc_html__('Top Bar', 'top-news'),
                ),
                array(
                  'id'         => 'header_top_bar',
                  'type'       => 'switcher',
                  'title'      =>  esc_html__('Top Bar', 'top-news'),
                  'default'    => true
                ),
                array(
                    'id'         => 'tn_topbar_style',
                    'type'       => 'radio',
                    'title'      =>  esc_html__('Top Bar Style', 'top-news'),
                    'class'      => 'horizontal',
                    'options'    => array(
                        '1'    =>  esc_html__('Style 1 (Date and Location)', 'top-news'),
                        '2'    =>  esc_html__('Style 2 (Recent, Popular, Hot and Trending post nav)', 'top-news'),
                        '3'    =>  esc_html__('Style 3 (Top Bar Menu)', 'top-news'),                      
                    ),
                    'default'    => '1'
                ),
                array(
                    'id'      => 'tn_top_bar_bg_color',
                    'type'    => 'color_picker',
                    'title'   =>  esc_html__('Top Bar 3 Background Color', 'top-news'),
                    'default' => '#e44332',
                    'dependency'      => array( 'tn_topbar_style_3', '==', 'true' ),
                ),
                array(
                    'id'      => 'tn_top_bar_font_color',
                    'type'    => 'color_picker',
                    'title'   =>  esc_html__('Top Bar 3 Font Color', 'top-news'),
                    'default' => '#fff',
                    'dependency'      => array( 'tn_topbar_style_3', '==', 'true' ),
                ),                
                array(
                    'id'      => 'tn_date_time',
                    'type'    => 'switcher',
                    'title'   =>  esc_html__('Date', 'top-news'),
                    'default' => false,
                    'dependency'      => array( 'tn_topbar_style_3', '==', 'true' ),
                ),
                array(
                    'type'    => 'subheading',
                    'content'   =>  esc_html__('Quick Nav Settings for Top Bar Style 2', 'top-news'),
                    'dependency'      => array( 'tn_topbar_style_2', '==', 'true' ),
                ),
                array(
                    'id'              => 'tn_latest_link',
                    'type'            => 'text',
                    'title'           =>  esc_html__('Latest Post Link', 'top-news'),
                    'dependency'      => array( 'tn_topbar_style_2', '==', 'true' ),
                ),
                array(
                    'id'              => 'tn_popular_link',
                    'type'            => 'text',
                    'title'           =>  esc_html__('Popular Post Link', 'top-news'),
                    'dependency'      => array( 'tn_topbar_style_2', '==', 'true' ),
                ),
                array(
                    'id'              => 'tn_hot_link',
                    'type'            => 'text',
                    'title'           =>  esc_html__('Hot Post Link', 'top-news'),
                    'dependency'      => array( 'tn_topbar_style_2', '==', 'true' ),
                ),
                array(
                    'id'              => 'tn_trending_link',
                    'type'            => 'text',
                    'title'           =>  esc_html__('Trending Post Link', 'top-news'),
                    'dependency'      => array( 'tn_topbar_style_2', '==', 'true' ),
                ),
                array(
                    'type'    => 'subheading',
                    'content'   =>  esc_html__('Login Registration', 'top-news'),
                ),
                array(
                    'id'              => 'login_text',
                    'type'            => 'text',
                    'title'           =>  esc_html__('Login Text', 'top-news'),                    
                ),
                array(
                    'id'              => 'login_link',
                    'type'            => 'text',
                    'title'           =>  esc_html__('Login Link', 'top-news'),
                    'dependency'      => array( 'header_top_bar', '==', 'true' ),
                ),
                array(
                    'id'              => 'registration_text',
                    'type'            => 'text',
                    'title'           =>  esc_html__('Register Text', 'top-news'),                    
                ),
                array(
                    'id'              => 'registration_link',
                    'type'            => 'text',
                    'title'           =>  esc_html__('Register Link', 'top-news'),                    
                ),
                array(
                    'id'              => 'header_social_icons',
                    'type'            => 'group',
                    'title'           => 'Social Profiles',
                    'button_title'    => 'Add New',
                    'accordion_title' => 'Add New Profile',
                    'fields'          => array(

                        array(
                            'id'          => 'name',
                            'type'        => 'text',
                            'title'       => 'Name',
                        ),

                        array(
                            'id'          => 'link',
                            'type'        => 'text',
                            'title'       => 'Switcher Field',
                        ),

                        array(
                            'id'          => 'icon',
                            'type'        => 'icon',
                            'title'       => 'Icon',
                        ),

                    ),
                    'default'   => array(
                        array(
                            'name'      => 'Facebook',
                            'link'      => '#facebook',
                            'icon'      => 'fa fa-facebook',
                        ),
                        array(
                            'name'      => 'GitHub',
                            'link'      => '#github',
                            'icon'      => 'fa fa-github',
                        ),
                        array(
                            'name'      => 'Twitter',
                            'link'      => '#twiter',
                            'icon'      => 'fa fa-twitter',
                        ),
                    )
                ),
            ),
        ),
        array(
            'name'      => 'news_tickers',
            'title'     => 'News Tickers',
            'icon'      => 'fa fa-check',
            // begin: fields
            'fields'      => array(
                /**
                 * News Ticker Settings
                 */
                array(
                    'type'    => 'subheading',
                    'content'   =>  esc_html__('News Ticker', 'top-news'),
                ),
                array(
                    'id'      => 'news_ticker_enabled',
                    'type'    => 'switcher',
                    'title'   =>  esc_html__('Display News Ticker', 'top-news'),
                    'default' => true
                ),
                array(
                    'id'      => 'news_ticker_enabled_innerpage',
                    'type'    => 'switcher',
                    'title'   =>  esc_html__('News Ticker For Inner Page', 'top-news'),
                    'default' => false,
                    'dependency' => array( 'news_ticker_enabled', '==', 'true' )
                ),
                array(
                    'id'      => 'news_ticker_limit',
                    'type'    => 'number',
                    'title'   =>  esc_html__('Limit Posts:', 'top-news'),
                    'default'   => '5'
                ),
                array(
                    'id'           => 'news_ticker_post_from',
                    'type'         => 'radio',
                    'class'        => 'horizontal',
                    'title'        =>  esc_html__('Display Post from?', 'top-news'),
                    'options'      => array(
                        'category'     =>  esc_html__('Category', 'top-news'),
                        'tag'          =>  esc_html__('Tag', 'top-news'),
                        'all'          =>  esc_html__('All', 'top-news'),
                    ),
                    'default'   => 'all',
                ),
                array(
                    'id'             => 'news_ticker_posts_cat',
                    'type'           => 'select',
                    'title'          =>  esc_html__('Category:', 'top-news'),
                    'options'        => 'categories',
                    'query_args'     => array(
                        'orderby'      => 'name',
                        'order'        => 'ASC',
                    ),
                    'default_option' =>  esc_html__('Select a category', 'top-news'),
                    'dependency'      => array( 'news_ticker_post_from_category', '==', 'true' ),

                ),
                array(
                    'id'             => 'news_ticker_posts_tag',
                    'type'           => 'select',
                    'title'          =>  esc_html__('Tag:', 'top-news'),
                    'options'        => 'tag',
                    'query_args'     => array(
                        'orderby'      => 'name',
                        'order'        => 'ASC',
                    ),
                    'default_option' =>  esc_html__('Select a tag', 'top-news'),
                    'dependency'      => array( 'news_ticker_post_from_tag', '==', 'true' ),
                ),
            ),
        ),
    ),

);

// ----------------------------------------
// a option section for home page            -
// ----------------------------------------
$options[]      = array(
    'name'        => 'home-page',
    'title'       =>  esc_html__('Front Page Settings', 'top-news'),
    'icon'        => 'fa fa-home',

    // begin: fields
    'fields'      => array(
        array(
            'type'    => 'heading',
            'content'   =>  esc_html__('Featured Post Grid Settings', 'top-news'),
        ),        
        array(
          'id'         => 'featured_post_grid',
          'type'       => 'switcher',
          'title'      =>  esc_html__('Featured Post', 'top-news'),
          'default'    => false
        ),
        array(
            'id'             => 'featured_post_layout',
            'type'           => 'select',
            'title'          =>  esc_html__('Select Featured Post Layout', 'top-news'),
            'options'        => array(
                '2-4-col'    =>  esc_html__('2/4 column', 'top-news'),
                '2-4-col-v2' =>  esc_html__('2/4 column (v2)', 'top-news'),
                '2-3-col'    =>  esc_html__('2/3 column', 'top-news'),                        
                '3-col'      =>  esc_html__('3 columon', 'top-news'),
                'slider-thumb'      =>  esc_html__('Slider With Thumbnail Image', 'top-news'),
                'slider-no-thumb'      =>  esc_html__('Slider Without Thumbnail Image', 'top-news'),
            ),
            'default'    => '3-col',
            'dependency' => array( 'featured_post_grid', '==', 'true' ) // dependency rule 
        ),        
        array(
            'id'      => 'featured_post_limit',
            'type'    => 'number',
            'title'   =>  esc_html__('Limit Featured Posts:', 'top-news'),
            'default'   => '6',
            'dependency' => array( 'featured_post_grid', '==', 'true' ) // dependency rule
        ),        
        array(
            'id'           => 'featured_post_from',
            'type'         => 'radio',
            'class'        => 'horizontal',
            'title'        =>  esc_html__('Display Post from?', 'top-news'),
            'options'      => array(
                'category'     =>  esc_html__('Category', 'top-news'),
                'tag'          =>  esc_html__('Tag', 'top-news'),
                'all'          =>  esc_html__('All', 'top-news'),
            ),
            'default'   => 'all',
            'dependency' => array( 'featured_post_grid', '==', 'true' ) // dependency rule
        ),
        array(
            'id'             => 'featured_posts_cat',
            'type'           => 'select',
            'title'          =>  esc_html__('Category:', 'top-news'),
            'options'        => 'categories',
            'query_args'     => array(
                'orderby'      => 'name',
                'order'        => 'ASC',
            ),
            'attributes' => array(
                'multiple' => 'multiple',
                'style'    => 'width: 200px; height: 200px;'
            ),
            'default_option' =>  esc_html__('Select category', 'top-news'),
            'dependency'      => array( 'featured_post_from_category', '==', 'true' ),

        ),
        array(
            'id'             => 'featured_posts_tag',
            'type'           => 'select',
            'title'          =>  esc_html__('Tag:', 'top-news'),
            'options'        => 'tag',
            'query_args'     => array(
                'orderby'      => 'name',
                'order'        => 'ASC',
            ),
            'attributes' => array(
                'multiple' => 'multiple',
                'style'    => 'width: 200px; height: 200px;'
            ),
            'default_option' =>  esc_html__('Select tag', 'top-news'),
            'dependency'      => array( 'featured_post_from_tag', '==', 'true' ),
        ),        
    ), // end: fields
);
// ------------------------------
// blog layout                      -
// ------------------------------
$options[]      = array(
    'name'        => 'blog_layout',
    'title'       =>  esc_html__('Blog Layout Settings', 'top-news'),
    'icon'        => 'fa fa-th-large',
    'fields'      =>  array(
        array(
            'type'      => 'heading',
            'content'   =>  esc_html__('Blog Layout Settings', 'top-news'),
        ),
        array(
            'id'        => 'blog_template_sidebar',
            'type'      => 'image_select',
            'title'     =>  esc_html__('Blog Template','top-news'),
            'options'   => array(
                '' => get_template_directory_uri().'/images/admin/default.jpg',
                't-style1' => get_template_directory_uri().'/images/admin/t-style-01.jpg',
                't-style2' => get_template_directory_uri().'/images/admin/t-style-02.jpg',
                't-style3' => get_template_directory_uri().'/images/admin/t-style-03.jpg',
                't-style4' => get_template_directory_uri().'/images/admin/t-style-04.jpg',            
            ),
            'default'   => '',
        ),
        array(
            'id'             => 'blog_template_sidebar_option_1',
            'type'           => 'select',
            'title'          =>  esc_html__('Blog Template Sidebar 1','top-news'),
            'options'        => top_news_get_registered_sidebars(),
            'default_option' => 'Select a sidebar',
        ),
        array(
            'id'             => 'blog_template_sidebar_option_2',
            'type'           => 'select',
            'title'          =>  esc_html__('Blog Template Sidebar 2','top-news'),
            'options'        => top_news_get_registered_sidebars(),
            'default_option' => 'Select a sidebar',
        ),
        array(
            'id'             => 'blog_template_post_style',
            'type'           => 'select',
            'title'          =>  esc_html__('Post Style:', 'top-news'),
            'options'     => array(            
                'style-1'  =>  esc_html__('Style 1 (Thumb on top)','top-news'),             
                'style-2'  =>  esc_html__('Style 2 (Thumb on left)','top-news'),            
                'style-3'  =>  esc_html__('Style 3 (Stylish)','top-news'),           
            ),
        ),
        array(
            'id'            => 'blog_excerpt',
            'type'          => 'select',
            'title'         =>  esc_html__('Excerpt', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes','top-news'),             
                ''  =>  esc_html__('No','top-news'),                     
            ),
            'default'       => 'true',
            'dependency'   => array( 'blog_template_post_style', 'any', 'style-1,style-2' ),
        ),
        array(
            'id'            => 'blog_excerpt_limit',
            'type'          => 'number',
            'title'         =>  esc_html__('Excerpt Word Limit', 'top-news'),
            'default'       => '15',
            'dependency'      => array( 'blog_excerpt', '==', 'true' ),
        ),
        array(
            'id'            => 'blog_readmore',
            'type'          => 'select',
            'title'         =>  esc_html__('Readmore', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes', 'top-news'),             
                ''  =>  esc_html__('No', 'top-news'),                     
            ),
            'default'       => '',
            'dependency'   => array( 'blog_template_post_style', 'any', 'style-1,style-2' ),
        ),
        array(
            'id'             => 'blog_column',
            'type'           => 'select',
            'title'          => 'Post Column',
            'options'        => array(
                '1-col'      =>  esc_html__('1 column', 'top-news'),
                '2-col'      =>  esc_html__('2 column', 'top-news'),
                '3-col'      =>  esc_html__('3 columon', 'top-news'),
            ),
            'dependency'   => array( 'blog_template_post_style', 'any', 'style-1,style-3' ),
        ),
        array(
            'id'             => 'tn_blog_pagination',
            'type'           => 'select',
            'title'          => 'Blog Pagination',
            'options'        => array(
                'numeric'      =>  esc_html__('Numeric Pagination', 'top-news'),
                'ajax-load'      =>  esc_html__('Ajax Load More', 'top-news'),
            ),
            'default'       => 'numeric',
        ),
        array(
            'type'    => 'heading',
            'content'   =>  esc_html__('Blog Slider Settings', 'top-news'),
        ),
        array(
            'id'            => 'blog_slider',
            'type'          => 'switcher',
            'title'         =>  esc_html__('Blog Slider', 'top-news'),
            'default'       => false
        ),
        array(
            'id'             => 'blog_slider_style',
            'type'           => 'select',
            'title'          =>  esc_html__('Slider Style:', 'top-news'),
            'options'        => array(
                'content-slider'         =>  esc_html__('Content area slider','top-news'),
                'full-width-slider'  =>  esc_html__('Full width slider','top-news'),                                                
            ),
            'dependency'     => array( 'blog_slider', '==', 'true' ),
        ),
        array(
            'id'      => 'blog_slider_post_limit',
            'type'    => 'number',
            'title'   =>  esc_html__('Slider Posts Limit:', 'top-news'),
            'default'   => '5',
            'dependency'     => array( 'blog_slider', '==', 'true' ),
        ),
        array(
            'id'             => 'blog_slider_tag',
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
            'dependency'     => array( 'blog_slider', '==', 'true' ),
        ),
        array(
            'type'    => 'heading',
            'content'   =>  esc_html__('Blog Featured Post Settings', 'top-news'),
        ),        
        array(
          'id'         => 'blog_featured_post_grid',
          'type'       => 'switcher',
          'title'      =>  esc_html__('Featured Post', 'top-news'),
          'default'    => false
        ),
        array(
            'id'             => 'blog_featured_post_layout',
            'type'           => 'select',
            'title'          =>  esc_html__('Select Featured Post Layout', 'top-news'),
            'options'        => array(
                '2-4-col'    =>  esc_html__('2/4 column', 'top-news'),
                '2-4-col-v2' =>  esc_html__('2/4 column (v2)', 'top-news'),
                '2-3-col'    =>  esc_html__('2/3 column', 'top-news'),                        
                '3-col'      =>  esc_html__('3 columon', 'top-news'),
                'slider-thumb'      =>  esc_html__('Slider With Thumbnail Image', 'top-news'),
                'slider-no-thumb'      =>  esc_html__('Slider Without Thumbnail Image', 'top-news'),
            ),
            'dependency' => array( 'blog_featured_post_grid', '==', 'true' ) // dependency rule 
        ),        
        array(
            'id'      => 'blog_featured_post_limit',
            'type'    => 'number',
            'title'   =>  esc_html__('Limit Featured Posts:', 'top-news'),
            'default'   => '6',
            'dependency' => array( 'blog_featured_post_grid', '==', 'true' ) // dependency rule
        ),        
        array(
            'id'           => 'blog_featured_post_from',
            'type'         => 'radio',
            'class'        => 'horizontal',
            'title'        =>  esc_html__('Display Post from?', 'top-news'),
            'options'      => array(
                'category'     =>  esc_html__('Category', 'top-news'),
                'tag'          =>  esc_html__('Tag', 'top-news'),
                'all'          =>  esc_html__('All', 'top-news'),
            ),
            'default'   => 'all',
            'dependency' => array( 'blog_featured_post_grid', '==', 'true' ) // dependency rule
        ),
        array(
            'id'             => 'blog_featured_posts_cat',
            'type'           => 'select',
            'title'          =>  esc_html__('Category:', 'top-news'),
            'options'        => 'categories',
            'query_args'     => array(
                'orderby'      => 'name',
                'order'        => 'ASC',
            ),
            'attributes' => array(
                'multiple' => 'multiple',
                'style'    => 'width: 200px; height: 200px;'
            ),
            'default_option' =>  esc_html__('Select category', 'top-news'),
            'dependency'      => array( 'blog_featured_post_from_category', '==', 'true' ),

        ),
        array(
            'id'             => 'blog_featured_posts_tag',
            'type'           => 'select',
            'title'          =>  esc_html__('Tag:', 'top-news'),
            'options'        => 'tag',
            'query_args'     => array(
                'orderby'      => 'name',
                'order'        => 'ASC',
            ),
            'attributes' => array(
                'multiple' => 'multiple',
                'style'    => 'width: 200px; height: 200px;'
            ),
            'default_option' =>  esc_html__('Select tag', 'top-news'),
            'dependency'      => array( 'blog_featured_post_from_tag', '==', 'true' ),
        ), 
    )
); 
// ------------------------------
// Category Template                      -
// ------------------------------
$options[]      = array(
    'name'        => 'per_category_template',
    'title'       =>  esc_html__('Category Layout Settings', 'top-news'),
    'icon'        => 'fa fa-bar-chart',
    'fields'      =>  array(
        array(
            'type'      => 'heading',
            'content'   =>  esc_html__('Category Layout Settings', 'top-news'),
        ),
        array(
            'id'        => 'category_template_sidebar',
            'type'      => 'image_select',
            'title'     =>  esc_html__('Category Template', 'top-news'),
            'options'   => array(
                '' => get_template_directory_uri().'/images/admin/default.jpg',
                't-style1' => get_template_directory_uri().'/images/admin/t-style-01.jpg',
                't-style2' => get_template_directory_uri().'/images/admin/t-style-02.jpg',
                't-style3' => get_template_directory_uri().'/images/admin/t-style-03.jpg',
                't-style4' => get_template_directory_uri().'/images/admin/t-style-04.jpg',            
            ),
            'default'   => '',
        ),
        array(
            'id'             => 'category_template_sidebar_option_1',
            'type'           => 'select',
            'title'          =>  esc_html__('Category Template Sidebar 1', 'top-news'),
            'options'        => top_news_get_registered_sidebars(),
            'default_option' =>  esc_html__('Select a sidebar', 'top-news'),
        ),
        array(
            'id'             => 'category_template_sidebar_option_2',
            'type'           => 'select',
            'title'          =>  esc_html__('Category Template Sidebar 2', 'top-news'),
            'options'        => top_news_get_registered_sidebars(),
            'default_option' =>  esc_html__('Select a sidebar', 'top-news'),
        ),  
        array(
            'id'             => 'category_template_post_style',
            'type'           => 'select',
            'title'          =>  esc_html__('Post Style:', 'top-news'),
            'options'     => array(            
                'style-1'  =>  esc_html__('Style 1 (Thumb on top)', 'top-news'),             
                'style-2'  =>  esc_html__('Style 2 (Thumb on left)', 'top-news'),            
                'style-3'  =>  esc_html__('Style 3 (Stylish)', 'top-news'),           
            ),
        ),
        array(
            'id'            => 'category_excerpt',
            'type'          => 'select',
            'title'         =>  esc_html__('Excerpt', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes','top-news'),             
                ''  =>  esc_html__('No','top-news'),                     
            ),
            'default'       => 'true',
            'dependency'   => array( 'category_template_post_style', 'any', 'style-1,style-2' ),
        ),
        array(
            'id'            => 'category_excerpt_limit',
            'type'          => 'text',
            'title'         =>  esc_html__('Excerpt Word Limit', 'top-news'),
            'default'       => '15',
            'dependency'   => array( 'category_template_post_style', 'any', 'style-1,style-2' ),
        ),
        array(
            'id'            => 'category_readmore',
            'type'          => 'select',
            'title'         =>  esc_html__('Readmore', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes','top-news'),             
                ''  =>  esc_html__('No','top-news'),                     
            ),
            'default'       => 'true',
            'dependency'   => array( 'category_template_post_style', 'any', 'style-1,style-2' ),
        ),
        array(
            'id'             => 'category_column',
            'type'           => 'select',
            'title'          =>  esc_html__('Post Column','top-news'),
            'options'        => array(
                '1-col'      =>  esc_html__('1 column','top-news'),
                '2-col'      =>  esc_html__('2 column','top-news'),
                '3-col'      =>  esc_html__('3 columon','top-news'),
            ),
            'dependency'   => array( 'category_template_post_style', 'any', 'style-1,style-3' ),
        ),
        array(
            'id'            => 'category_slider',
            'type'          => 'switcher',
            'title'         =>  esc_html__('Category Slider', 'top-news'),
            'default'       => false
        ),
        array(
            'id'             => 'default_category_slider',
            'type'           => 'select',
            'title'          =>  esc_html__('Deafult Slider Style:', 'top-news'),
            'options'        => array(
                'content-slider'         =>  esc_html__('Content area slider','top-news'),
                'full-width-slider'  =>  esc_html__('Full width slider','top-news'),                                                
            ),
            'dependency'     => array( 'category_slider', '==', 'true' ),
        ),
        array(
            'id'      => 'category_slider_post_limit',
            'type'    => 'number',
            'title'   =>  esc_html__('Slider Posts Limit:', 'top-news'),
            'default'   => '5',
            'dependency'     => array( 'category_slider', '==', 'true' ),
        ),
        array(
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
        )
    )
);
// ------------------------------
// Archive layout               -
// ------------------------------
$options[]      = array(
    'name'        => 'archive_layout',
    'title'       =>  esc_html__('Archive Layout Settings', 'top-news'),
    'icon'        => 'fa fa-database',
    'fields'      =>  array(
        array(
            'type'      => 'heading',
            'content'   =>  esc_html__('Archive Layout Settings', 'top-news'),
        ),
        array(
            'id'        => 'archive_template_sidebar',
            'type'      => 'image_select',
            'title'     => 'Archive Template',
            'options'   => array(
                '' => get_template_directory_uri().'/images/admin/default.jpg',
                't-style1' => get_template_directory_uri().'/images/admin/t-style-01.jpg',
                't-style2' => get_template_directory_uri().'/images/admin/t-style-02.jpg',
                't-style3' => get_template_directory_uri().'/images/admin/t-style-03.jpg',
                't-style4' => get_template_directory_uri().'/images/admin/t-style-04.jpg',            
            ),
            'default'   => '',
        ),
        array(
            'id'             => 'archive_template_sidebar_option_1',
            'type'           => 'select',
            'title'          => 'Archive Template Sidebar 1',
            'options'        => top_news_get_registered_sidebars(),
            'default_option' => 'Select a sidebar',
        ),
        array(
            'id'             => 'archive_template_sidebar_option_2',
            'type'           => 'select',
            'title'          => 'Archive Template Sidebar 2',
            'options'        => top_news_get_registered_sidebars(),
            'default_option' => 'Select a sidebar',
        ),
        array(
            'id'             => 'archive_template_post_style',
            'type'           => 'select',
            'title'          =>  esc_html__('Post Style:', 'top-news'),
            'options'     => array(            
                'style-1'  =>  esc_html__('Style 1 (Thumb on top)','top-news'),             
                'style-2'  =>  esc_html__('Style 2 (Thumb on left)','top-news'),            
                'style-3'  =>  esc_html__('Style 3 (Stylish)','top-news'),           
            ),
        ),
        array(
            'id'            => 'archive_excerpt',
            'type'          => 'select',
            'title'         =>  esc_html__('Excerpt', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes','top-news'),             
                ''  =>  esc_html__('No','top-news'),                     
            ),
            'default'       => 'true',
            'dependency'   => array( 'archive_template_post_style', 'any', 'style-1,style-2' ),
        ),
        array(
            'id'            => 'archive_excerpt_limit',
            'type'          => 'text',
            'title'         =>  esc_html__('Excerpt Word Limit', 'top-news'),
            'dependency'   => array( 'archive_template_post_style', 'any', 'style-1,style-2' ),
        ),
        array(
            'id'            => 'archive_readmore',
            'type'          => 'select',
            'title'         =>  esc_html__('Readmore', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes','top-news'),             
                ''  =>  esc_html__('No','top-news'),                     
            ),
            'default'       => '',
            'dependency'    => array( 'archive_template_post_style', 'any', 'style-1,style-2' ),
        ),
        array(
            'id'             => 'archive_column',
            'type'           => 'select',
            'title'          => 'Post Column',
            'options'        => array(
                '1-col'      => '1 column',
                '2-col'      => '2 column',
                '3-col'      => '3 columon',
            ),
            'default'       => '2-col',
            'dependency'   => array( 'archive_template_post_style', 'any', 'style-1,style-3' ),
        ),
    )
); 
// ------------------------------
// Shop layout                  -
// ------------------------------
$options[]      = array(
    'name'        => 'shop_layout',
    'title'       =>  esc_html__('Shop Layout Settings', 'top-news'),
    'icon'        => 'fa fa-database',
    'fields'      =>  array(
        array(
            'type'      => 'heading',
            'content'   =>  esc_html__('Shop Layout Settings', 'top-news'),
        ),        
        array(
            'id'        => 'shop_template_sidebar',
            'type'      => 'image_select',
            'title'     => 'Shop Template',
            'options'   => array(
                '' => get_template_directory_uri().'/images/admin/default.jpg',
                't-style1' => get_template_directory_uri().'/images/admin/t-style-01.jpg',
                't-style2' => get_template_directory_uri().'/images/admin/t-style-02.jpg',
                't-style3' => get_template_directory_uri().'/images/admin/t-style-03.jpg',
                't-style4' => get_template_directory_uri().'/images/admin/t-style-04.jpg',            
            ),
            'default'   => '',
        ),
        array(
            'id'             => 'shop_template_sidebar_option_1',
            'type'           => 'select',
            'title'          => 'Shop Template Sidebar 1',
            'options'        => top_news_get_registered_sidebars(),
            'default_option' => 'Select a sidebar',
        ),
        array(
            'id'             => 'shop_template_sidebar_option_2',
            'type'           => 'select',
            'title'          => 'Shop Template Sidebar 2',
            'options'        => top_news_get_registered_sidebars(),
            'default_option' => 'Select a sidebar',
        ),        
    )
); 
// ------------------------------
// Single page layout                      -
// ------------------------------
$options[]      = array(
    'name'        => 'single_page_seetings',
    'title'       =>  esc_html__('Single page Settings', 'top-news'),
    'icon'        => 'fa fa-file-text',
    'fields'      =>  array(
        array(
            'type'      => 'heading',
            'content'   =>  esc_html__('Single page Settings', 'top-news'),
        ),
        array(
          'id'         => 'single_page_header',
          'type'       => 'switcher',
          'title'      =>  esc_html__('Single Page Header (for header 2 & 3)', 'top-news'),
          'default'    => true
        ),
        array(
            'id'        => 'single_page_header_bg',
            'type'      => 'image',
            'title'     =>  esc_html__('Single Page Background', 'top-news'),
            'add_title' => esc_html__('Add Image', 'top-news'),
            'dependency'      => array( 'blog_page_header', '==', 'true' ),
        ),
        array(
            'id'        => 'single_page_sidebar',
            'type'      => 'image_select',
            'title'     => 'Single Page Template',
            'options'   => array(
                '' => get_template_directory_uri().'/images/admin/default.jpg',
                't-style1' => get_template_directory_uri().'/images/admin/t-style-01.jpg',
                't-style2' => get_template_directory_uri().'/images/admin/t-style-02.jpg',
                't-style3' => get_template_directory_uri().'/images/admin/t-style-03.jpg',
                't-style4' => get_template_directory_uri().'/images/admin/t-style-04.jpg',            
            ),
            'default'   => '',
        ),
        array(
            'id'             => 'single_page_sidebar_option_1',
            'type'           => 'select',
            'title'          => 'Single Page Sidebar 1',
            'options'        => top_news_get_registered_sidebars(),
            'default_option' => 'Select a sidebar',
        ),
        array(
            'id'             => 'single_page_sidebar_option_2',
            'type'           => 'select',
            'title'          => 'Single Page Sidebar 2',
            'options'        => top_news_get_registered_sidebars(),
            'default_option' => 'Select a sidebar',
        ),
        array(
            'id'             => 'single_page_post_style',
            'type'           => 'select',
            'title'          =>  esc_html__('Post Style:', 'top-news'),
            'options'     => array(
                'default-style'  =>  esc_html__('Default','top-news'),             
                'style-1'  =>  esc_html__('Style 1','top-news'),             
                'style-2'  =>  esc_html__('Style 2','top-news'),             
                'style-3'  =>  esc_html__('Style 3','top-news'),          
                'style-4'  =>  esc_html__('Style 4','top-news'),          
            ),
            'default'       => 'default-style',
        ),
        array(
            'id'            => 'tn_single_top_category_list',
            'type'          => 'select',
            'title'         =>  esc_html__('Display Category List on Top', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes', 'top-news'),             
                'false'  =>  esc_html__('No', 'top-news'),                     
            ),
            'default'       => 'true',
        ),
        array(
            'id'            => 'tn_cat_tag_share',
            'type'          => 'select',
            'title'         =>  esc_html__('Display Category tag share box', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes', 'top-news'),             
                'false'  =>  esc_html__('No', 'top-news'),                     
            ),
            'default'       => 'true',
        ),        
        array(
            'id'            => 'tn_single_category_list',
            'type'          => 'select',
            'title'         =>  esc_html__('Display Category List on Bottom', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes', 'top-news'),             
                'false'  =>  esc_html__('No', 'top-news'),                     
            ),
            'default'       => 'false',
        ),
        array(
            'id'            => 'tn_single_tag_list',
            'type'          => 'select',
            'title'         =>  esc_html__('Display Tag List  on Bottom', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes', 'top-news'),             
                'false'  =>  esc_html__('No', 'top-news'),                     
            ),
            'default'       => 'true',
        ),
        array(
            'id'            => 'tn_author_bio',
            'type'          => 'select',
            'title'         =>  esc_html__('Author Bio', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes', 'top-news'),             
                ''  =>  esc_html__('No', 'top-news'),                     
            ),
            'default'       => 'true',
        ),
        array(
            'id'            => 'tn_author_bio_admin',
            'type'          => 'select',
            'title'         =>  esc_html__('Display Administrator Bio Only', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes', 'top-news'),             
                'false'  =>  esc_html__('No', 'top-news'),                     
            ),
            'default'       => 'false',
            'dependency'      => array( 'tn_author_bio', '==', 'true' ),
        ),
        array(
            'id'            => 'tn_related_post',
            'type'          => 'select',
            'title'         =>  esc_html__('Related Post', 'top-news'),
            'options'     => array(
                'true'  =>  esc_html__('Yes', 'top-news'),             
                ''  =>  esc_html__('No', 'top-news'),                     
            ),
            'default'       => 'true',
        ),
    )
); 
// ------------------------------
// backup                       -
// ------------------------------
$options[]   = array(
    'name'     => 'backup_section',
    'title'    => 'Backup',
    'icon'     => 'fa fa-shield',
    'fields'   => array(

        array(
            'type'    => 'notice',
            'class'   => 'warning',
            'content' => 'You can save your current options. Download a Backup and Import.',
        ),

        array(
            'type'    => 'backup',
        ),

    )
);


CSFramework::instance( $settings, $options );