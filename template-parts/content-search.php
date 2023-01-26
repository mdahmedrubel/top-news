<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TopNews
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(array('post-item')); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumb">
            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail('thumbnail'); ?>
            </a>
        </div><!-- /.thumbnail -->
    <?php endif; ?>

    <div class="content">
        <h2 class="title">
            <a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <div class="meta">
            <span><?php esc_html_e('Posted by', 'top-news'); ?></span>
            <?php the_author_posts_link(); ?>
            <span>-</span>
            <span><?php echo get_the_date(); ?></span>
        </div><!-- /.meta -->

        <div class="excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 20, '&#8230;' ); ?>
        </div><!-- /.excerpt -->
    </div><!-- /.content -->
</article><!-- /.post-item -->
