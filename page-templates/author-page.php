<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/*
Template Name: Author Page
*/
get_header();?>
<div class="site-content author-list">
    <div class="container">
        <div class="row">
        <?php 
            $top_news_layout_meta_data = get_post_meta( get_the_ID(), '_custom_page_side_options', true );
            $top_news_layout_meta_field = $top_news_layout_meta_data['section_3_image_select'];
            switch ($top_news_layout_meta_field) {
                case 'v1' :
                    top_news_get_author_layouts('col-md-12 content-holder', '', '', '', '', '');
                break;    
                case 'v3' :
                    top_news_get_author_layouts('', '', '', 'right', 'col-md-8 content-holder', '');
                break;    
                case 'v3' :
                    top_news_get_author_layouts('', '', 'left', '', 'col-md-6 content-holder', 'right');
                break;    
                case 'v4' :
                    top_news_get_author_layouts('', '', '', 'left', 'col-md-6 content-holder', 'right');
                break;    
                case 'v5' :
                    top_news_get_author_layouts('', '', 'left', 'right', 'col-md-6 content-holder', '');
                break;
                case 'v6' :
                    top_news_get_author_layouts('', 'col-md-6 content-holder', 'left', 'right', '', '');
                break;
                default:                                    
                    top_news_get_author_layouts('', '', '', '', 'col-md-8 content-holder', 'right');
            }                           
        ?>                            
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.site-content -->

<?php get_footer();