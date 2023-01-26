<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package TopNews
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

if ( ! function_exists( 'top_news_getcat' ) ) {
    function top_news_getcat(){
            $categories_obj = get_categories();
            $cats = array();
            $cats['All'] = '0';
            foreach ($categories_obj as $cat) {
                $cats[$cat->cat_name] = $cat->term_id;
            }
            return $cats;
    }
}

if ( ! function_exists( 'top_news_get_category_id_from_slug' ) ) {
    function top_news_get_category_id_from_slug($cat_ids) {
        foreach( $cat_ids as $cat ) : 
            $top_news_term = get_category_by_slug($cat); 
            $getcatid[] = esc_attr($top_news_term->term_id);
            $getcatids = implode(",", array_filter($getcatid));
            $getcatids1 = rtrim($getcatids,',');
        endforeach;
        return $getcatids1;
    }
}

if ( ! function_exists( 'top_news_get_term_names' ) ) {
    function top_news_get_term_names($category){
        $terms = get_the_terms(get_the_ID(), $category);
        for($term_count=0; $term_count<count($terms); $term_count++) {
            echo '<span>'.$terms[$term_count]->name.'</span>';
            if ($term_count<count($terms)-1){
                echo ', ';
            }                                            
        }      
    }
}

if ( ! function_exists( 'top_news_get_terms_link' ) ) {
    function top_news_get_terms_link($category) {
        $terms = get_the_terms(get_the_ID(), $category);
        if ( $terms && ! is_wp_error( $terms ) ) :
            $draught_links = array();
            foreach ( $terms as $term ) {
                $draught_links = '<a href="'.esc_url(get_term_link($term->term_id)).'" class="cat-tag">'.$term->name.'</a>';
                echo $draught_links;
            }
        endif; 
    }
}


if ( ! function_exists( 'top_news_get_terms_link2' ) ) {
    function top_news_get_terms_link2($category) {
        $terms = get_the_terms(get_the_ID(), $category);
        if ( $terms && ! is_wp_error( $terms ) ) :
        for($term_count=0; $term_count<count($terms); $term_count++) {        
            echo '<a href="'.esc_url(get_term_link($terms[$term_count]->term_id)).'">'.$terms[$term_count]->name.'</a>';
            if ($term_count<count($terms)-1){
                echo ', ';
            }                                            
        }
        endif;
    }
}

// Get registered sidebars helper function
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

if ( ! function_exists( 'top_news_search_from_h1' ) ) {
    function top_news_search_from_h1(){ ?>
        <i id="nav-search-open" class="fa fa-search"></i>
        <form id="nav-search-form" class="nav-search hidden" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'top-news' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'top-news' ); ?>" />
            <i id="nav-search-close" class="fa fa-close"></i>
        </form>
    <?php }
}

if ( ! function_exists( 'top_news_search_from_h3' ) ) {
    function top_news_search_from_h3() {?>
        <form class="header-search-form" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'top-news' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'top-news' ); ?>" />
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    <?php }
}

if ( ! function_exists( 'top_news_header_breadcrumbs' ) ) {
    function top_news_header_breadcrumbs(){
        $header_style = cs_get_option('header_style');  
        $breadcrumb_style = cs_get_option('tn_breadcrumbs_style');
        $header_bg = cs_get_option('header_bg');
        $classes = array(
            'page-header'
        );
        if($header_style == 2):
            $classes[] = 'transparent v2';
        endif;
        if($header_style == 3):
            $classes[] = 'v3 transparent';
        endif;
        if(!empty($breadcrumb_style) && $header_style != 2 && $header_style != 3 ):
            $classes[] = $breadcrumb_style;
        endif;
        $header_attribute = array();
        $header_attribute[] = 'class="' . implode( ' ', $classes ) . '"';
        if($header_bg != '' && ($header_style == 2 || $header_style == 3)):
            $header_attribute[] = 'data-tp-src="'.wp_get_attachment_url($header_bg).'"';
        endif;

        echo '<div '.implode( ' ', $header_attribute ).'>';

            if( !is_front_page() && ($header_style == 2 || $header_style == 3) ):
                echo '<div class="content">';
            endif;

            if($breadcrumb_style == 2 && $header_style != 2 && $header_style != 3 ):
                top_news_page_header2();
            else:
                top_news_page_header();
            endif;

            if( !is_front_page() && ($header_style == 2 || $header_style == 3) ):
                echo '</div>';
            endif;

        echo '</div>';       
    }
}

if ( ! function_exists( 'top_news_page_header' ) ):
    function top_news_page_header(){ ?>
        <div class="container">
            <div class="row">
                <?php if(is_single()): ?>
                    <div class="col-md-12 col-sm-12">
                    <?php top_news_breadcrumbs(); ?>
                    </div><!-- /.col-sm-6 -->                    
                <?php else : ?>
                    <div class="col-md-6 hidden-tab"><h1 class="title text-uppercase">
                    <?php top_news_page_title() ?>
                    </h1></div><!-- /.col-sm-6 -->

                    <div class="col-md-6 col-sm-12">
                    <?php top_news_breadcrumbs('pull-right'); ?>
                    </div><!-- /.col-sm-6 -->                    
                <?php endif; ?>
            </div><!-- /.row -->
        </div><!-- /.container -->       
    <?php }
endif;

if ( ! function_exists( 'top_news_page_header2' ) ):
    function top_news_page_header2(){ ?>
        <div class="container">
            <div class="row">
                <?php if(is_single()): ?>
                    <div class="col-md-12 col-sm-12">
                    <?php top_news_breadcrumbs(); ?>
                    </div><!-- /.col-sm-6 -->                    
                <?php else : ?>
                    <div class="col-md-12 col-sm-12">
                        <?php top_news_breadcrumbs(); ?>
                        <h1 class="title text-uppercase"><?php top_news_page_title() ?></h1>
                    </div><!-- /.col-sm-6 -->                                     
                <?php endif; ?>
            </div><!-- /.row -->
        </div><!-- /.container -->       
    <?php }
