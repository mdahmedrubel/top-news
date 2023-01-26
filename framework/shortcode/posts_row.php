<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Display Posts row with small thumbs
 *
 * @param $args =  pass your all args
 */

function top_news_posts_row( $args = false ) { ?>
    <div class="row">
        <div class="col-md-6">
            <div class="posts-lists">
                <?php
                if( !empty($args['cat_ids']) && !empty($args['cat_ids'][0]) ) {
                    $query_args = array(
                        'post_type' => 'post',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field'    => 'term_id',
                                'terms'    => $args['cat_ids'],
                            ),
                        ),
                        'post_status'         => 'publish',
                        'posts_per_page'      =>  1,
                        'ignore_sticky_posts' => true,
                    );
                } else {
                    $query_args = array(
                        'post_type' => 'post',
                        'post_status'         => 'publish',
                        'posts_per_page'      =>  1,
                        'ignore_sticky_posts' => true,
                    );
                }
                $the_query = new WP_Query( $query_args );
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                        $meta_data = get_post_meta( get_the_ID(), '_format-video', true );
                        ?>
                        <article class="post-item">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="post-thumb">
                                    <a href="<?php the_permalink();?>">
                                        <?php the_post_thumbnail('top-news-thumbnail-x2'); ?>
                                    </a>
                                    <?php if( !empty($meta_data['embedded_link'])) : ?>                                            
                                        <a href="<?php the_permalink(); ?>" class="play-btn"></a>
                                    <?php endif; ?>
                                </div><!-- /.thumbnail -->
                            <?php endif; ?>

                            <div class="content">
                                <h2 class="title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <?php if ($args['meta'] === 'yes') : ?>
                                <div class="meta">
                                    <?php if (function_exists('wp_review_show_total')): wp_review_show_total(); endif;?>
                                    <span><?php esc_html_e('Posted by', 'top-news'); ?></span>
                                    <?php the_author_posts_link(); ?>
                                    <span>-</span>
                                    <span><?php echo get_the_date(); ?></span>
                                </div><!-- /.meta -->
                                <?php endif; ?>

                                <div class="excerpt">
                                    <?php
                                        $trimexcerpt = get_the_excerpt();
                                        $shortexcerpt = wp_trim_words( $trimexcerpt, $num_words = $args['excerpt'], $more = '&#8230;' );
                                        echo $shortexcerpt;
                                    ?>
                                </div><!-- /.excerpt -->

                                <a href="<?php the_permalink(); ?>" class="btn btn-default readmore"><?php esc_html_e('Read More', 'top-news'); ?></a>
                            </div><!-- /.content -->
                        </article><!-- /.post-item -->
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p><?php esc_html__( 'Sorry, no posts matched your criteria.' , 'top-news'); ?></p>
                <?php endif; ?>
            </div><!-- /.posts-lists -->
        </div><!-- /.col-md-6 -->

        <div class="col-md-6">
            <?php
                top_news_small_posts_list($args);
            ?>
        </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
<?php }