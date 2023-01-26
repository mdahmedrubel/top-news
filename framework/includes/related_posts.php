<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
function top_news_related_posts_query( $post_id, $related_count, $args = array() ) {
    $args = wp_parse_args( (array) $args, array(
        'orderby' => 'rand',
        'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
    ) );

    $related_args = array(
        'post_type'      => get_post_type( $post_id ),
        'posts_per_page' => $related_count,
        'post_status'    => 'publish',
        'post__not_in'   => array( $post_id ),
        'orderby'        => $args['orderby'],
        'tax_query'      => array()
    );

    $post       = get_post( $post_id );
    $taxonomies = get_object_taxonomies( $post, 'names' );

    foreach( $taxonomies as $taxonomy ) {
        $terms = get_the_terms( $post_id, $taxonomy );
        if ( empty( $terms ) ) continue;
        $term_list = wp_list_pluck( $terms, 'slug' );
        $related_args['tax_query'][] = array(
            'taxonomy' => $taxonomy,
            'field'    => 'slug',
            'terms'    => $term_list
        );
    }

    if( count( $related_args['tax_query'] ) > 1 ) {
        $related_args['tax_query']['relation'] = 'OR';
    }

    if( $args['return'] == 'query' ) {
        return new WP_Query( $related_args );
    } else {
        return $related_args;
    }
}
function top_news_related_posts($id, $count = 5) {    
    $related = top_news_related_posts_query($id, $count);

    if( $related->have_posts() ): ?>
    <h2 class="widget-title"><span><?php esc_html_e('Related Post', 'top-news') ?></span></h2>
    <div class="clearfix"></div>
    <div class="posts-widget posts-lists archive-row x2 ajax">
        <?php while( $related->have_posts() ): $related->the_post(); 
            $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
        ?>
        <article class="post-item <?php echo ( has_post_thumbnail()) ? 'has-post-thumbnail' : '' ; ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumb">
                    <a href="<?php the_permalink();?>">
                        <?php the_post_thumbnail('top-news-thumbnail-x2'); ?>
                    </a>
                    <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                        <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                    <?php endif; ?>                        
                </div> <!--.thumbnail --> 
            <?php endif; ?>

            <div class="content">
                <h2 class="title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="meta">                    
                    <?php top_news_block_meta() ?>
                </div> <!--/.meta-->              
                <div class="excerpt">                                        
                    <?php
                        $trimexcerpt = get_the_excerpt();
                        $shortexcerpt = wp_trim_words( $trimexcerpt, $num_words = '20', $more = '&#8230;' );
                        echo $shortexcerpt;
                    ?>
                </div> <!--/.excerpt-->                     
            </div><!-- /.content -->
        </article><!-- /.post-item -->
        <?php endwhile; ?>
        <div class="clearfix"></div>
    </div><!-- /.posts-lists -->
    <?php endif; wp_reset_postdata();
}