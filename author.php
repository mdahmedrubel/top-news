<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
get_header();
$userID = get_the_author_meta('ID');
$top_news_user_facebook = get_the_author_meta('tn_user_facebook', $userID);
$top_news_user_twitter = get_the_author_meta('tn_user_twitter', $userID);
$top_news_user_gplus = get_the_author_meta('tn_user_gplus', $userID);
$top_news_user_linkedin = get_the_author_meta('tn_user_linkedin', $userID);
$top_news_user_tumblr = get_the_author_meta('tn_user_tumblr', $userID);
$top_news_user_vimeo = get_the_author_meta('tn_user_vimeo', $userID);
$top_news_user_rss = get_the_author_meta('tn_user_rss', $userID);
$top_news_user_behance = get_the_author_meta('tn_user_behance', $userID);
?>
    <div class="site-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="author-info">
                        <div class="author-image">
                            <?php echo get_avatar( $userID, 150 ); ?>
                        </div><!-- /.author-image -->
                        <div class="content">
                            <h4 class="author-title"><?php echo get_the_author_meta('display_name', $userID);?></h4>                            
                            <p><?php echo get_the_author_meta('description', $userID); ?></p>

                            <div class="social-profiles">
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
                                </ul><!-- /.social-icons -->
                            </div><!-- /.social-profiles -->
                        </div><!-- /.content -->
                    </div><!-- /.author-bio -->
                </div><!-- /.col-md-4 -->


                <div class="col-md-8">
                    <div class="posts-lists archive-row x2 author-page">
                        <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                                get_template_part( 'template-parts/archives/content', get_post_format() );
                            endwhile;
                            the_posts_pagination();
                        else :
                            get_template_part( 'template-parts/content', 'none' );
                        endif;
                        ?>
                    </div><!-- /.posts-lists -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.site-content -->

<?php get_footer();

