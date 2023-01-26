<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Theme’s filters and actions
 *
 * @package TopNews
 * @author CodexCoder
 */

// Theme Setup
add_action( 'after_setup_theme', 'top_news_setup' );

// Theme Content Width
add_action( 'after_setup_theme', 'top_news_content_width', 0 );

// Archive Count Fix for WordPress Widget
add_filter('wp_list_categories','top_news_cat_count_filter');
add_filter('get_archives_link','top_news_archives_count_filter');

//add custom body class
function top_news_body_classes( $classes ) {
    $boxed_layout = cs_get_option( 'tn_boxed_layout' );
    $tn_section_header_style = cs_get_option( 'tn_section_header_style' );
 
    if($boxed_layout == 'true'){
        $classes[] = esc_attr('boxed');
    }
    switch($tn_section_header_style){
        case 'style1':
            $classes[] = esc_attr('sh-style1');
            break;
        case 'style2':
            $classes[] = esc_attr('sh-style2');
            break;
        case 'style3':
            $classes[] = esc_attr('sh-style3');
            break;
        case 'style4':
            $classes[] = esc_attr('sh-style4');
            break;
        case 'style5':
            $classes[] = esc_attr('sh-style5');
            break;
        case 'style6':
            $classes[] = esc_attr('sh-style6');
            break;
        default:
            $classes[] = esc_attr('sh-style3');
    }
    return $classes;
}
if (function_exists('cs_get_option')):
    add_filter( 'body_class', 'top_news_body_classes' );
endif;

function top_news_excerpt_more() {
    return '';
}
add_filter('excerpt_more', 'top_news_excerpt_more');

function top_news_PostViews($post_ID) {

    //Set the name of the Posts Custom Field.
    $count_key = 'post_views_count';

    //Returns values of the custom field with the specified key from the specified post.
    $count = get_post_meta($post_ID, $count_key, true);

    //If the the Post Custom Field value is empty.
    if($count == ''){
        $count = 0; // set the counter to zero.

        //Delete all custom fields with the specified key from the specified post.
        delete_post_meta($post_ID, $count_key);

        //Add a custom (meta) field (Name/value)to the specified post.
        add_post_meta($post_ID, $count_key, '0');
        return $count . '';

        //If the the Post Custom Field value is NOT empty.
    }else{
        $count++; //increment the counter by 1.
        //Update the value of an existing meta key (custom field) for the specified post.
        update_post_meta($post_ID, $count_key, $count);

        //If statement, is just to have the singular form 'View' for the value '1'
        if($count == '1'){
            return $count . '';
        }
        //In all other cases return (count) Views
        else {
            return $count . '';
        }
    }
}
add_action( 'init', 'top_news_PostViews' );

//ajax load more post for single page
add_action( 'wp_ajax_nopriv_top_news_load_post', 'top_news_load_post' );
add_action( 'wp_ajax_top_news_load_post', 'top_news_load_post' );
function top_news_load_post() {
    $post_type = isset($_POST['post_type']) ? $_POST['post_type'] : 'post';
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : get_option('posts_per_page');
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 2;
    $blog_column = isset($_POST['blog_column']) ? $_POST['blog_column'] : '';    
    $post_style = isset($_POST['post_style']) ? $_POST['post_style'] : '';
    $is_excerpt = isset($_POST['is_excerpt']) ? $_POST['is_excerpt'] : 'yes';
    $excerpt_limit = isset($_POST['excerpt_limit']) ? $_POST['excerpt_limit'] : '';
    $is_readmore = isset($_POST['is_readmore']) ? $_POST['is_readmore'] : '';
    $data_clear = isset($_POST['data_clear']) ? $_POST['data_clear'] : '';
    $data_clear = isset($_POST['data_clear']) ? $_POST['data_clear'] : '';
    switch($post_style){
        case 'style-2' :
            $post_class = 'posts-lists archive-row x2';
            $article_class = 'post-item';
            $content_class = 'content';
            break;
        case 'style-3' :
            $post_class = 'posts-lists featured-posts';
            $article_class = 'post-item special x2 cat-x2';
            $content_class = 'post-info';
            break;
        default:
            $post_class = 'posts-lists';
            $article_class = 'post-item';
            $content_class = 'content';
    }
    
    if ((!empty($blog_column)) && $blog_column == '1-col'){
        $post_col = 'col-md-12';
        $post_thumb = 'full';
        $perrow = 1;
    }else if ((!empty($blog_column)) && $blog_column == '2-col'){
        $post_col = 'col-md-6 col-sm-6';
        $post_thumb = 'top-news-thumbnail-x2';
        $perrow = 2;
    }else if ((!empty($blog_column)) && $blog_column == '3-col'){
        $post_col = 'col-md-4 col-sm-4';
        $post_thumb = 'top-news-thumbnail-x2';
        $perrow = 3;
    }else{
        $post_col = 'col-md-12';
        $post_thumb = 'full';
        $perrow = 1;
    }   
    if ($post_style =='style-2'){
        $post_col = 'col-md-12';
    }
    if ($post_style =='style-3'){
        $is_excerpt = 'no';
        $is_readmore = 'no';
    }    
    
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged,
    );
    $loop = new WP_Query($args);
    if ($loop -> have_posts()) :
        $count = $data_clear;
        while ($loop -> have_posts()) : $loop -> the_post();$count++;
            top_news_blog_posts($article_class, $post_col, $content_class, $post_thumb, $is_excerpt, $is_readmore, $excerpt_limit);
            if ($count%$perrow==0): ?>
                <div class="clearfix"></div> 
            <?php endif; endwhile;
    endif;
    wp_reset_postdata();
    die();
}

add_filter( 'style_loader_src', 'top_news_remove_version' );
add_filter( 'script_loader_src', 'top_news_remove_version' );

function top_news_remove_version( $url ) {
    return remove_query_arg( 'ver', $url );
}

//display posts video url metabox value to rest api

add_action( 'rest_api_init', 'top_news_create_api_posts_meta_field' );
 
function top_news_create_api_posts_meta_field() {
 
    // register_rest_field ( 'name-of-post-type', 'name-of-field-to-return', array-of-callbacks-and-schema() )
    register_rest_field( 'post', '_format-video', array(
           'get_callback'    => 'top_news_get_post_meta_for_api',
           'schema'          => null,
        )
    );
}
 
function top_news_get_post_meta_for_api( $object ) {
    //get the id of the post object array
    $post_id = $object['id'];
 
    //return the post meta
    return get_post_meta( $post_id );
}


/**
 * Moving the comments text field and cookie checkbox to bottom
 */
function top_news_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields[ 'comment' ];    
    unset( $fields[ 'comment' ] );
    $fields[ 'comment' ] = $comment_field;

    $cookie_field = $fields[ 'cookies' ];
    unset( $fields[ 'cookies' ] );
    $fields[ 'cookies' ] = $cookie_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'top_news_move_comment_field_to_bottom' );