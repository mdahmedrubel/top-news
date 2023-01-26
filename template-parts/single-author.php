<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
global $post;
$userID = $post->post_author;
$top_news_user_facebook = get_the_author_meta('tn_user_facebook', $userID);
$top_news_user_twitter = get_the_author_meta('tn_user_twitter', $userID);
$top_news_user_gplus = get_the_author_meta('tn_user_gplus', $userID);
$top_news_user_linkedin = get_the_author_meta('tn_user_linkedin', $userID);
$top_news_user_tumblr = get_the_author_meta('tn_user_tumblr', $userID);
$top_news_user_vimeo = get_the_author_meta('tn_user_vimeo', $userID);
$top_news_user_rss = get_the_author_meta('tn_user_rss', $userID);
$top_news_user_behance = get_the_author_meta('tn_user_behance', $userID);

$top_news_author_bio = '';
if (function_exists('cs_get_option')):
    $top_news_author_bio = cs_get_option( 'tn_author_bio' );
    $tn_author_bio_admin = cs_get_option( 'tn_author_bio_admin' );    
endif;
if( $top_news_author_bio === 'true' && $tn_author_bio_admin === 'false' ){
    $author_box_display = 'true';
} else if(current_user_can('administrator') && $top_news_author_bio === 'true' && $tn_author_bio_admin === 'true'){
    $author_box_display = 'true';
} else if($top_news_author_bio === 'false'){
    $author_box_display = 'false';
} else {
    $author_box_display = 'false';
}
if ($author_box_display === 'true'): ?>
<div class="author-bio">
	<div class="author-image">
            <?php 
                echo get_avatar( $userID, 150 );
            ?>
	</div><!-- /.author-image -->

	<div class="content">
		<h4 class="author-title"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo get_the_author_meta('display_name', $userID);?></a></h4>
		<div class="description">
			<?php echo get_the_author_meta('description', $userID); ?>
		</div><!-- /.description -->
		<ul class="social-icons">
                    <?php 
                    if(! empty ($top_news_user_facebook)): 
                        echo '<li><a href="'.esc_url($top_news_user_facebook).'"><i class="fa fa-facebook"></i></a></li>';
                    endif;
                    if(! empty ($top_news_user_twitter)):
                        echo '<li><a href="'.esc_url($top_news_user_twitter).'"><i class="fa fa-twitter"></i></a></li>';
                    endif;
                    if(! empty ($top_news_user_gplus)):
                        echo '<li><a href="'.esc_url($top_news_user_gplus).'"><i class="fa fa-google-plus"></i></a></li>';
                    endif;
                    if(! empty ($top_news_user_linkedin)):
                        echo '<li><a href="'.esc_url($top_news_user_linkedin).'"><i class="fa fa-linkedin"></i></a></li>';
                    endif;
                    if(! empty ($top_news_user_tumblr)):
                        echo '<li><a href="'.esc_url($top_news_user_tumblr).'"><i class="fa fa-vimeo-square"></i></a></li>';
                    endif;
                    if(! empty ($top_news_user_vimeo)):
                        echo '<li><a href="'.esc_url($top_news_user_vimeo).'"><i class="fa fa-tumblr"></i></a></li>';
                    endif;
                    if(! empty ($top_news_user_rss)):
                        echo '<li><a href="'.esc_url($top_news_user_rss).'"><i class="fa fa-rss"></i></a></li>';
                    endif;
                    if(! empty ($top_news_user_behance)):
                        echo '<li><a href="'.esc_url($top_news_user_behance).'"><i class="fa fa-behance"></i></a></li>';
                    endif;
                    ?>			
		</ul><!-- /.post-share -->
	</div><!-- /.content -->
</div><!-- /.author-bio -->
<?php endif;