<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/* 
 * footer of single post
 */
$tn_cat_tag_share = '';
$tn_single_category_list = '';
$tn_single_tag_list = '';
if (function_exists('cs_get_option')):
    $tn_cat_tag_share = cs_get_option('tn_cat_tag_share');
    $tn_single_category_list = cs_get_option('tn_single_category_list');
    $tn_single_tag_list = cs_get_option('tn_single_tag_list');
endif;
if ($tn_cat_tag_share === 'true'):
?>
<footer class="entry-footer">
    <div class="row">
            <div class="col-md-7 col-sm-6">
                <?php 
                if ($tn_single_tag_list === 'true'):
                $get_tags = wp_get_post_tags(get_the_ID());
                if (!empty($get_tags)): ?>                
                <ul class="taglist list-inline">                    
                    <li><?php esc_html_e('Tags :', 'top-news'); ?> </li>                    
                    <?php foreach($get_tags as $tag ) : ?>
                    <li>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="cat-tag <?php echo esc_attr($cat->slug); ?>">
                            <?php echo esc_attr($tag->name); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php endif; ?>
                
                <?php 
                if ($tn_single_category_list === 'true'):
                $get_cats = get_the_terms(get_the_ID(), 'category');
                if (!empty($get_cats)): ?>
                <ul class="taglist list-inline">                                        
                    <li><?php esc_html_e('Category :', 'top-news'); ?> </li>                    
                    <?php foreach($get_cats as $cat ) : ?>
                    <li>
                        <a href="<?php echo esc_url(get_term_link($cat)); ?>" class="cat-tag <?php echo esc_attr($cat->slug); ?>">
                            <?php echo esc_attr($cat->name); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php endif; ?>                                
            </div><!-- /.col-md-8 -->

            <div class="col-md-5 col-sm-6">
                <?php $pinterestimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                <ul class="social-icons post-share text-right">
                    <li><strong>Share: </strong></li>
                    <li><a title="Facebook" class="facebook" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)); ?>"><i class="fa fa-facebook"></i></a></li>
                    <li><a title="Twitter" class="twitter" href="http://twitter.com/home?status=<?php the_title(); ?> <?php echo urlencode(get_permalink($post->ID)); ?>"><i class="fa fa-twitter"></i></a></li>
                    <li><a title="Google Plus" class="google-plus" href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;name=<?php the_title(); ?>"><i class="fa fa-google-plus"></i></a></li>
                    <li><a title="Linkedin" class="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink($post->ID)); ?>&title=<?php the_title(); ?>"><i class="fa fa-linkedin"></i></a></li>
                    <li><a title="Pinterest" class="pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink($post->ID)); ?>&media=<?php echo $pinterestimage[0]; ?>&description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a></li>

                </ul><!-- /.post-share -->
            </div><!-- /.col-md-4 -->
    </div><!-- /.row -->
</footer><!-- /.entry-footer -->
<?php endif;
