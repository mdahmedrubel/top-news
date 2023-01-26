<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Display Posts row with small thumbs
 *
 * @param $args =  pass your all args
 */

function top_news_recent_post_ajax($title,$post_col,$cat_id,$limit,$ajax_post_load,$el_class) {
    $unqID = uniqid();
    if ($post_col =='2-column') {
        $col_md = "col-md-6";
        $perrow = 2;
    } else if ($post_col =='3-column'){
        $col_md = "col-md-4";
        $perrow = 3;
    } else if ($post_col =='4-column'){
        $col_md = "col-md-3";
        $perrow = 4;
    } else {
        $col_md = "col-md-6";
        $perrow = 2;
    }
    ?>
    <div id="post-widget-<?php echo esc_attr($unqID);?>" data-content-id="post-widget-<?php echo esc_attr($unqID);?>" class="posts-widget posts-default posts-lists block <?php echo esc_attr($el_class); ?>" 
        <?php echo $post_ajaxify = 'data-recent-post-ajax=""'; ?>
        <?php echo $data_post_limit = (! empty($limit)) ? 'data-limit="' . $limit . '"' : '6' ; ?>
        <?php echo $data_catid = 'data-catid="'.$cat_id.'"'; ?>
        <?php echo $data_col_md = 'data-post-col="'.$col_md.'"'; ?>
        <?php echo $data_per_row = (! empty($perrow)) ? 'data-per-row="' . $perrow . '"' : '' ; ?>
         >
        <?php if(! empty($title)) : ?>
            <h2 class="widget-title"><span><?php echo esc_html($title); ?></span></h2>
            <div class="clearfix"></div>
        <?php endif; ?>    
            <?php                   
            if( $cat_id == true) {
                $query_args = array(
                    'post_type'         => 'post',
                    'post_status'       => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'term_id',
                            'terms'    => $cat_id,
                        ),
                    ),                            
                    'posts_per_page'    =>  $limit,
                    'ignore_sticky_posts' => true,
                );
            } else {
                $query_args = array(
                    'post_type' => 'post',
                    'post_status'         => 'publish',
                    'posts_per_page'      =>  $limit,
                    'ignore_sticky_posts' => true,
                );
            }
            $the_query = new WP_Query( $query_args );
            $tpost = $the_query->found_posts;
            $counter=0;
            ?> 
            <div class="rp-ajax-row row">            
                <?php 
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post(); $counter++;
                    $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                ?>

                    <div class="<?php echo esc_attr($col_md); ?>">
                        <article class="post-item">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumb">
                                    <a href="<?php the_permalink();?>">
                                        <?php the_post_thumbnail('top-news-thumbnail-x2'); ?>
                                    </a>
                                    <?php if( !empty($meta_data['embedded_link'])) : ?>
                                        <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                                    <?php endif; ?>
                                    <div class="cat-tag-list"><?php top_news_get_terms_link('category'); ?></div>
                                </div> <!--.thumbnail --> 
                            <?php endif; ?>

                            <div class="content">
                                <h2 class="title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <?php top_news_block_meta() ?>                                                                                          
                            </div><!-- /.content -->
                        </article><!-- /.post-item -->
                    </div>
                <?php 
                    //close row div and start another every 2 posts
                    if ($counter%$perrow == 0):?>
                    <div class="clearfix"></div> 
                <?php endif; endwhile;
                wp_reset_postdata();                         
                else : ?>            
                <p><?php esc_html__( 'Sorry, no posts matched your criteria.' , 'top-news'); ?></p>
                <?php endif; ?>
            </div>
            <?php if ($tpost > $limit && $ajax_post_load == 'yes' ): ?>
            <div class="block-post-load">
                <a class="load-more" data-load="<?php echo esc_attr($tpost) ?>" href="#"><i class="fa fa-spinner"></i> <?php esc_html_e('Load More','top-news') ?></a>
            </div>
            <?php endif; ?>

    </div><!-- /.posts-lists -->   
<?php }