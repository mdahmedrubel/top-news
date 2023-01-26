<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class top_news_mega_menu_walker extends Walker_Nav_Menu {

	private $top_news_megamenu_type 		= '';
	private $top_news_megamenu_columns 		= '';
	private $top_news_has_children 		= '';
        
        function top_news_thumb_src( $size = 'top-news-thumbnail-x2' ){
            global $post;
            $image_id = get_post_thumbnail_id($post->ID);  
            $image_url = wp_get_attachment_image_src($image_id, $size );  
            return $image_url[0];
        }
                
	/**
	 * Starts the list before the elements are added.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);

            if( $depth === 0 && $this->top_news_megamenu_type == 'links' ){
                    $output .= "\n$indent<ul class=\"sub-menu-columns\">\n";
            }
            elseif( $depth === 1 && $this->top_news_megamenu_type == 'links' ){
                    $output .= "\n$indent<ul class=\"sub-menu-columns-item\">\n";
            }
            elseif( $depth === 0 && $this->top_news_megamenu_type == 'sub-posts' ){
                    $output .= "\n$indent<ul class=\"sub-menu mega-cat-more-links\">\n";
            }
            elseif( $depth === 0 && $this->top_news_megamenu_type == 'sub-posts-list' ){
                    $output .= "\n$indent<ul class=\"sub-menu mega-cat-more-links-list\">\n";
            }
            elseif( $depth === 0 && $this->top_news_megamenu_type == 'recent' ){
                    $output .= "\n$indent<ul class=\"mega-recent-featured-list sub-list\">\n";
            }
            else{
                    $output .= "\n$indent<ul class=\"sub-menu menu-sub-content\">\n";
            }
	}

	
	/**
	 * Ends the list of after the elements are added.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";

	}

	
	/**
	 * Start the element output.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';		

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            /**
             * Filter the CSS class(es) applied to a menu item's <li>.
             */
            $class_names = join( " " , apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );


            //By TieLabs ===========
            $a_class = $item_output = '';

            // Define the mega vars
            if( $depth === 0 ){

                    $this->top_news_has_children = 0;
                    if( !empty( $args->has_children ) )
                    $this->top_news_has_children           = $args->has_children;

                    $this->top_news_megamenu_type 	  = get_post_meta( $item->ID, 'top_news_megamenu_type', true );
                    $this->top_news_megamenu_columns       = get_post_meta( $item->ID, 'top_news_megamenu_columns', true );
            }

            //Menu Classes
            if( $depth === 0 && !empty( $this->top_news_megamenu_type ) && $this->top_news_megamenu_type != 'disable' ){
                $class_names .= ' mega-menu';

                if(  $this->top_news_megamenu_type == 'sub-posts' &&  $item->object == 'category' ){
                        $class_names .= ' mega-cat ';
                }
                elseif(  $this->top_news_megamenu_type == 'sub-posts-list' &&  $item->object == 'category' ){
                        $class_names .= ' mega-cat-list ';
                }
                elseif( $this->top_news_megamenu_type == 'links' ){
                        $columns = ( !empty( $this->top_news_megamenu_columns ) ? $this->top_news_megamenu_columns :  2 );
                        $class_names .= ' mega-links mega-links-'.$columns.'col ';
                }
                elseif( $this->top_news_megamenu_type == 'recent' ){
                        $class_names .= ' mega-recent-featured ';
                }
            }

            if( $depth === 1 && $this->top_news_megamenu_type == 'links' ){
                $class_names .=' mega-link-column ';
                $a_class = ' class="mega-links-head" ';
            }
            // =====================

            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            /**
             * Filter the ID applied to a menu item's <li>.
             */
            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names .'>';

            $atts = array();
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

            /**
             * Filter the HTML attributes applied to a menu item's <a>.
             *
             */
            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                        $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            if( !empty( $args->before ) ) $item_output = $args->before;
            $item_output .= '<a'.$a_class . $attributes .'>';

            /** This filter is documented in wp-includes/post-template.php */
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;


            //By TieLabs ===========
            if( $depth === 0 && !empty( $this->top_news_megamenu_type ) && $this->top_news_megamenu_type != 'disable' ){
                $item_output .="\n<div class=\"mega-menu-block menu-sub-content\">\n";
            }
            // =====================

            /**
             * Filter a menu item's starting output.
             */
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	
	/**
	 * Ends the element output, if needed.
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
	
            //By TieLabs ===========
            if( $depth === 0 && !empty( $this->top_news_megamenu_type ) && $this->top_news_megamenu_type != 'disable' ){
                global $post;
                $output .="\n<div class=\"mega-menu-content\">\n";

            //Sub Categories ===============================================================
            if(  $this->top_news_megamenu_type == 'sub-posts' &&  $item->object == 'category' ){
                $no_sub_categories = $sub_categories_exists = $sub_categories = '';

                $query_args = array(
                    'child_of'                 => $item->object_id,
                );
                $sub_categories = get_categories($query_args);

                //Check if the Category doesn't contain any sub categories.
                if( count($sub_categories) == 0) {
                    $sub_categories = array( $item->object_id ) ;
                    $no_sub_categories = true ;
                }else{
                    $sub_categories_exists = 'mega-cat-sub-exists';
                }

                $output .= '<div id="sub-cat-tab" class="mega-cat-wrapper"> ';

                if( !$no_sub_categories ){
                    $output .= '<ul class="mega-cat-sub-categories mega-sub-cat nav nav-tabs" role="tablist"> ';
                    $output .= '<li><a href="#mega-cat-all-item" aria-controls="mega-cat-all-item" role="tab" data-toggle="tab">All</a></li>';
                    foreach( $sub_categories as $category ) {
                       $output .= '<li><a href="#mega-cat-'.$item->ID.'-'.$category->term_id.'" aria-controls="mega-cat-'.$item->ID.'-'.$category->term_id.'" role="tab" data-toggle="tab">'.$category->name.'</a></li>';
                    }
                    $output .=  '</ul> ';
                }

                $output .= ' <div class="tab-content mega-cat-content '. $sub_categories_exists.'">';
                if( !$no_sub_categories ){
                    $output .=  '<div role="tabpanel" id="mega-cat-all-item" class="mega-cat-content-tab tab-pane">';
                }else {
                    $output .=  '<div id="mega-cat-all-item" class="mega-cat-content-tab">';
                }
                
                $original_post = $post;
                $argsall = array(
                    'posts_per_page'         => 4,
                    'cat'                    => $item->object_id,
                    'no_found_rows'          => true,
                    'ignore_sticky_posts'    => true
                );
                $cat_queryall = new WP_Query( $argsall );                
                while ( $cat_queryall->have_posts() ) {
                    $cat_queryall->the_post();
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                    $output .= '<div class="mega-menu-post">';
                    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ):
                    $output .= '<div class="post-thumb"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'"><img src="'.self::top_news_thumb_src( 'top-news-thumbnail-x2' ).'" /></a>';
                    if( !empty($meta_data['embedded_link'])) : 
                        $output .= '<a href="'.get_permalink().'" class="play-btn"></a>';
                    endif;
                    $output .= '</div>';
                    endif;
                    $output .= '<h3 class="post-box-title"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
                    $output .= '<div class="meta"> <i class="fa fa-clock-o"></i><strong>'.get_the_time().'</strong> -- <span>'.get_the_date().'</span></div>';
                    $output .= '</div> <!-- mega-menu-post -->';
                }
                $post = $original_post;
                wp_reset_query();
                
                $output .=  '</div><!-- .mega-cat-content-tab --> ';
                if( !$no_sub_categories ){
                foreach( $sub_categories as $category ) {
                    $cat_id = $category->term_id;

                    $output .=  '<div role="tabpanel" id="mega-cat-'.$item->ID.'-'.$cat_id.'" class="mega-cat-content-tab tab-pane">';

                    $original_post = $post;

                    $args = array(
                        'posts_per_page'         => 4,
                        'cat'          		 => $cat_id,
                        'no_found_rows'          => true,
                        'ignore_sticky_posts'	 => true
                    );
                    $cat_query = new WP_Query( $args ); 
                    while ( $cat_query->have_posts() ) {
                        $cat_query->the_post();
                        $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                        $output .= '<div class="mega-menu-post">';
                        if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ):
                        $output .= '<div class="post-thumb"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'"><img src="'.self::top_news_thumb_src( 'top-news-thumbnail-x2' ).'" /></a>';
                        if( !empty($meta_data['embedded_link'])) : 
                            $output .= '<a href="'.get_permalink().'" class="play-btn"></a>';
                        endif;
                        $output .= '</div>';
                        endif;
                        $output .= '<h3 class="post-box-title"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
                        $output .= '<div class="meta"> <i class="fa fa-clock-o"></i><strong>'.get_the_time().'</strong> -- <span>'.get_the_date().'</span></div>';
                        $output .= '</div> <!-- mega-menu-post -->';
                    }

                    $post = $original_post;
                    wp_reset_query();

                    $output .=  '</div><!-- .mega-cat-content-tab --> ';
                }
            
            }		

                $output .= '</div> <!-- .mega-cat-content --> 
                            <div class="clear"></div>
                    </div> <!-- .mega-cat-Wrapper --> ';
            }

            // End of Sub Categories =====================================================	
            
            //Sub Categories  List===============================================================
            if(  $this->top_news_megamenu_type == 'sub-posts-list' &&  $item->object == 'category' ){                
                $no_sub_categories = $sub_categories_exists = $sub_categories = '';

                $query_args = array(
                    'child_of'                 => $item->object_id,
                );
                $sub_categories = get_categories($query_args);

                //Check if the Category doesn't contain any sub categories.
                if( count($sub_categories) == 0) {
                    $sub_categories = array( $item->object_id ) ;
                    $no_sub_categories = true ;
                }else{
                    $sub_categories_exists = 'mega-cat-sub-exists';
                }

                $output .= '<div id="sub-cat-tab-list" class="mega-cat-wrapper"> ';

                    if( !$no_sub_categories ){
                $output .= '<ul class="mega-cat-sub-categories mega-sub-cat-list nav nav-tabs" role="tablist"> ';
                        $output .= '<li><a href="#mega-cat-all-item-list" aria-controls="mega-cat-all-item-list" role="tab" data-toggle="tab">All</a></li>';
                        foreach( $sub_categories as $category ) {
                           $output .= '<li><a href="#mega-cat-'.$item->ID.'-'.$category->term_id.'" aria-controls="mega-cat-'.$item->ID.'-'.$category->term_id.'" role="tab" data-toggle="tab">'.$category->name.'</a></li>';
                        }
                $output .=  '</ul> ';
                    }

                $output .= ' <div class="tab-content mega-cat-content'. $sub_categories_exists.'">';
                if( !$no_sub_categories ){
                    $output .=  '<div role="tabpanel" id="mega-cat-all-item-list" class="mega-cat-content-tab tab-pane">';
                } else {
                    $output .=  '<div id="mega-cat-all-item-list no-tab" class="mega-cat-content-tab">';
                }                    
                $original_post = $post;
                $argsall = array(
                    'posts_per_page'        => 5,
                    'cat'                   => $item->object_id,
                    'no_found_rows'         => true,
                    'ignore_sticky_posts'   => true
                );
                $cat_query_all = new WP_Query( $argsall );
                $output .= '<div class="mega-menu-featured-post">';
                $count = 0;
                while ( $cat_query_all->have_posts() ) {
                    $count ++ ;
                    $cat_query_all->the_post();
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );

                if( $count == 1) {
                    $output .= '<div class="mega-menu-post">';
                    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ):
                    $output .= '<div class="post-thumb"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'"><img src="'.self::top_news_thumb_src( 'top-news-thumbnail-x2' ).'" /></a>';
                    if( !empty($meta_data['embedded_link'])) : 
                        $output .= '<a href="'.get_permalink().'" class="play-btn"></a>';
                    endif;
                    $output .= '</div>';
                    endif;
                    $output .= '<h3 class="post-box-title"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
                    $output .= '<div class="meta"> <i class="fa fa-clock-o"></i><strong>'.get_the_time().'</strong> -- <span>'.get_the_date().'</span></div>';
                    $output .= '</div> <!-- mega-menu-post -->';
                    $output .= '</div> <!-- mega-menu-featured-post -->';
                    $output .= '<div class="mega-menu-featured-list-post">';
                } else {
                    $output .= '<div class="mega-menu-post-list">';
                    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ):
                    $output .= '<div class="list-post-thumb"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'"><img src="'.self::top_news_thumb_src( 'thumbnail' ).'" width="75" height="75"/></a></div>';
                    endif;
                    $output .= '<h3 class="post-box-title"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
                    $output .= '<div class="meta"> <i class="fa fa-clock-o"></i><strong>'.get_the_time().'</strong> -- <span>'.get_the_date().'</span></div>';
                    $output .= '</div> <!-- mega-menu-post-list -->';                        
                }                    
                }
                $output .= '</div> <!-- mega-menu-featured-list-post -->';

                $post = $original_post;
                wp_reset_query();
                $output .= '</div> <!-- .mega-cat-content -->';
                if( !$no_sub_categories ){    
                foreach( $sub_categories as $category ) {
                    $count = 0;
                    $cat_id = $category->term_id;

                    $output .=  '<div role="tabpanel" id="mega-cat-'.$item->ID.'-'.$cat_id.'" class="mega-cat-content-tab tab-pane">';

                    $original_post = $post;

                    $args = array(
                        'posts_per_page'         => 5,
                        'cat'          		 => $cat_id,
                        'no_found_rows'          => true,
                        'ignore_sticky_posts'	 => true
                    );
                    $cat_query = new WP_Query( $args );
                    $output .= '<div class="mega-menu-featured-post">';
                    while ( $cat_query->have_posts() ) {
                        $count ++ ;
                        $cat_query->the_post();
                        $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                    
                    if( $count == 1) {
                        $output .= '<div class="mega-menu-post">';
                        if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ):
                        $output .= '<div class="post-thumb"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'"><img src="'.self::top_news_thumb_src( 'top-news-thumbnail-x2' ).'" /></a>';
                        if( !empty($meta_data['embedded_link'])) : 
                            $output .= '<a href="'.get_permalink().'" class="play-btn"></a>';
                        endif;
                        $output .= '</div>';
                        endif;
                        $output .= '<h3 class="post-box-title"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
                        $output .= '<div class="meta"> <i class="fa fa-clock-o"></i><strong>'.get_the_time().'</strong> -- <span>'.get_the_date().'</span></div>';
                        $output .= '</div> <!-- mega-menu-post -->';
                        $output .= '</div> <!-- mega-menu-featured-post -->';
                        $output .= '<div class="mega-menu-featured-list-post">';
                    } else {
                        $output .= '<div class="mega-menu-post-list">';
                        if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ):
                        $output .= '<div class="list-post-thumb"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'"><img src="'.self::top_news_thumb_src( 'thumbnail' ).'" width="75" height="75"/></a></div>';
                        endif;
                        $output .= '<h3 class="post-box-title"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
                        $output .= '<div class="meta"> <i class="fa fa-clock-o"></i><strong>'.get_the_time().'</strong> -- <span>'.get_the_date().'</span></div>';
                        $output .= '</div> <!-- mega-menu-post-list -->';                        
                    }                    
                    }
                    $output .= '</div> <!-- mega-menu-featured-list-post -->';
                    $post = $original_post;
                    wp_reset_query();

                    $output .=  '</div><!-- .mega-cat-content-tab --> ';
                }
                }

                $output .= '</div> <!-- .mega-cat-content --> 
                            <div class="clear"></div>
                    </div> <!-- .mega-cat-Wrapper --> ';
            }

            // End of Sub Categories List=====================================================	

            //Recent ========================================================
            if( $this->top_news_megamenu_type == 'recent' &&  $item->object == 'category' ){
                $output_more_posts = '';
                $original_post = $post;

                $args = array(
                    'posts_per_page'         => 5,
                    'cat'                    => $item->object_id,
                    'no_found_rows'          => true,
                    'ignore_sticky_posts'    => true
                );

                $cat_query = new WP_Query( $args ); 
                while ( $cat_query->have_posts() ) {
                    $cat_query->the_post();
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                    $output .= '<div class="mega-recent-post">';
                    if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ):
                        $output .= '<div class="post-thumb"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'"><img src="'.self::top_news_thumb_src( 'top-news-thumbnail-x2' ).'" /></a>';
                        if( !empty($meta_data['embedded_link'])) : 
                            $output .= '<a href="'.get_permalink().'" class="play-btn"></a>';
                        endif;
                        $output .= '</div>';
                    endif;
                    $output .= '<h3 class="post-box-title"><a class="mega-menu-link" href="'. get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
                    $output .= '<div class="meta"> <i class="fa fa-clock-o"></i><strong>'.get_the_time().'</strong> -- <span>'.get_the_date().'</span></div>';
                    $output .= '</div> <!-- mega-recent-post -->';

                }

                $post = $original_post;
                wp_reset_query();

                $output .= '<div class="mega-check-also"><ul>'.$output_more_posts.'</ul></div> <!-- mega-check-also -->';			
            }

                // End of Sub Categories =====================================================

                $output .= "\n</div><!-- .mega-menu-content --> \n</div><!-- .mega-menu-block --> \n";
            }
            // =====================

            $output .= "</li>\n";
	}
	
	
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args = array() , &$output ) {
            $id_field = $this->db_fields['id'];
            if ( is_object( $args[0] ) ) {
                $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
            }
            return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
} // Walker_Nav_Menu



// Back end modification on Menus page ===============================================
add_filter( 'wp_edit_nav_menu_walker', 'top_news_custom_nav_edit_walker',10,2 );
function top_news_custom_nav_edit_walker($walker,$menu_id) {
    return 'top_news_mega_menu_edit_walker';
}


// The Custom Tielabs menu fields
add_action( 'top_news_nav_menu_item_custom_fields', 'top_news_add_megamenu_fields', 10, 4 );
function top_news_add_megamenu_fields( $item_id, $item, $depth, $args ) { ?>
    <div class="clear"></div>
    <div class="tn-mega-menu-type">	
        <p class="field-megamenu-type description description-wide">
            <label for="edit-menu-item-megamenu-type-<?php echo $item_id; ?>">
                <?php esc_html_e( 'Enable Mega Menu ?', 'top-news' ); ?>
                <select id="edit-menu-item-megamenu-type-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-type" name="menu-item-tn-megamenu-type[<?php echo $item_id; ?>]">
                    <option value="disable" <?php selected( $item->top_news_megamenu_type, 'disable' ); ?>><?php esc_html_e( 'Disable', 'top-news' ); ?></option>
                    <?php  if( $item->object == 'category' ){  ?>
                    <option value="sub-posts" <?php selected( $item->top_news_megamenu_type, 'sub-posts' ); ?>><?php esc_html_e( 'Sub Categories + Recent Posts', 'top-news' ); ?></option>
                    <option value="sub-posts-list" <?php selected( $item->top_news_megamenu_type, 'sub-posts-list' ); ?>><?php esc_html_e( 'Sub Categories + Recent Posts + List', 'top-news' ); ?></option>
                    <option value="recent" <?php selected( $item->top_news_megamenu_type, 'recent' ); ?>><?php esc_html_e( 'Recent post', 'top-news' ); ?></option>
                    <?php } ?>
                    <option value="links" <?php selected( $item->top_news_megamenu_type, 'links' ); ?>><?php esc_html_e( 'Mega Links', 'top-news' ); ?></option>
                </select>
            </label>
        </p>

        <p class="field-megamenu-columns description description-wide">
            <label for="edit-menu-item-megamenu-columns-<?php echo $item_id; ?>">
                <?php esc_html_e( 'Mega Links - Columns', 'top-news' ); ?>
                <select id="edit-menu-item-megamenu-columns-<?php echo $item_id; ?>" class="widefat code edit-menu-item-megamenu-columns" name="menu-item-tn-megamenu-columns[<?php echo $item_id; ?>]">
                    <option value="2" <?php selected( $item->top_news_megamenu_columns, '2' ); ?>>2</option>
                    <option value="3" <?php selected( $item->top_news_megamenu_columns, '3' ); ?>>3</option>
                    <option value="4" <?php selected( $item->top_news_megamenu_columns, '4' ); ?>>4</option>
                    <option value="5" <?php selected( $item->top_news_megamenu_columns, '5' ); ?>>5</option>
                </select>
            </label>
        </p>							
    </div><!-- .tn-mega-menu-type-->
<?php }


// Save The custom Fields
add_action('wp_update_nav_menu_item', 'top_news_custom_nav_update',10, 3);
function top_news_custom_nav_update($menu_id, $menu_item_db_id, $args ) {
    if ( isset($_REQUEST['menu-item-tn-megamenu-type']) ) {
            $custom_value = $_REQUEST['menu-item-tn-megamenu-type'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, 'top_news_megamenu_type', $custom_value );
    }

    if ( isset($_REQUEST['menu-item-tn-megamenu-columns']) ) {
            $custom_value = $_REQUEST['menu-item-tn-megamenu-columns'][$menu_item_db_id];
            update_post_meta( $menu_item_db_id, 'top_news_megamenu_columns', $custom_value );
    }

}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */
add_filter( 'wp_setup_nav_menu_item','top_news_custom_nav_item' );
function top_news_custom_nav_item($menu_item) {
    $menu_item->top_news_megamenu_type = get_post_meta( $menu_item->ID, 'top_news_megamenu_type', true );
    return $menu_item;
}


/**
 * Navigation Menu template functions
 */
class top_news_mega_menu_edit_walker extends Walker_Nav_Menu {
    /**
     * Starts the list before the elements are added.
     *
     * @see Walker_Nav_Menu::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker_Nav_Menu::end_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {}

    /**
     * Start the element output.
     *
     * @see Walker_Nav_Menu::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   Not used.
     * @param int    $id     Not used.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            global $_wp_nav_menu_max_depth;
            $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

            ob_start();
            $item_id = esc_attr( $item->ID );
            $removed_args = array(
                    'action',
                    'customlink-tab',
                    'edit-menu-item',
                    'menu-item',
                    'page-tab',
                    '_wpnonce',
            );

            $original_title = '';
            if ( 'taxonomy' == $item->type ) {
                $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
                if ( is_wp_error( $original_title ) )
                        $original_title = false;
            } elseif ( 'post_type' == $item->type ) {
                $original_object = get_post( $item->object_id );
                $original_title = get_the_title( $original_object->ID );
            }

            $classes = array(
                'menu-item menu-item-depth-' . $depth,
                'menu-item-' . esc_attr( $item->object ),
                'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
            );

            $title = $item->title;

            if ( ! empty( $item->_invalid ) ) {
                $classes[] = 'menu-item-invalid';
                /* translators: %s: title of menu item which is invalid */
                $title = sprintf( __( '%s (Invalid)','top-news' ), $item->title );
            } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
                $classes[] = 'pending';
                /* translators: %s: title of menu item in draft status */
                $title = sprintf( __('%s (Pending)','top-news'), $item->title );
            }

            $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

            $submenu_text = '';
            if ( 0 == $depth )
                $submenu_text = 'style="display: none;"';

            ?>
            <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
                <dl class="menu-item-bar">
                    <dt class="menu-item-handle">
                        <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo $submenu_text; ?>><?php esc_html_e( 'sub item','top-news' ); ?></span></span>
                        <span class="item-controls">
                            <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                            <span class="item-order hide-if-js">
                                <a href="<?php
                                    echo wp_nonce_url(
                                        add_query_arg(
                                            array(
                                                    'action' => 'move-up-menu-item',
                                                    'menu-item' => $item_id,
                                            ),
                                            remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                        ),
                                        'move-menu_item'
                                    );
                                ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','top-news'); ?>">&#8593;</abbr></a>
                                    |
                                    <a href="<?php
                                        echo wp_nonce_url(
                                            add_query_arg(
                                                array(
                                                        'action' => 'move-down-menu-item',
                                                        'menu-item' => $item_id,
                                                ),
                                                remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                            ),
                                            'move-menu_item'
                                        );
                                    ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','top-news'); ?>">&#8595;</abbr></a>
                            </span>
                            <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item','top-news'); ?>" href="<?php
                                    echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                            ?>"><?php esc_html_e( 'Edit Menu Item','top-news' ); ?></a>
                        </span>
                    </dt>
                </dl>

                <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
                    <?php if( 'custom' == $item->type ) : ?>
                        <p class="field-url description description-wide">
                                <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                                    <?php esc_html_e( 'URL','top-news' ); ?><br />
                                    <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                                </label>
                        </p>
                    <?php endif; ?>
                    <p class="description description-thin">
                        <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                            <?php esc_html_e( 'Navigation Label','top-news' ); ?><br />
                            <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                        </label>
                    </p>
                    <p class="description description-thin">
                        <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                            <?php esc_html_e( 'Title Attribute','top-news' ); ?><br />
                            <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                        </label>
                    </p>
                    <p class="field-link-target description">
                        <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                            <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                            <?php esc_html_e( 'Open link in a new window/tab','top-news' ); ?>
                        </label>
                    </p>
                    <p class="field-css-classes description description-thin">
                        <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                            <?php esc_html_e( 'CSS Classes (optional)','top-news' ); ?><br />
                            <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                        </label>
                    </p>
                    <p class="field-xfn description description-thin">
                        <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                            <?php esc_html_e( 'Link Relationship (XFN)','top-news' ); ?><br />
                            <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                        </label>
                    </p>
                    <p class="field-description description description-wide">
                        <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                            <?php esc_html_e( 'Description','top-news' ); ?><br />
                            <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                            <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.','top-news'); ?></span>
                        </label>
                    </p>


                    <?php
                        //By Tielabs **************************************************

                        do_action( 'top_news_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );

                        // END ********************************************************
                    ?>

                    <p class="field-move hide-if-no-js description description-wide">
                        <label>
                            <span><?php esc_html_e( 'Move','top-news' ); ?></span>
                            <a href="#" class="menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one','top-news' ); ?></a>
                            <a href="#" class="menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one','top-news' ); ?></a>
                            <a href="#" class="menus-move menus-move-left" data-dir="left"></a>
                            <a href="#" class="menus-move menus-move-right" data-dir="right"></a>
                            <a href="#" class="menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top','top-news' ); ?></a>
                        </label>
                    </p>

                    <div class="menu-item-actions description-wide submitbox">
                        <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                            <p class="link-to-original">
                                <?php printf( __('Original: %s','top-news'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                            </p>
                        <?php endif; ?>
                        <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                        echo wp_nonce_url(
                            add_query_arg(
                                array(
                                        'action' => 'delete-menu-item',
                                        'menu-item' => $item_id,
                                ),
                                admin_url( 'nav-menus.php' )
                            ),
                            'delete-menu_item_' . $item_id
                        ); ?>"><?php esc_html_e( 'Remove','top-news' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) ); ?>#menu-item-settings-<?php echo $item_id; ?>"><?php esc_html_e('Cancel','top-news'); ?></a>
                </div>

                    <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
                    <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                    <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                    <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                    <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                    <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
                </div><!-- .menu-item-settings-->
                <ul class="menu-item-transport"></ul>
            <?php
            $output .= ob_get_clean();
    }


} // Walker_Nav_Menu
?>