endif;

if ( ! function_exists( 'top_news_page_title' ) ) {
    function top_news_page_title() {
        if(class_exists( 'WooCommerce' ) && is_woocommerce()) {
            woocommerce_page_title();
        } else if(class_exists( 'bbPress' ) && is_bbpress()) {
           the_title();
        } else if(is_archive() ) {
                the_archive_title('');
        } else if(is_home()) {                                                
                echo wp_title('');
        } else {
            the_title('');
        }    
    }
}

if ( ! function_exists( 'top_news_meta_description' ) ) {
    function top_news_meta_description(){ ?>
        <div class="meta entry-meta">
            <?php top_news_posted_on(); ?>
            <span class="view"><i class="fa fa-eye"></i> 
            <?php if(function_exists('top_news_PostViews')){
                echo top_news_PostViews(get_the_ID());                        
            }?></span>
            <span class="comment"><i class="fa fa-comments"></i> <?php comments_number( '0', '0', '%' ); ?></span>
        </div><!-- /.meta -->         
    <?php }
}

if ( ! function_exists( 'top_news_single_meta_description' ) ) {
    function top_news_single_meta_description(){ ?>
        <div class="meta-post-area meta">
            <div class="meta-info">
                <?php 
                    echo get_avatar( get_the_author_meta( 'ID' ), 32 );
                    top_news_posted_on(); 
                ?>
            </div>
            <div class="meta-count">
                <span class="view"><i class="fa fa-eye"></i> 
                <?php if(function_exists('top_news_PostViews')){
                    echo top_news_PostViews(get_the_ID());                        
                }?></span>
                <span class="comment"><a href="#respond"><i class="fa fa-comments"></i> <?php comments_number( '0', '0', '%' ); ?></a></span>
            </div>            
        </div><!-- /.meta -->         
    <?php }
}
if ( ! function_exists( 'top_news_block_meta' ) ) {
    function top_news_block_meta(){ ?>
        <div class="meta block-meta">
            <?php if (function_exists('wp_review_show_total')): wp_review_show_total(); endif;?>
            <span><?php esc_html_e('Posted by', 'top-news'); ?></span>
            <?php the_author_posts_link(); ?>
            <span>-</span>
            <span><?php echo get_the_date(); ?></span>
            <span class="comment"><a href="<?php echo get_the_permalink() ?>#respond"><i class="fa fa-comments"></i> <?php comments_number( '0', '0', '%' ); ?></a></span>
        </div> <!--/.meta-->        
    <?php }
}
if ( ! function_exists( 'top_news_single_cat_list' ) ):
function top_news_single_cat_list($postId){ ?>
    <div class="single-cat-tag-list">
        <?php 
        $post_categories = get_the_category( $postId );
        foreach ($post_categories as $post_category):
            echo '<a class="cat-tag" href="' . esc_url( get_category_link( $post_category ) ) . '"> 
                     ' . esc_html( $post_category->name ) . '
                 </a>';
        endforeach;
        ?>
    </div>
<?php }
endif;

if ( ! function_exists( 'top_news_top_bar' ) ):
    function top_news_top_bar(){
        $header_top_bar = '';
        $tn_topbar_style = '1';
        if (function_exists('cs_get_option')):
            $header_top_bar = cs_get_option('header_top_bar');        
            $tn_topbar_style = cs_get_option('tn_topbar_style');
        endif;        
        if ($header_top_bar == '1' && (!empty($tn_topbar_style))) {
            get_template_part('template-parts/headers/top', $tn_topbar_style);
        }
    }
endif;

if ( ! function_exists( 'top_news_share_count' ) ):
    function top_news_share_count(){
        $tn_is_sharecount = '';
        if (function_exists('cs_get_option')):
            $tn_is_sharecount = cs_get_option('tn_is_sharecount');
        endif;    
        if ($tn_is_sharecount == 1):
        ?>
            <div class="share-icon-count">
                <span class="share-icon"><i class="fa fa-share-alt" aria-hidden="true"></i></span><?php echo do_shortcode('[mashshare buttons="false"]'); ?>
            </div>
        <?php endif;         
    }
endif;

if ( ! function_exists( 'top_news_get_client_ip' ) ):
    function top_news_get_client_ip() {  
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')){
             $ipaddress = getenv('HTTP_CLIENT_IP');
        }else if(getenv('HTTP_X_FORWARDED_FOR')){
             $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        }else if(getenv('HTTP_X_FORWARDED')) {
             $ipaddress = getenv('HTTP_X_FORWARDED');
        }else if(getenv('HTTP_FORWARDED_FOR')){
             $ipaddress = getenv('HTTP_FORWARDED_FOR');
        }else if(getenv('HTTP_FORWARDED')){
             $ipaddress = getenv('HTTP_FORWARDED');
        }else if(getenv('REMOTE_ADDR')){
             $ipaddress = getenv('REMOTE_ADDR');
        }else{
             $ipaddress = 'UNKNOWN';
        }
        return $ipaddress;
    }
endif;

if ( ! function_exists( 'top_news_ip_version' ) ):
    function top_news_ip_version($ip) {
        if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return 'ipv4';
        } else {
            return 'ipv6';
        }                        
    }
endif;

if ( ! function_exists( 'top_news_k_to_c' ) ):
    function top_news_k_to_c($temp) {
            if (!is_numeric($temp)) { return false; }
            return ceil(($temp - 273.15));
    }
endif;
?>